<?php

namespace vova07\users\controllers;

use vova07\users\models\frontend\Email;
use vova07\users\models\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\HttpException;
use Yii;

/**
 * Default controller.
 */
class DefaultController extends Controller
{
    /**
     * Users page.
     */
    function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find()->active(),
            'pagination' => [
                'pageSize' => $this->module->recordsPerPage
            ]
        ]);

        return $this->render(
            'index',
            [
                'dataProvider' => $dataProvider
            ]
        );
    }

    /**
     * User page.
     *
     * @param string $username Username
     */
    public function actionView($username)
    {
        if (($model = User::findByUsername($username, 'active')) !== null) {
            return $this->render(
                'view',
                [
                    'model' => $model
                ]
            );
        } else {
            throw new HttpException(404);
        }
    }

    /**
     * Confirm new e-mail address.
     *
     * @param string $key Confirmation token
     */
    public function actionEmail($key)
    {
        $model = new Email(['token' => $key]);

        if ($model->isValidToken() === false) {
            Yii::$app->session->setFlash(
                'danger',
                Yii::t('users', 'FRONTEND_FLASH_FAIL_NEW_EMAIL_CONFIRMATION_WITH_INVALID_KEY')
            );
        } else {
            if ($model->confirm()) {
                Yii::$app->session->setFlash(
                    'success',
                    Yii::t('users', 'FRONTEND_FLASH_SUCCESS_NEW_EMAIL_CONFIRMATION')
                );
            } else {
                Yii::$app->session->setFlash('danger', Yii::t('users', 'FRONTEND_FLASH_FAIL_NEW_EMAIL_CONFIRMATION'));
            }
        }

        return $this->goHome();
    }
}
