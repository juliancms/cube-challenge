<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Cube;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class CubeOperationForm extends Model
{
    public $operation;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['operation' ], 'required'],
        ];
    }
    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function send()
    {
        if ($this->validate()) {
            $model = new Cube();
            return $model;
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
