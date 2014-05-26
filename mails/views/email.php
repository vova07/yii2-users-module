<?php

/**
 * @var yii\web\View $this
 * @var vova07\users\models\Email $model
 */

use yii\helpers\Html;
use yii\helpers\Url;

$url = Url::toRoute('/users/guest/email', [
    'key' => $model['token']
]); ?>
<p>Hello,</p>
<p>Follow the link below to confirm your new e-mail:</p>
<p><?= Html::a(Html::encode($url), $url) ?></p>