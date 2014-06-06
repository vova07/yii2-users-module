<?php

/**
 * @var yii\base\View $this View
 * @var vova07\users\models\frontend\User $model Model
 */

use yii\helpers\Html;

$this->title = $model->profile['surname'] . ' ' . $model->profile['name'] . '[' . $model['username'] . ']';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title); ?></h1>