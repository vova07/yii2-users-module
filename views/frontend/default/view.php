<?php
/**
 * Страница одного пользователя.
 * @var yii\base\View $this
 * @var common\modules\users\models\User $model
 */

use yii\helpers\Html;

$this->title = $model->profile['surname'] . ' ' . $model->profile['name'] . '[' . $model['username'] . ']';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?php echo Html::encode($this->title); ?></h1>