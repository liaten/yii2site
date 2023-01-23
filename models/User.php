<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    private ?int $id = null;
    private ?string $login = null;
    private ?string $password = null;
    private ?int $userType = null;
    private ?string $accessToken = null;
    private ?string $authKey = null;

    function __construct($config = [])
    {
        parent::__construct($config);
    }

    public function getUserFromDBByLoginPassword(string $login, string $password) : ?ActiveRecord
    {
        return $this->findOne(['login' => $login, 'password' => $password]);
    }

    public static function getUserFromDBByLogin(string $login) : ?ActiveRecord
    {
        return self::findOne(['login' => $login]);
    }

    public static function getUserFromDBByAccessToken(string $accessToken) : ?ActiveRecord
    {
        return self::findOne(['accessToken' => $accessToken]);
    }

    public function findByLoginPassword(string $login, string $password): ?User
    {
        $user = $this->findOne(['login'=>$login, 'password' => $password]);
        if($user){
            $this->id = $user->__get('id');
            $this->login = $user->__get('login');
            $this->userType = $user->__get('userType');
            $session = Yii::$app->session;
            $session['user'] = [
                'id' => $this->id,
                'login' => $this->login,
                'userType' => $this->userType
            ];
        }
        return $user;
    }

    public function isUser(string $login,string $password) : bool
    {
        if($this->getUserFromDBByLoginPassword($login,$password)){
            return true;
        }
        return false;
    }

    public function getUserTypeID(string $login) : ActiveRecord
    {
        return $this->find()->select(['userType'])->where(['login' => $login])->one();
    }

    /**
     * Finds an identity by the given ID.
     *
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($id): ?IdentityInterface
    {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null): User|IdentityInterface|null
    {
        return self::findOne(['accessToken'=>$token]);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAuthKey(): ?string
    {
        return $this->authKey;
    }

    /**
     * @param string $authKey
     * @return bool
     */
    public function validateAuthKey($authKey): bool
    {
        return $this->authKey === $authKey;
    }

    public function validatePassword(string $password): bool
    {
        return $this->password === $password;
    }
}