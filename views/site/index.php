<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Cube Challenge';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">
    <h2>Number of Tests</h2>
    <p>Please fill enter how many tests do you want to do:</p>
    <?php $form = ActiveForm::begin([
        'id' => 'cubeTest-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'T_tests')->textInput(['autofocus' => true]) ?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Send', ['class' => 'btn btn-primary', 'name' => 'send-button']) ?>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
</div>
