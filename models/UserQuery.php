<?php

namespace vova07\users\models;

use yii\db\ActiveQuery;
use vova07\users\models\User;
use vova07\users\traits\ModuleTrait;

/**
 * Class UserQuery
 * @package vova07\users\models\query
 */
class UserQuery extends ActiveQuery
{
	use ModuleTrait;

	/**
	 * Select active users.
	 *
	 * @param ActiveQuery $query
	 */
	public function active()
	{
		$this->andWhere(['status_id' => User::STATUS_ACTIVE]);
		return $this;
	}

	/**
	 * Select inactive users.
	 *
	 * @param ActiveQuery $query
	 */
	public function inactive()
	{
		$this->andWhere(['status_id' => User::STATUS_INACTIVE]);
		return $this;
	}

	/**
	 * Select banned users.
	 *
	 * @param ActiveQuery $query
	 */
	public function banned()
	{
		$this->andWhere(['status_id' => User::STATUS_BANNED]);
		return $this;
	}

	/**
	 * Select deleted users.
	 *
	 * @param ActiveQuery $query
	 */
	public function deleted()
	{
		$this->andWhere(['status_id' => User::STATUS_DELETED]);
		return $this;
	}

	/**
	 * Select users with role "user".
	 *
	 * @param ActiveQuery $query
	 */
	public function registered()
	{
		$this->andWhere(['role' => User::ROLE_DEFAULT]);
		return $this;
	}

	/**
	 * Select users with role "user".
	 *
	 * @param ActiveQuery $query
	 */
	public function admin()
	{
		$this->andWhere(['role' => $this->module->adminRoles]);
		return $this;
	}
}
