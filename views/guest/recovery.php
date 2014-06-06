<?php

/**
 * @var yii\base\View $this View
 * @var yii\widgets\ActiveForm $form Form
 * @var vova07\users\models\frontend\User $model Model
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('users', 'FRONTEND_RECOVERY_TITLE');
$this->params['breadcrumbs'][] = $this->title;
?>
    <h1><?php echo Html::encode($this->title); ?></h1>
<?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($model, 'email') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?= Html::submitButton(
                Yii::t('users', 'FRONTEND_RECOVERY_SUBMIT'),
                [
                    'class' => 'btn btn-success pull-right'
                ]
            ) ?>
        </div>
    </div>
<?php ActiveForm::end(); ?>