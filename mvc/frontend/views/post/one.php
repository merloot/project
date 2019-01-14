<?php
/* @var $this yii\web\View */
/* @var $post common\models\Post */
use yii\bootstrap\Html;
?>

<h1><?=$post->title?></h1>
<h2><?=$post->secondtitle?></h2>
 <?= Html::img('/uploads/images/post/'.$post->image) ?>
<?=$post->text?>

