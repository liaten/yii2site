<?php

namespace app\controllers;

use app\models\User;
use app\models\UserType;
use yii\web\Controller;
use app\models\LoginForm;
use Yii;

class LoginController extends Controller
{
    /**
     * Отображает страницу авторизации
     *
     * @return string
     */
    public function actionIndex(): string
    {
        $this->view->title = 'Авторизация';

        $loginForm = new LoginForm();
        if($loginForm->load(Yii::$app->request->post())){
            $user = new User();
            if( $loginForm->validate() && $loginForm->login()){
                Yii::$app->session->setFlash('auth_ok');
                $userType = new UserType();
                $userTypeNameID = $user->getUserTypeID($loginForm->login)->__get('userType');
                $userTypeName = $userType->getName($userTypeNameID)->__get('name');
                return $this->render('index', compact('loginForm','userTypeName'));
            }
            else{
                Yii::$app->session->setFlash('auth_err');
            }
        }

        return $this->render('index', compact('loginForm',));
    }
}