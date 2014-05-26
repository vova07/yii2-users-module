<?php

/**
 * @var yii\base\View $this
 * @var vova07\users\models\User $model
 */

use yii\helpers\Html;
?>
<h3><?= Html::a($model->profile['surname'] . ' ' . $model->profile['name'] . ' [' . $model['username'] . ']', ['/users/default/view', 'username' => $model['username']]) ?></h3>