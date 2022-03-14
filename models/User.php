<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\base\Security;

class User extends ActiveRecord implements IdentityInterface {
    
    public $password;
    public $password_repeat;
    public $verifyCode;
    public $auth_key;

    public static function tableName()
    {
        return '{{%lambdauser}}';
    }

    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['cert_o', 'name', 'pwd', 'password_repeat'], 'required'],
            // email has to be a valid email address
/*            ['email', 'email'],*/
            // verifyCode needs to be entered correctly
            ['password_repeat', 'compare', 'compareAttribute' => 'pwd'],
        ];
    }

    /**
     * Finds an identity by the given ID.
     *
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string current user auth key
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validatePassword($password) {
       return $this->pwd === md5($password);
    }

    public static function findByUsername($username) {
        return User::findOne(['name' => $username]);
    }

    /**
     * @param string $authKey
     * @return bool if auth key is valid for current user
     */

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

   public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->auth_key = \yii::$app->Security->generateRandomString();
            }
            if (isset($this->pwd)) {
                $this->pwd = md5($this->pwd);
                return parent::beforeSave($insert);
            }
        }
        return true;
    }

    public function getJob() {
        return $this->hasMany(Job::className(), ['user_id' => 'id']);
    }

}