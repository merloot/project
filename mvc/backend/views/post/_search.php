<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PostSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_post') ?>

    <?= $form->field($model, 'id_autor') ?>

    <?= $form->field($model, 'id_categorie') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'secondtitle') ?>

    <?php // echo $form->field($model, 'image') ?>

    <?php // echo $form->field($model, 'text') ?>

    <?php // echo $form->field($model, 'views') ?>

    <?php // echo $form->field($model, 'rating') ?>

    <?php // echo $form->field($model, 'pubdate') ?>

    <?php // echo $form->field($model, 'id_status')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
