<?php

/**
 * @var yii\web\View $this
 * @var vova07\users\models\User $model
 */

use yii\helpers\Html;
use yii\helpers\Url;

$url = Url::toRoute(['/users/guest/recovery', 'key' => $model['secure_key']], true); ?>
<p>Здравствуйте <?= Html::encode($model['username']) ?>!</p>
<p>Перейдите по ссылке ниже чтобы восстановить пароль:</p>
<p><?= Html::a(Html::encode($url), $url) ?></p>