<?php

/**
 * @var yii\base\View $this View
 * @var yii\widgets\ActiveForm $form Form
 * @var vova07\users\models\LoginForm $model Model
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('users', 'BACKEND_LOGIN_TITLE');
$this->params['breadcrumbs'][] = $this->title;
?>
    <h1><?php echo Html::encode($this->title); ?></h1>
<?php $form = ActiveForm::begin(
    [
        'fieldConfig' => [
            'template' => "<div class=\"row\"><div class=\"col-sm-6\"{label}\n{input}\n{hint}\n{error}</div></div>",
        ]
    ]
); ?>
<?= $form->field($model, 'username') ?>
<?= $form->field($model, 'password')->passwordInput() ?>
<?= $form->field($model, 'rememberMe')->checkbox() ?>
    <div class="row">
        <div class="col-sm-6">
            <?= Html::submitButton(Yii::t('users', 'BACKEND_LOGIN_SUBMIT'), ['class' => 'btn btn-primary']) ?>
            &nbsp;
            <?= Yii::t('users', 'BACKEND_LOGIN_OR') ?>
            &nbsp;
            <?= Html::a(Yii::t('users', 'BACKEND_LOGIN_RECOVERY'), ['recovery']) ?>
        </div>
    </div>
<?php ActiveForm::end(); ?>