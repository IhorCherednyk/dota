<?php

use yii\db\Migration;

/**
 * Handles the creation of table `game_info`.
 * Has foreign keys to the tables:
 *
 * - `player`
 * - `team`
 * - `games`
 * - `hero`
 */
class m170410_131609_create_game_info_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('game_info', [
            'id' => $this->primaryKey(),
            'player_id' => $this->integer()->notNull(),
            'team_id' => $this->integer()->notNull(),
            'games_id' => $this->integer()->notNull(),
            'hero_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `player_id`
        $this->createIndex(
            'idx-game_info-player_id',
            'game_info',
            'player_id'
        );

        // add foreign key for table `player`
        $this->addForeignKey(
            'fk-game_info-player_id',
            'game_info',
            'player_id',
            'player',
            'id',
            'CASCADE'
        );

        // creates index for column `team_id`
        $this->createIndex(
            'idx-game_info-team_id',
            'game_info',
            'team_id'
        );

        // add foreign key for table `team`
        $this->addForeignKey(
            'fk-game_info-team_id',
            'game_info',
            'team_id',
            'team',
            'id',
            'CASCADE'
        );

        // creates index for column `games_id`
        $this->createIndex(
            'idx-game_info-games_id',
            'game_info',
            'games_id'
        );

        // add foreign key for table `games`
        $this->addForeignKey(
            'fk-game_info-games_id',
            'game_info',
            'games_id',
            'games',
            'id',
            'CASCADE'
        );

        // creates index for column `hero_id`
        $this->createIndex(
            'idx-game_info-hero_id',
            'game_info',
            'hero_id'
        );

        // add foreign key for table `hero`
        $this->addForeignKey(
            'fk-game_info-hero_id',
            'game_info',
            'hero_id',
            'hero',
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
            'fk-game_info-player_id',
            'game_info'
        );

        // drops index for column `player_id`
        $this->dropIndex(
            'idx-game_info-player_id',
            'game_info'
        );

        // drops foreign key for table `team`
        $this->dropForeignKey(
            'fk-game_info-team_id',
            'game_info'
        );

        // drops index for column `team_id`
        $this->dropIndex(
            'idx-game_info-team_id',
            'game_info'
        );

        // drops foreign key for table `games`
        $this->dropForeignKey(
            'fk-game_info-games_id',
            'game_info'
        );

        // drops index for column `games_id`
        $this->dropIndex(
            'idx-game_info-games_id',
            'game_info'
        );

        // drops foreign key for table `hero`
        $this->dropForeignKey(
            'fk-game_info-hero_id',
            'game_info'
        );

        // drops index for column `hero_id`
        $this->dropIndex(
            'idx-game_info-hero_id',
            'game_info'
        );

        $this->dropTable('game_info');
    }
}
