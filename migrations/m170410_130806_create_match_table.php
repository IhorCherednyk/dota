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
            'tournament_id' => $this->integer()->notNull(),
            'team_1' => $this->integer()->notNull(),
            'team_2' => $this->integer()->notNull(),
        ]);
        // creates index for column `match_id`
        $this->createIndex(
                'idx-team_1_id', 'match', 'team_1'
        );

        // add foreign key for table `match`
        $this->addForeignKey(
                'fk-team_1_id', 'match', 'team_1', 'team', 'id', 'CASCADE'
        );
        // creates index for column `match_id`
        $this->createIndex(
                'idx-team_2_id', 'match', 'team_2'
        );

        // add foreign key for table `match`
        $this->addForeignKey(
                'fk-team_2_id', 'match', 'team_2', 'team', 'id', 'CASCADE'
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
            'fk-tournament-match_id',
            'match'
        );

        // drops index for column `winer_match_team_id`
        $this->dropIndex(
            'idx-tournament-match_id',
            'match'
        );
        $this->dropForeignKey(
            'fk-team_1_id',
            'match'
        );

        // drops index for column `winer_match_team_id`
        $this->dropIndex(
            'idx-team_1_id',
            'match'
        );
         $this->dropForeignKey(
                'fk-team_2_id', 'match'
        );

        // drops index for column `winer_match_team_id`
        $this->dropIndex(
                'idx-team_2_id', 'match'
        );

        $this->dropTable('match');
    }
}
