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
    <h2>Settings</h2>
    <p>Test <?= $t2 ?> of <?= $t ?></p>
    <p>Please fill out the following fields to configure the cube:</p>
    <?php if (Yii::$app->session->hasFlash('OperationsFinished')): ?>
      <div class="alert alert-success">
        The number of operations are completed, please insert values to start a new test.
      </div>
    <?php endif; ?>
    <?php $form = ActiveForm::begin([
        'id' => 'cubeSetting-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'N_coordinates')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'M_operations')->textInput() ?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Send', ['class' => 'btn btn-primary', 'name' => 'send-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
    <?php if (!empty($operations_total)): ?>
    <div class="alert alert-info">
      <h4>Results:</h4>
      <?php foreach($operations_total as $number): ?>
        <p><?= $number ?></p>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>
