<?php

use yii\db\Migration;

/**
 * Handles the creation of table `match`.
 * Has foreign keys to the tables:
 *
 * - `team`
 */
class m170410_130806_create_match_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('match', [
            'id' => $this->primaryKey(),
            'start_date' => $this->integer()->notNull(),
            'winer_match_team_id' => $this->integer(),
            'tournament_id' => $this->integer()->notNull()
        ]);

        // creates index for column `winer_match_team_id`
        $this->createIndex(
            'idx-match-winer_match_team_id',
            'match',
            'winer_match_team_id'
        );

        // add foreign key for table `team`
        $this->addForeignKey(
            'fk-match-winer_match_team_id',
            'match',
            'winer_match_team_id',
            'team',
            'id',
            'CASCADE'
        );
        
        // creates index for column `match_id`
        $this->createIndex(
            'idx-tournament-match_id',
            'match',
            'tournament_id'
        );

        // add foreign key for table `match`
        $this->addForeignKey(
            'fk-tournament-match_id',
            'match',
            'tournament_id', 
            'tournament',
            'id', 
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `team`
        $this->dropForeignKey(
            'fk-match-winer_match_team_id',
            'match'
        );

        // drops index for column `winer_match_team_id`
        $this->dropIndex(
            'idx-match-winer_match_team_id',
            'match'
        );

        $this->dropTable('match');
    }
}
