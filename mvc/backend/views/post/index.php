<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Post', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',
//              'label'=>'Картинка',
//                'format'=>'raw',
//                'value'=> function($data)
//                {
//                    return Html::img(Url::toRoute($data->image),[
//                            'alt'=>'yii2 - картинка в gridview',
//                            'style'=>'width:15px;'
//                    ]);
//                }
                ],

            'id_post',
            'id_autor',
            'id_categorie',
            'title',
//            'secondtitle',
            'image',
            //'text:ntext',
            //'views',
            //'rating',
            //'pubdate',
            'id_status:boolean',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
