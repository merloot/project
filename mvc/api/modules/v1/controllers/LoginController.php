<?php

namespace api\modules\v1\controllers;


use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\filters\ContentNegotiator;
use yii\web\Response;
use common\models\User;
use common\models\Token;
use yii\filters\Cors;

class LoginController extends Controller
{
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
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'index'=>['post', 'options'],
//                ]
//            ],
//            'access' => [
//                'class' => AccessControl::className(),
//                'rules' => [
//                    [
//                        'allow' => true,
//                        'actions' => [ 'index'],
//                        'roles' => ['*'],
//                    ],
//                ],
//            ],
            'contentNegotiator' => [
                'class' => ContentNegotiator::className(),
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
        ];
    }
    public function beforeAction($action)
    {
        if (in_array($action->id, ['index'])) {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }
    /* отключаем цсрф чтобы не иметь 400 ошибки при запросе*/
    public function actionIndex()
    {
        $this->enableCsrfValidation = false;
        $params = Yii::$app->request->getBodyParams();
        $user = User::findByEmail(Yii::$app->request->getBodyParam('email'));
        if($user)
            if (!$user->validatePassword(Yii::$app->request->getBodyParam('password'))) {
                $result =   [
                    'success' => 0,
                    'message' => 'Incorrect password'
                ];
            }
            else{
                $token = new Token();
                $token->token = Yii::$app->getSecurity()->generateRandomString(12);
                $token->user_id = $user->id;
                $token->expire_time = time() + 3600 * 5;
                $token->save();
                Token::deleteAll('expire_time < ' . time());
                $result =   [
                    'success' => 1,
                    'username' =>  $user->username,
                    'payload' => $user,
                    'token' => $token->token
                ];
            }
        echo json_encode($result);
    }
    public function actionRegistration()
    {
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
            $user->username = Yii::$app->request->getBodyParam('username');
            $user->email = Yii::$app->request->getBodyParam('email');
            $user->setPassword(Yii::$app->request->getBodyParam('password'));
            $user->generateAuthKey();
            $user->save();
            $token = $this->generateToken($user->id);
            $result =   [
                'success' => 1,
                'username' =>  $user->username,
                'userId' =>  $user->id,
                'payload' => $user,
                'token' => $token->token
            ];
        }
        return $result;
    }

}