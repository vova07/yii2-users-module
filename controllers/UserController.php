<?php

namespace vova07\users\controllers;

use vova07\users\models\frontend\Email;
use vova07\users\models\frontend\PasswordForm;
use vova07\users\models\Profile;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;
use Yii;

/**
 * Frontend controller for authenticated users.
 */
class UserController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ]
        ];
    }

    /**
     * Log Out page.
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Change user password page.
     */
    public function actionPassword()
    {
        $model = new PasswordForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->password()) {
                    Yii::$app->session->setFlash('success', Yii::t('users', 'FRONTEND_FLASH_SUCCESS_PASSWORD_CHANGE'));
                    return $this->redirect(['/users/default/view', 'username' => Yii::$app->user->identity->username]);
                } else {
                    Yii::$app->session->setFlash('danger', Yii::t('users', 'FRONTEND_FLASH_FAIL_PASSWORD_CHANGE'));
                    return $this->refresh();
                }
            } elseif (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
        }

        return $this->render(
            'password',
            [
                'model' => $model
            ]
        );
    }

    /**
     * Request email change page.
     */
    public function actionEmail()
    {
        $model = new Email();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->save(false)) {
                    Yii::$app->session->setFlash('success', Yii::t('users', 'FRONTEND_FLASH_SUCCES_EMAIL_CHANGE'));
                    return $this->redirect(['/users/default/view', 'username' => Yii::$app->user->identity->username]);
                } else {
                    Yii::$app->session->setFlash('danger', Yii::t('users', 'FRONTEND_FLASH_FAIL_EMAIL_CHANGE'));
                    return $this->refresh();
                }
            } elseif (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
        }

        return $this->render(
            'email',
            [
                'model' => $model
            ]
        );
    }

    /**
     * User update page.
     */
    public function actionUpdate()
    {
        $model = Profile::findByUserId(Yii::$app->user->id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->save(false)) {
                    Yii::$app->session->setFlash('success', Yii::t('users', 'FRONTEND_FLASH_SUCCES_UPDATE'));
                } else {
                    Yii::$app->session->setFlash('danger', Yii::t('users', 'FRONTEND_FLASH_FAIL_UPDATE'));
                }
                return $this->refresh();
            } elseif (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
        }

        return $this->render(
            'update',
            [
                'model' => $model
            ]
        );
    }
}
