<?php

use yii\db\Migration;

/**
 * Handles the creation of table `games`.
 * Has foreign keys to the tables:
 *
 * - `match`
 * - `team`
 */
class m170410_131239_create_games_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('games', [
            'id' => $this->primaryKey(),
            'match_id' => $this->integer()->notNull(),
            'winer_team_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `match_id`
        $this->createIndex(
            'idx-games-match_id',
            'games',
            'match_id'
        );

        // add foreign key for table `match`
        $this->addForeignKey(
            'fk-games-match_id',
            'games',
            'match_id',
            'match',
            'id',
            'CASCADE'
        );

        // creates index for column `winer_team_id`
        $this->createIndex(
            'idx-games-winer_team_id',
            'games',
            'winer_team_id'
        );

        // add foreign key for table `team`
        $this->addForeignKey(
            'fk-games-winer_team_id',
            'games',
            'winer_team_id',
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
        // drops foreign key for table `match`
        $this->dropForeignKey(
            'fk-games-match_id',
            'games'
        );

        // drops index for column `match_id`
        $this->dropIndex(
            'idx-games-match_id',
            'games'
        );

        // drops foreign key for table `team`
        $this->dropForeignKey(
            'fk-games-winer_team_id',
            'games'
        );

        // drops index for column `winer_team_id`
        $this->dropIndex(
            'idx-games-winer_team_id',
            'games'
        );

        $this->dropTable('games');
    }
}
