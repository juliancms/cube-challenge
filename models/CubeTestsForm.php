<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * CubeTestsForm
 *
 *
 */
class CubeTestsForm extends Model
{
    public $T_tests;

    /**
     * @return array The validation rules of the form.
     */
    public function rules()
    {
        return [
            [['T_tests' ], 'required'],
            [['T_tests' ], 'integer', 'min' => '1', 'max' => '50'],
        ];
    }
    /**
     * Validate the form
     * @return bool whether the is validated successfully
     */
    public function send()
    {
        if ($this->validate()) {
            return true;
        }
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function getT_tests()
    {
        return $this->T_tests;
    }
}
