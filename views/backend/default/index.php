<?php

/**
 * @var yii\base\View $this View
 * @var yii\data\ActiveDataProvider $dataProvider Data provider
 * @var vova07\users\models\backend\UserSearch $searchModel Search model
 * @var array $roleArray Roles array
 * @var array $statusArray Statuses array
 */

use yii\grid\ActionColumn;
use yii\grid\CheckboxColumn;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\helpers\Html;
use yii\widgets\Pjax;
use vova07\control\Widget;

$this->title = Yii::t('users', 'BACKEND_INDEX_TITLE');

echo Widget::widget([
    'title' => $this->title,
    'url' => ['index'],
    'gridId' => 'users-grid',
    'items' => [
        'create' => [
            'visible' => true
        ]
    ]
]);

Pjax::begin();
    echo GridView::widget([
        'id' => 'users-grid',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => CheckboxColumn::classname()
            ],
            'id',
            [
                'attribute' => 'username',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a($model['username'], ['view', 'id' => $model['id']], ['data-pjax' => 0]);
                }
            ],
            [
                'attribute' => 'name',
                'value' => function ($model) {
                    return $model->profile['name'];
                }
            ],
            [
                'attribute' => 'surname',
                'value' => function ($model) {
                    return $model->profile['surname'];
                }
            ],
            'email',
            [
                'attribute' => 'status_id',
                'value' => function ($model) {
                    return $model->status;
                },
                'filter' => Html::activeDropDownList($searchModel, 'status_id', $statusArray, ['class' => 'form-control', 'prompt' => Yii::t('users', 'BACKEND_PROMPT_STATUS')])
            ],
            [
                'attribute' => 'role',
                'filter' => Html::activeDropDownList($searchModel, 'role', $roleArray, ['class' => 'form-control', 'prompt' => Yii::t('users', 'BACKEND_PROMPT_ROLE')])
            ],
            [
                'class' => ActionColumn::className()
            ]
        ]
    ]);
Pjax::end();