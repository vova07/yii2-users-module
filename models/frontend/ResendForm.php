<?php

namespace vova07\users\models\frontend;

use vova07\users\models\User;
use vova07\users\traits\ModuleTrait;
use yii\base\Model;
use Yii;

/**
 * Class ResendForm
 * @package vova07\users\models
 * ResendForm is the model behind the resend form.
 *
 * @property string $email E-mail
 * @property User $_model User model
 */
class ResendForm extends Model
{
    use ModuleTrait;

    /**
     * @var string $email E-mail
     */
    public $email;

    /**
     * @var User User instance
     */
    private $_model;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // E-mail
            ['email', 'required'],
            ['email', 'trim'],
            ['email', 'email'],
            ['email', 'string', 'max' => 100],
            [
                'email',
                'exist',
                'targetClass' => User::className(),
                'filter' => function ($query) {
                        $query->inactive();
                    }
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'email' => Yii::t('users', 'ATTR_EMAIL')
        ];
    }

    /**
     * Resend email confirmation token
     *
     * @return boolean true if message was sent successfully
     */
    public function resend()
    {
        $this->_model = User::findByEmail($this->email, 'inactive');
        if ($this->_model !== null) {
            return $this->send();
        }
        return false;
    }

    /**
     * Resend an email confirmation token.
     *
     * @return boolean true if email confirmation token was successfully sent
     */
    public function send()
    {
        return $this->module->mail
            ->compose('signup', ['model' => $this->_model])
            ->setTo($this->email)
            ->setSubject(Yii::t('users', 'EMAIL_SUBJECT_SIGNUP') . ' ' . Yii::$app->name)
            ->send();
    }
}
