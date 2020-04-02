<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Cube;

class CubeOperationForm extends Model
{
    public $operation;
    public $n;
    public $cube;

    /**
     * @return array the validation rules.
     * The match pattern options validate:
     *  - That the command is either "UPDATE n n n n" or "QUERY n n n n n n n" format
     *  - If UPDATE command validates that the first 3 n (numbers) are between 1 and 100 and the last number is > -10^9  and < 10^9
     *  - If QUERY command validates that all the n (numbers) are between 1 and 100
     */
    public function rules()
    {
        return [
            [['operation' ], 'required'],
            [['operation' ], 'match', 'pattern' => '/(^UPDATE\s(100|[1-9]\d{0,1})\s(100|[1-9]\d{0,1})\s(100|[1-9]\d{0,1})\s(\-?[1-9]\d{0,8}|0|\-?1000000000)$)|(^QUERY\s(100|[1-9]\d{0,1})\s(100|[1-9]\d{0,1})\s(100|[1-9]\d{0,1})\s(100|[1-9]\d{0,1})\s(100|[1-9]\d{0,1})\s(100|[1-9]\d{0,1})$)/'],
            [['operation', 'n' ], 'validateOperation'],
        ];
    }

    /**
     * Custom validation for the field operation of the form,
     * validate that the 3 first numbers of UDPATE command are less than N
     * and from the QUERY command that x2 > x1, y2 > y1, and z2 > z1
     * @return string
     */

    public function validateOperation($attribute, $params, $validator)
    {
      $operation = explode(" ", $this->$attribute);
      if ($operation[0] == "UPDATE"){
        for ($i = 1; $i <= 3; $i++) {
          if($operation[$i] > $this->n){
            $this->addError($attribute, 'The x, y, z numbers must be less than ' .$this->n );
          }
        }
      }
      else if($operation[0] == "QUERY") {
        for ($i = 1; $i <= 3; $i++) {
          $j = $i + 3;
          if($operation[$i] > $operation[$j]){
            $this->addError($attribute, $operation[$i] . ' has to be equal or minor than ' .$operation[$j] );
          }
        }
      }
    }

    /**
     * Validates the form:
     * If the command is UPDATE: update the cube with the values sent
     * If the command is QUERY: calculates the cube and store the result in operations_total
     * @return bool whether the user is submitted successfully
     */
    public function send()
    {
        if ($this->validate()) {
            $model = \Yii::$app->session->get('cube');
            $operations_total = \Yii::$app->session->get('operations_total');
            $c = explode(" ", $this->operation);
            if ($c[0] == "UPDATE"){
                $model->updateValue($c[1], $c[2], $c[3], $c[4]);
                return true;
            }
            if ($c[0] == "QUERY"){
                $result = $model->query($c[1], $c[2], $c[3], $c[4], $c[5], $c[6]);
                $operations_total[] = $result;
                \Yii::$app->session->set('operations_total', $operations_total);
                return true;
            }
        }
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function getOperation()
    {
        return $this->operation;
    }

}
