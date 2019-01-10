<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\date\DatePicker;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>
            <?= $form->field($model,'u_date')->widget(DatePicker::className([
                'attribute'=>'datetime_range',
                'name' => 'from_date',
                'value' => 'Feb-01-1996',
                'type' => DatePicker::TYPE_RANGE,
                'name2' => 'to_date',
                'value2' => 'Feb-01-1996',
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'mm-dd-yyyy',
                    'todayHighlight' => true,
                    'startDate' => date("mm-dd-yyyy H:i:s"),
                ]
            ]
            )) ?>
            <?= $form->field($model, 'gender')->inline()->radioList(['1' => 'Мужчин', '0' => 'Женщина'])->label(false) ?>

                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
