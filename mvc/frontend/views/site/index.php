<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="jumbotron">
        <h1>Congratulations!</h1>
        <p class="lead">You have successfully created your Yii-powered application.</p>
    </div>
    <div class="body-content">
        <div class="row">
            <?php foreach ($posts as $one): ?>
                <div class="col-lg-4">
                    <h2><?= yii\bootstrap\Html::a($one->title,['post/one','id_post'=>$one->id_post])?></h2>
<!--                    <p>--><?//= $one->secondtitle ?><!--</p>-->
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
