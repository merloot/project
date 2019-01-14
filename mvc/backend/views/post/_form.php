<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\imperavi\Widget;
use kartik\file\FileInput;


/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin([
            'options'=>['enctype'=>'multipart/form-data'],
    ]); ?>

    <?= $form->field($model, 'id_categorie')->dropDownList([
            '1'=>'Мемы',
            '2'=>'Хайп',
            '3'=>'Новинки',
    ]) ?>
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'secondtitle')->textInput(['maxlength' => true]) ?>
     <?=  $form->field($model, 'image')->widget(FileInput::classname(), [
        'pluginOptions' => [
            'showCaption' => false,
            'showRemove' => false,
            'showUpload' => false,
            'browseClass' => 'btn btn-primary btn-block',
            'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
            'browseLabel' =>  'Загрузить картинку'
        ],
    ]); ?>
    <?=$form->field($model, 'text')->widget(Widget::className(), [
        'settings' => [
            'lang' => 'ru',
            'minHeight' => 200,
            'imageUpload'=> \yii\helpers\Url::to(['site/save-redactor-img','sub'=>'post']),
            'plugins' => [
                'clips',
                'fullscreen',
            ],
            'clips' => [
                ['red', '<span class="label-red">red</span>'],
                ['green', '<span class="label-green">green</span>'],
                ['blue', '<span class="label-blue">blue</span>'],
            ],
        ],
    ])?>
    <?= $form->field($model, 'pubdate')->textInput() ?>
    <?= $form->field($model, 'id_status')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
