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
class CubeSettingForm extends Model
{
    public $T_tests;
    public $N_coordinates;
    public $M_operations;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['T_tests', 'N_coordinates', 'M_operations' ], 'required'],
            [['T_tests' ], 'integer', 'min' => '1', 'max' => '50'],
            [['N_coordinates' ], 'integer', 'min' => '1', 'max' => '100'],
            [['M_operations' ], 'integer', 'min' => '1', 'max' => '1000'],
        ];
    }
    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
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
    public function getN_coordinates()
    {
        return $this->N_coordinates;
    }

    /**
     * {@inheritdoc}
     */
    public function getM_operations()
    {
        return $this->M_operations;
    }

    /**
     * {@inheritdoc}
     */
    public function getT_tests()
    {
        return $this->T_tests;
    }
}
