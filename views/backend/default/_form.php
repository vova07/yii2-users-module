<?php

/**
 * @var yii\base\View $this View
 * @var yii\widgets\ActiveForm $form Form
 * @var vova07\users\models\User $model Model
 * @var array $roleArray Roles array
 * @var array $statusArray Statuses array
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($profile, 'name') ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($profile, 'surname') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($user, 'username') ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($user, 'email') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($user, 'password')->passwordInput() ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($user, 'repassword')->passwordInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($user, 'status_id')->dropDownList($statusArray, [
                'prompt' => Yii::t('users', 'BACKEND_PROMPT_STATUS')
            ]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($user, 'role')->dropDownList($roleArray, [
                'prompt' => Yii::t('users', 'BACKEND_PROMPT_ROLE')
            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?= Html::submitButton($user->isNewRecord ? Yii::t('users', 'BACKEND_CREATE_SUBMIT') : Yii::t('users', 'BACKEND_UPDATE_SUBMIT'), [
                'class' => $user->isNewRecord ? 'btn btn-success btn-large pull-right' : 'btn btn-primary btn-large pull-right'
            ]) ?>
        </div>
    </div>
<?php ActiveForm::end(); ?>