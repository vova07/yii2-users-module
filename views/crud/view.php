<?php

/**
 * @var yii\base\View $this View
 * @var vova07\users\models\backend\User $model User
 */

use vova07\control\Widget;
use yii\widgets\DetailView;

$this->title = Yii::t('users', 'BACKEND_VIEW_TITLE');

echo Widget::widget(
    [
        'title' => $this->title,
        'url' => ['view', 'id' => $model['id']],
        'modelId' => $model['id'],
        'items' => [
            'create' => [
                'visible' => true
            ],
            'update' => [
                'visible' => true
            ],
            'back' => [
                'visible' => true
            ]
        ]
    ]
);

echo DetailView::widget(
    [
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'email',
            [
                'attribute' => 'name',
                'value' => $model->profile->name
            ],
            [
                'attribute' => 'surname',
                'value' => $model->profile->surname
            ],
            'status',
            'created_at:date',
            'updated_at:date'
        ]
    ]
);