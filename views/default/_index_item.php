<?php

/**
 * @var yii\base\View $this View
 * @var vova07\users\models\frontend\User $model Model
 */

use yii\helpers\Html;

?>
<h3><?= Html::a($model->profile['surname'] . ' ' . $model->profile['name'] . ' [' . $model['username'] . ']', ['/users/default/view', 'username' => $model['username']]) ?></h3>