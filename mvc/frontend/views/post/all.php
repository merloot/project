<?php

/* @var $this yii\web\View */
/* @var $posts common\models\Post */
$post= $dataProvider->getModels();
?>

<div class="body-content">
    <div class="row">
        <?php foreach ($post as $one):?>
            <div class="col-lg-4">
               <h2><?= yii\bootstrap\Html::a($one->title,['post/one','id_post'=>$one->id_post])?></h2>
                <p><?=$one->secondtitle?></p>
                <p><?=$one->image?></p>
            </div>
        <?php endforeach;?>
    </div>
</div>
