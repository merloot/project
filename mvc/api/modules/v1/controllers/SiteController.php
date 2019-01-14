<?php
namespace api\modules\v1\controllers;

use Yii;
use yii\rest\Controller;
use api\models\LoginForm;

class  SiteController extends Controller
{
    public function actionsIndex()
    {
     return 'api';
    }

    public function actionsLogin()
    {
        $model = new LoginForm();
        $model->load(Yii::$app->request->bodyParams, '');
        if ($token = $model->auth())
        {
            return [
                'token'=> $token->token,
                'expired_time'=> date(DATE_RFC3339,$token->expire_time)
            ];
        }else{
            return $model;
        }
    }

    protected function verbs()
    {
     return[
         'login'=> ['post'],
     ];
    }

}
