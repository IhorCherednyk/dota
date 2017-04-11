<?php

use yii\db\Migration;

/**
 * Handles the creation of table `player_has_team`.
 * Has foreign keys to the tables:
 *
 * - `player`
 * - `team`
 */
class m170410_125957_create_player_has_team_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('player_has_team', [
            'player_id' => $this->integer()->notNull(),
            'team_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `player_id`
        $this->createIndex(
            'idx-player_has_team-player_id',
            'player_has_team',
            'player_id'
        );

        // add foreign key for table `player`
        $this->addForeignKey(
            'fk-player_has_team-player_id',
            'player_has_team',
            'player_id',
            'player',
            'id',
            'CASCADE'
        );

        // creates index for column `team_id`
        $this->createIndex(
            'idx-player_has_team-team_id',
            'player_has_team',
            'team_id'
        );

        // add foreign key for table `team`
        $this->addForeignKey(
            'fk-player_has_team-team_id',
            'player_has_team',
            'team_id',
            'team',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `player`
        $this->dropForeignKey(
            'fk-player_has_team-player_id',
            'player_has_team'
        );

        // drops index for column `player_id`
        $this->dropIndex(
            'idx-player_has_team-player_id',
            'player_has_team'
        );

        // drops foreign key for table `team`
        $this->dropForeignKey(
            'fk-player_has_team-team_id',
            'player_has_team'
        );

        // drops index for column `team_id`
        $this->dropIndex(
            'idx-player_has_team-team_id',
            'player_has_team'
        );

        $this->dropTable('player_has_team');
    }
}
