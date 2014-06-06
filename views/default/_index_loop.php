<?php

/**
 * @var yii\base\View $this View
 * @var yii\data\ActiveDataProvider $dataProvider DataProvider
 */

use yii\widgets\ListView;

echo ListView::widget([
    'dataProvider' => $dataProvider,
    'layout' => '<div class="row">{items}</div><div class="row">{pager}</div>',
    'itemView' => '_index_item',
    'itemOptions' => [
        'class' => 'user col-sm-2',
        'tag' => 'article',
        'itemscope' => true,
        'itemtype' => 'http://schema.org/Person'
    ]
]);