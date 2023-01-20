<?php

namespace app\models;
use yii\base\Model;

class TestForm extends Model
{
    public $login;
    public $password;
    public $userType;
    public $email;

    public function attributeLabels()
    {
        return [
            'login' =>'Логин',
            'password' =>'Пароль',
        ];
    }

    public function rules()
    {
        return [
            [['login','password'],'required'],
            [['login','password'],'string','length' => [3,255]],
            [['login','password'],'trim']
        ];
    }

}