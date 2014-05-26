<?php

/**
 * @var yii\base\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 */

use yii\helpers\Html;

$this->title = Yii::t('users', 'FRONTEND_INDEX_TITLE');
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?php echo Html::encode($this->title); ?></h1>
<?= $this->render('_index_loop', [
	'dataProvider' => $dataProvider
]); ?>