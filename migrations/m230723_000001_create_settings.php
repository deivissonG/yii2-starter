<?php

use yii\db\Migration;

/**
 * Class m230301_173244_create_settings
 */
class m230723_000001_create_settings extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%settings}}', [
            'name' => $this->string()->notNull(),
            'value' => $this->string(),
            'active' => $this->tinyInteger()->defaultValue(1)->notNull(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp()
        ]);

        $this->addPrimaryKey('settings_pk', '{{%settings}}', 'name');

        $this->insert('{{%settings}}', [
            'name' => 'logo',
            'value' => '/default.png'
        ]);

        $this->insert('{{%settings}}', [
            'name' => 'application_name',
            'value' => 'Application name'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%settings}}');
        $this->dropTable('{{%settings}}');
    }
}
