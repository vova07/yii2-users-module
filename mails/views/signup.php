<?php

/**
 * @var yii\web\View $this
 * @var vova07\users\models\frontend\User $model
 */

use yii\helpers\Html;
use yii\helpers\Url;

$url = Url::toRoute(['/users/guest/activation', 'key' => $model['secure_key']]); ?>
<p>Hello <?= Html::encode($model['username']) ?>,</p>
<p>Follow the link below to activate your account:</p>
<p><?= Html::a(Html::encode($url), $url) ?></p>