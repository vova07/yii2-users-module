<?php

/**
 * @var yii\base\View $this View
 * @var yii\widgets\ActiveForm $form Form
 * @var vova07\users\models\frontend\User $model Model
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('users', 'FRONTEND_SIGNUP_TITLE');
$this->params['breadcrumbs'][] = $this->title;
?>
    <h1><?= Html::encode($this->title); ?></h1>

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
        <div class="col-sm-12">
            <?=
            Html::submitButton(
                Yii::t('users', 'FRONTEND_SIGNUP_SUBMIT'),
                [
                    'class' => 'btn btn-success btn-large pull-right'
                ]
            ) ?>
            <?= Html::a(Yii::t('users', 'FRONTEND_SIGNUP_RESEND'), ['resend']); ?>
        </div>
    </div>
<?php ActiveForm::end(); ?>