<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tournament_has_team`.
 * Has foreign keys to the tables:
 *
 * - `team`
 * - `tournament`
 */
class m170412_080009_create_tournament_has_team_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tournament_has_team', [
            'id' => $this->primaryKey(),
            'tournament_id' => $this->integer()->notNull(),
            'team_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `tournament_id`
        $this->createIndex(
            'idx-tournament_has_team-tournament_id',
            'tournament_has_team',
            'tournament_id'
        );

        // add foreign key for table `team`
        $this->addForeignKey(
            'fk-tournament_has_team-tournament_id',
            'tournament_has_team',
            'tournament_id',
            'team',
            'id',
            'CASCADE'
        );

        // creates index for column `team_id`
        $this->createIndex(
            'idx-tournament_has_team-team_id',
            'tournament_has_team',
            'team_id'
        );

        // add foreign key for table `tournament`
        $this->addForeignKey(
            'fk-tournament_has_team-team_id',
            'tournament_has_team',
            'team_id',
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
            'fk-tournament_has_team-tournament_id',
            'tournament_has_team'
        );

        // drops index for column `tournament_id`
        $this->dropIndex(
            'idx-tournament_has_team-tournament_id',
            'tournament_has_team'
        );

        // drops foreign key for table `tournament`
        $this->dropForeignKey(
            'fk-tournament_has_team-team_id',
            'tournament_has_team'
        );

        // drops index for column `team_id`
        $this->dropIndex(
            'idx-tournament_has_team-team_id',
            'tournament_has_team'
        );

        $this->dropTable('tournament_has_team');
    }
}
