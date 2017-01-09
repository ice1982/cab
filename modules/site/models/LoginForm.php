<?php

namespace app\modules\site\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $login;
    public $password;
    public $test;
    public $checkpasspost;
    public $checkpassproc;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['login', 'password'], 'required'],
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'login' => 'Логин',
            'password' => 'Пароль'
        ];
    }
    
    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        $user = new User;
        
        if ($post = Yii::$app->request->post('LoginForm')) {
            $this->test = $user->User($post['login'], $post['password']);
        }
        if ($this->test == false){
            $this->addError('password','Неверное имя пользователя или пароль.');
        }
        return $this->test;
    }
}
