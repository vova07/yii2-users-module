<?php

/**
 * @var yii\base\View $this View
 * @var vova07\users\models\backend\User $user User
 * @var vova07\users\models\Profile $profile Profile
 * @var array $roleArray Roles array
 * @var array $statusArray Statuses array
 */

use vova07\control\Widget;

$this->title = Yii::t('users', 'BACKEND_CREATE_TITLE');

echo Widget::widget(
    [
        'title' => $this->title,
        'url' => ['index'],
        'items' => [
            'cancel' => [
                'visible' => true
            ]
        ]
    ]
);

echo $this->render(
    '_form',
    [
        'user' => $user,
        'profile' => $profile,
        'roleArray' => $roleArray,
        'statusArray' => $statusArray
    ]
);