<?php

namespace app\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;
use app\components\MyBehaviors;
use Yii;
use app\models\User;

class AppController extends Controller {

    public function behaviors() {
        return [
            'access' => [// название поведения
                'class' => AccessControl::className(), // фильтры
                'rules' => [// список правил 
//                  
                    [
                       'allow' => true, //(ДЕЙСТВИЕ) РАЗРЕШИТЬ ДОСТУП
                        
                    ],
                ]
            ]
        ];
    }

}
