<?php

use vova07\users\helpers\Security;
use yii\db\Migration;
use yii\db\Schema;
use Yii;

/**
 * CLass m140418_204054_create_module_tbl
 * @package vova07\users\migrations
 *
 * Create module tables.
 *
 * Will be created 3 tables:
 * - `{{%users}}` - Users table.
 * - `{{%profiles}}` - User profiles table.
 * - `{{%user_email}}` - Users email table. This table is used to store temporary new user email address.
 *
 * By default will be added one superadministrator with login: `admin` and password: `admin12345`.
 */
class m140418_204054_create_module_tbl extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        // MySql table options
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        // Users table
        $this->createTable(
            '{{%users}}',
            [
                'id' => Schema::TYPE_PK,
                'username' => Schema::TYPE_STRING . '(30) NOT NULL',
                'email' => Schema::TYPE_STRING . '(100) NOT NULL',
                'password_hash' => Schema::TYPE_STRING . ' NOT NULL',
                'auth_key' => Schema::TYPE_STRING . '(32) NOT NULL',
                'secure_key' => Schema::TYPE_STRING . '(53) NOT NULL',
                'role' => Schema::TYPE_STRING . '(64) NOT NULL DEFAULT "user"',
                'status_id' => 'tinyint(4) NOT NULL DEFAULT 0',
                'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
                'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL'
            ],
            $tableOptions
        );

        // Indexes
        $this->createIndex('username', '{{%users}}', 'username', true);
        $this->createIndex('email', '{{%users}}', 'email', true);
        $this->createIndex('role', '{{%users}}', 'role');
        $this->createIndex('status_id', '{{%users}}', 'status_id');
        $this->createIndex('created_at', '{{%users}}', 'created_at');

        // Users table
        $this->createTable(
            '{{%profiles}}',
            [
                'user_id' => Schema::TYPE_PK,
                'name' => Schema::TYPE_STRING . '(50) NOT NULL',
                'surname' => Schema::TYPE_STRING . '(50) NOT NULL'
            ],
            $tableOptions
        );

        // Foreign Keys
        $this->addForeignKey('FK_profile_user', '{{%profiles}}', 'user_id', '{{%users}}', 'id', 'CASCADE', 'CASCADE');

        // Users emails table
        $this->createTable(
            '{{%user_email}}',
            [
                'user_id' => Schema::TYPE_INTEGER . ' NOT NULL',
                'email' => Schema::TYPE_STRING . '(100) NOT NULL',
                'token' => Schema::TYPE_STRING . '(53) NOT NULL',
                'PRIMARY KEY (`user_id`, `token`)'
            ],
            $tableOptions
        );

        // Foreign Keys
        $this->addForeignKey(
            'FK_user_email_user',
            '{{%user_email}}',
            'user_id',
            '{{%users}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // Add super-administrator
        $this->execute($this->getUserSql());
        $this->execute($this->getProfileSql());
    }

    /**
     * @return string SQL to insert first user
     */
    private function getUserSql()
    {
        $time = time();
        $password_hash = Yii::$app->security->generatePasswordHash('admin12345');
        $auth_key = Yii::$app->security->generateRandomKey();
        $secure_key = Security::generateExpiringRandomKey();
        return "INSERT INTO {{%users}} (`username`, `email`, `password_hash`, `auth_key`, `secure_key`, `role`, `status_id`, `created_at`, `updated_at`) VALUES ('admin', 'admin@demo.com', '$password_hash', '$auth_key', '$secure_key', 'superadmin', 1, $time, $time)";
    }

    /**
     * @return string SQL to insert first profile
     */
    private function getProfileSql()
    {
        return "INSERT INTO {{%profiles}} (`user_id`, `name`, `surname`) VALUES (1, 'Administration', 'Site')";
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_email}}');
        $this->dropTable('{{%users}}');
    }
}
