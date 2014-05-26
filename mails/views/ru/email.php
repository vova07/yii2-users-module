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
<p>Здравствуйте!</p>
<p>Перейдите по ссылке ниже чтобы подтвердить новый электронный адрес:</p>
<p><?= Html::a(Html::encode($url), $url) ?></p>