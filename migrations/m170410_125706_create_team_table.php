<?php

use yii\db\Migration;

/**
 * Handles the creation of table `team`.
 */
class m170410_125706_create_team_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('team', [
            'id' => $this->primaryKey(),
            'name' => $this->string(45)->notNull(),
            'avatar' => $this->string(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('team');
    }
}
