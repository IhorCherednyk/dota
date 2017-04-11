<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers;

use app\helpers\ImageHelper;
use app\models\LoginForm;
use app\models\RegForm;
use app\models\Token;
use app\models\User;
use app\models\SendEmailForm;
use app\models\ResetPasswordForm;
use app\models\Email;
use Yii;
use yii\web\UploadedFile;
use yii\filters\AccessControl;

/**
 * Description of AuthoriseController
 *
 * @author Anastasiya
 */
class AuthController extends BaseController {
    public $layout = '/main';
    
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                        [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                        [
                        'actions' => ['login','reg','activate-email','send-email','setnew-password'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
        ];
    }

    public function actionReg() {

        $model = new RegForm();
       
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $user = $model->reg();
            if ($user) {
                $email = ($email = Email::findByUserEmail($user->email)) ? $email : new Email();
                $email->createEmail($user, Email::EMAIL_ACTIVATE);
                Yii::$app->session->setFlash('confirm-email', 'На ваш email отправлено письмо для подтверждения email');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Возникла ошибка при регистрации.');
            Yii::error('Ошибка при регистрации');
        }

        return $this->render(
                        'reg', ['model' => $model]
        );
    }

    public function actionActivateEmail($key) {
        $user = User::findByEmailKey($key);
        if ($user) {
            $user->status = User::STATUS_ACTIVE;
            $user->save();
            $email = Email::findByUserEmail($user->email);
            if ($email) {
                $email->delete();
            }
            if (Yii::$app->getUser()->login($user)) {
                return $this->redirect(['dota/tournament']);
            }
        }
        Yii::$app->session->setFlash('error', 'Возникла ошибка при подтверждении пароля попробуйте зарегистрироваться заново');

        return $this->redirect(['auth/reg']);
    }

    public function actionSendEmail() {
        $model = new SendEmailForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'На вашу почту выслано подтверждение изменения пароля');
            }
        }
        return $this->render('send-email', [
                    'model' => $model,
        ]);
    }

    public function actionSetnewPassword($key) {
        $token = Token::findBySecretKey($key);

        if ($token && $token->isSecretKeyExpire($token->expire_date)) {

            $model = new ResetPasswordForm();
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                if ($model->resetPassword($token)) {
                    $email = Email::findByUserToken($key);
                    if ($email) {
                        $email->delete();
                    }
                    return $this->redirect(['auth/login']);
                }
            }
            return $this->render('setnew-password', [
                        'model' => $model,
            ]);
        }
        Yii::$app->session->setFlash('warn', 'Либо неверно указан ключи или срок ссылки на изменение пароля истек, отправьте новй запрос на востановление пароля');
        return $this->redirect(['auth/send-email']);
    }

    public function actionLogin() {
        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post())) {

            if ($model->login()) {
                if ($model->user->role == User::ROLE_ADMIN) {
                    return $this->redirect(['/admin-tournament/index']);
                } else {
                    return $this->redirect(['dota/tournament']);
                }
            } else {
                Yii::$app->session->setFlash('error', 'Возможно вы не активировали свой email');
                return $this->refresh();
            }
        }
        return $this->render('login', [
                    'model' => $model,
        ]);
    }

    public function actionLogout() {
        Yii::$app->user->logout();
        return $this->redirect(['auth/login']);
    }



}
