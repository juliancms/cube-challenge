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
    <h2>You have completed all the tests!</h2>
    <?php if (!empty($operations_total)): ?>
    <div class="alert alert-info">
      <h4>Results:</h4>
      <?php foreach($operations_total as $number): ?>
        <p><?= $number ?></p>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>
