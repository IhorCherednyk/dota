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
            'team_id' => $this->integer()->notNull()
        ]);
        $this->createIndex(
            'idx-player_has_team', 'player', 'team_id'
        );

        // add foreign key for table `team`
        $this->addForeignKey(
                'fk-player_has_team', 'player', 'team_id', 'team', 'id', 'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('player');
        $this->dropForeignKey(
                'fk-player_has_team', 'player'
        );

        // drops index for column `tournament_id`
        $this->dropIndex(
                'idx-player_has_team', 'player'
        );
    }
}
