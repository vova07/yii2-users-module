<?php

namespace vova07\users;

use Yii;
use yii\base\InvalidConfigException;

/**
 * Module [[Users]]
 * Yii2 users module.
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'vova07\users\controllers\frontend';

    /**
     * @var boolean If true after registration user will be required to confirm his e-mail address.
     */
    public $requireEmailConfirmation = true;

    /**
     * @var string E-mail address from that will be sent the module messages
     */
    public $robotEmail;

    /**
     * @var string Name of e-mail sender.
     * By default is `Yii::$app->name . ' robot'`.
     */
    public $robotName;

    /**
     * @var integer The time before a sent activation token becomes invalid.
     * By default is 24 hours.
     */
    public $activationWithin = 86400; // 24 hours

    /**
     * @var integer The time before a sent recovery token becomes invalid.
     * By default is 4 hours.
     */
    public $recoveryWithin = 14400; // 4 hours

    /**
     * @var integer The time before a sent confirmation token becomes invalid.
     * By default is 4 hours.
     */
    public $emailWithin = 14400; // 4 hours

    /**
     * @var integer Users per page
     */
    public $recordsPerPage = 10;

    /**
     * @var array User roles that can access backend module.
     */
    public $adminRoles = ['superadmin', 'admin'];

    /**
     * @var boolean Is module used for backend.
     */
    private $_isBackend;

    /**
     * @var yii\swiftmailer\Mailer Mailer instance
     */
    private $_mail;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if ($this->isBackend === true) {
            $this->setViewPath('@vova07/users/views/backend');
        } else {
            $this->setViewPath('@vova07/users/views/frontend');
        }
    }

    /**
     * Check if module is used for backend application.
     * @return boolean true if it's used for backend application.
     */
    public function getIsBackend()
    {
        if ($this->_isBackend === null) {
            $this->_isBackend = strpos($this->controllerNamespace, 'backend') === false ? false : true;
        }
        return $this->_isBackend;
    }

    /**
     * @return yii\swiftmailer\Mailer Mailer instance with predefined templates.
     */
    public function getMail()
    {
        if ($this->_mail === null) {
            $this->_mail = Yii::$app->getMail();
            $this->_mail->htmlLayout = '@vova07/users/mails/layouts/html';
            $this->_mail->textLayout = '@vova07/users/mails/layouts/text';
            $this->_mail->viewPath = '@vova07/users/mails/views';
            if ($this->robotEmail !== null) {
                $this->_mail->messageConfig['from'] = $this->robotName === null ? $this->robotEmail : [$this->robotEmail => $this->robotName];
            }
        }
        return $this->_mail;
    }
}
