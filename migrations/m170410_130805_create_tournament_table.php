<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tournament`.
 * Has foreign keys to the tables:
 *
 * - `match`
 */
class m170410_130805_create_tournament_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tournament', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50),
        ]);

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tournament');
    }
}
