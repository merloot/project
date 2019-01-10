<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use kartik\date\DatePicker;


/* @var $this yii\web\View */
/* @var $model common\models\Profile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profile-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?//= $form->field($model, 'p_id')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'u_id')->textInput() ?>

    <?=  $form->field($model, 'p_image')->widget(FileInput::classname(), [
        'options' => ['accept' => 'images/*'],
    ]); ?>

    <?= $form->field($model,'p_date')->widget(DatePicker::className()) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить профиль', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
