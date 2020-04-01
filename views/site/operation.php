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
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Cube Settings:</p>
    <p>T: <?= $T ?></p>
    <p>N: <?= $N ?></p>
    <p>M: <?= $M ?></p>
</div>
