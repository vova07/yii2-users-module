<?php

namespace vova07\users\models;

use Yii;
use yii\db\ActiveRecord;
use vova07\users\traits\ModuleTrait;

/**
 * Class Profile
 * @package vova07\users\models
 * User profile model.
 *
 * @property integer $user_id User ID
 * @property string $name Name
 * @property string $surname Surname
 */
class Profile extends ActiveRecord
{
    use ModuleTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%profiles}}';
    }

    /**
     * @inheritdoc
     */
    public static function findByUserId($id)
    {
        return static::findOne(['user_id' => $id]);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // Name
            ['name', 'match', 'pattern' => '/^[a-zа-яё]+$/iu'],

            // Surname
            ['surname', 'match', 'pattern' => '/^[a-zа-яё]+(-[a-zа-яё]+)?$/iu']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('users', 'ATTR_NAME'),
            'surname' => Yii::t('users', 'ATTR_SURNAME')
        ];
    }

    /**
     * @return Profile|null Profile user
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id'])->inverseOf('profile');
    }
}
