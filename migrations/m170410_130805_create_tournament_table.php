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
            'match_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `match_id`
        $this->createIndex(
            'idx-tournament-match_id',
            'tournament',
            'match_id'
        );

        // add foreign key for table `match`
        $this->addForeignKey(
            'fk-tournament-match_id',
            'tournament',
            'match_id',
            'match',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `match`
        $this->dropForeignKey(
            'fk-tournament-match_id',
            'tournament'
        );

        // drops index for column `match_id`
        $this->dropIndex(
            'idx-tournament-match_id',
            'tournament'
        );

        $this->dropTable('tournament');
    }
}
