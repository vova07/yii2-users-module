<?php

namespace vova07\users\models\backend;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use vova07\users\traits\ModuleTrait;

/**
 * User search model.
 *
 * @property string $name Name
 * @property string $surname Surname
 * @property string $username Username
 * @property string $email E-mail
 * @property integer $status_id Status
 */
class UserSearch extends Model
{
    use ModuleTrait;

    /**
     * @var string Name
     */
    public $name;

    /**
     * @var string Surname
     */
    public $surname;

    /**
     * @var string Username
     */
    public $username;

    /**
     * @var string E-mail
     */
    public $email;

    /**
     * @var string Status
     */
    public $status_id;

    /**
     * @var string Role
     */
    public $role;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // String
            [['name', 'surname', 'username', 'email'], 'string'],

            // Role
            ['role', 'in', 'range' => array_keys(User::getRoleArray())],

            // Status
            ['status_id', 'in', 'range' => array_keys(User::getStatusArray())]
        ];
    }

    /**
     * Search users by request criteria.
     * @param array|null Filter params
     * @return yii\data\ActiveDataProvider Data provider with users
     */
    public function search($params)
    {
        $query = User::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $this->module->recordsPerPage
            ]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $this->addCondition($query, 'username', true);
        $this->addCondition($query, 'email', true);
        $this->addCondition($query, 'status_id');
        $this->addCondition($query, 'role');
        $this->addWithCondition($query, 'name', 'profile', 'name');
        $this->addWithCondition($query, 'surname', 'profile', 'surname');

        return $dataProvider;
    }

    /**
     * Add criteria condition.
     * @param yii\db\Query $query Query instance.
     * @param string $attribute Searched attribute name
     * @param boolean $partialMatch Matching type
     */
    protected function addCondition($query, $attribute, $partialMatch = false)
    {
        $value = $this->$attribute;
        if (trim($value) === '') {
            return;
        }
        if ($partialMatch) {
            $query->andWhere(['like', $attribute, $value]);
        } else {
            $query->andWhere([$attribute => $value]);
        }
    }

    /**
     * Add inner join with criteria.
     * @param yii\db\Query $query Query instance
     * @param string $attribute Serched attribute name
     * @param string $relation Relation name
     * @param string $targetAttribute Target attribute name
     * @param boolean $partialMatch matching type
     */
    protected function addWithCondition($query, $attribute, $relation, $targetAttribute, $partialMatch = false)
    {
        $value = $this->$attribute;
        if (trim($value) === '') {
            return;
        }
        if ($partialMatch) {
            $query->innerJoinWith([$relation])
                  ->andWhere(['like', $targetAttribute, $value]);
        } else {
            $query->innerJoinWith([$relation])
                  ->andWhere([$targetAttribute => $value]);
        }
    }
}
