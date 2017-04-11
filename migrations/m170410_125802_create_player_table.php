<?php

use yii\db\Migration;

/**
 * Handles the creation of table `player`.
 */
class m170410_125802_create_player_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('player', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
            'avatar' => $this->string(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('player');
    }
}
