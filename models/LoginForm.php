<?php

namespace app\models;
use Yii;
use yii\base\Model;

/**
 * Модель, которая находится за формой логина
 *
 * @property-read User|null $user
 *
 */
class LoginForm extends Model
{
    public ?string $login = null;
    public ?string $password = null;
    public bool $rememberMe = true;

    private User|bool|null $_user = false;

    public function attributeLabels(): array
    {
        return [
            'login' =>'Логин',
            'password' =>'Пароль',
            'rememberMe' =>'Запомнить меня'
        ];
    }

    public function rules(): array
    {
        return [
            [['login','password'],'required'],
            ['rememberMe', 'boolean'],
            [['login','password'],'string','length' => [3,255]],
            [['login','password'],'trim']
        ];
    }

    /**
     * Выполняет вход в систему
     * @return bool, когда вход удачный
     */
    public function login() : bool
    {
        if ($this->validate()) {
            try{
                return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
            }
            catch (\TypeError $typeError){
                Yii::debug($typeError);
            }
        }
        return false;
    }

    /**
     * Находит пользователя по параметрам login,password
     *
     * @return User|null
     */
    public function getUser(): ?User
    {
        if ($this->_user === false) {
            $this->_user = (new User)->findByLoginPassword($this->login, $this->password);
        }

        return $this->_user;
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword(string $attribute, array $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

}