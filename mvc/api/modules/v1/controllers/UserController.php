<?php
namespace api\modules\v1\controllers;

use yii\filters\Cors;
use yii\rest\ActiveController;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\filters\ContentNegotiator;
use yii\web\Response;
use common\models\Token;
use yii;
use api\modules\v1\models\User;

class UserController extends ActiveController
{
    public $gender;
    public $u_date;
    public $password = "";

    public function behaviors()
    {
       return [
            'corsFilter' => [
                'class' => Cors::className(),
                'cors' => [
                    'Origin' => ['*'],
                    'Access-Control-Request-Method' => [ 'POST', 'OPTIONS'],
                    'Access-Control-Request-Headers' => ['*'],
                ],
            ],
//             'access' => [
//                 'class' => AccessControl::className(),
//                 'rules' => [
//                     [
//                         'allow' => true,
//                         'actions' => [ 'index'],
//                         'roles' => ['*'],
//                     ],
//                 ],
//             ],
            'contentNegotiator' => [
                'class' => ContentNegotiator::className(),
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
        ];
        return $behaviors;
    }
    public $modelClass = 'api\modules\v1\models\User';


    public function actionCreate()

    {
        \Yii::$app->response->format = Response:: FORMAT_JSON;
        $this->enableCsrfValidation = false;
        $user = User::findByEmail(Yii::$app->request->getBodyParam('email'));
        {
            $result =  [
                'success' => 0,
                'message' => 'User with this email already exist',
                'code' => 'email_busy'
            ];
        }
        if(!$user){
            $user = new User();
            $user->username = Yii::$app->request->getBodyParam('');
            $user->email = Yii::$app->request->getBodyParam('');
            $user->setPassword($this->password)(Yii::$app->request->getBodyParam('password'));
            $user->gender = $this->gender = Yii::$app->request->getBodyParam('gender');
            $user->u_date = $this->u_date = Yii::$app->request->getBodyParam('u_date');
            $user->generateAuthKey();
            $user->save();
            $token = $this->generateToken($user->id);
            $result =   [
                'success' => 1,
                'username' =>  $user->username,
                'userId' =>  $user->id,
                'gender'=> $user->gender,
                'u_date'=>$user->u_date,
                'payload' => $user,
                'token' => $token->token
            ];
        }
        return $result;
    }
    public function beforeSave($insert) {
        if ($this->password) {
            $this->setPassword($this->password);
        }
        return parent::beforeSave($insert);
    }
}

