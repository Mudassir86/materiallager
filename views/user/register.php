<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form ActiveForm */
?>
<div class="maincontent">
    <a class="btn btn-primary pull-right" href="index.php?r=site/index">zurück</a>
<div class="user-register">
	<h2 class="page-header">User Registration </h2>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($user, 'name')->label('Username',['class'=>'label-class']); ?>
    <?= $form->field($user, 'cert_o')->label('Repeat username',['class'=>'label-class']); ?>
    <?= $form->field($user, 'pwd')->passwordInput()->label('Passowrd',['class'=>'label-class']); ?>
    <?= $form->field($user, 'password_repeat')->passwordInput()->label('Repeat password',['class'=>'label-class']); ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- user-register -->
</div>
