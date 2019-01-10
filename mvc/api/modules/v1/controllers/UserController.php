<?php
namespace api\modules\v1\controllers;

use yii\filters\Cors;
use yii\rest\ActiveController;

class UserController extends ActiveController
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['corsFilter'] = [
            'class' => Cors::className(),
            'cors' => [
                // restrict access to
                'Origin' => ['http://localhost:8080'],
            ],

        ];
        return $behaviors;
    }
    public $modelClass = 'api\modules\v1\models\User';

}