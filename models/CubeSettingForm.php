<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * CubeSetting form for N and M values
 *
 *
 */
class CubeSettingForm extends Model
{
    public $N_coordinates;
    public $M_operations;


    /**
     * @return array The validation rules.
     */
    public function rules()
    {
        return [
            [['N_coordinates', 'M_operations' ], 'required'],
            [['N_coordinates' ], 'integer', 'min' => '1', 'max' => '100'],
            [['M_operations' ], 'integer', 'min' => '1', 'max' => '1000'],
        ];
    }
    /**
     * Sends the validation.
     * @return bool whether validate successfully
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
}
