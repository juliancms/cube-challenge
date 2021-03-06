<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Cube Challenge';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-operation">
    <h2>Test # <?= $t2 ?> of <?= $t ?></h1>
    <h2>Operation # <?= $m2 ?> of <?= $m ?></h1>
    <p>Cube Initial Settings:</p>
    <p>N: <?= $n ?></p>
    <?php $form = ActiveForm::begin([
        'id' => 'cubeOperation-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>
        <?php $model->n = $n; ?>
        <?= $form->field($model, 'operation')->textInput(['autofocus' => true]) ?>
        <?= $form->field($model, 'n')->hiddenInput()->label(false) ?>
        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Execute', ['class' => 'btn btn-primary', 'name' => 'execute-button']) ?>
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
