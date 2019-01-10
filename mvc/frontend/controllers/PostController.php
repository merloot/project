<?php

namespace frontend\controllers;

use common\models\Post;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;



class PostController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {

        //Незабыть доделать сортировку по дате публикации
        $posts= Post::find()->andWhere(['id_status'=>1]);
        $dataProvider = new ActiveDataProvider([
            'query' => $posts,
            'pagination'=>[
                'pageSize'=>10,
            ]
        ]);
        return $this->render('all',['dataProvider'=>$dataProvider]);
    }

    public function actionOne($id_post)
    {

        if ($post= Post::find()->andWhere(['id_post'=>$id_post])->one())
        {
            return $this->render('one',['post'=>$post]);

        }
        throw new NotFoundHttpException('Такого поста не существует');
    }


}