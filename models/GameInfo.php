<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "game_info".
 *
 * @property integer $id
 * @property integer $player_id
 * @property integer $team_id
 * @property integer $games_id
 * @property integer $hero_id
 *
 * @property Games $games
 * @property Hero $hero
 * @property Player $player
 * @property Team $team
 */
class GameInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'game_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['player_id', 'team_id', 'games_id', 'hero_id'], 'required'],
            [['player_id', 'team_id', 'games_id', 'hero_id'], 'integer'],
            [['games_id'], 'exist', 'skipOnError' => true, 'targetClass' => Games::className(), 'targetAttribute' => ['games_id' => 'id']],
            [['hero_id'], 'exist', 'skipOnError' => true, 'targetClass' => Hero::className(), 'targetAttribute' => ['hero_id' => 'id']],
            [['player_id'], 'exist', 'skipOnError' => true, 'targetClass' => Player::className(), 'targetAttribute' => ['player_id' => 'id']],
            [['team_id'], 'exist', 'skipOnError' => true, 'targetClass' => Team::className(), 'targetAttribute' => ['team_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'player_id' => 'Player ID',
            'team_id' => 'Team ID',
            'games_id' => 'Games ID',
            'hero_id' => 'Hero ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGames()
    {
        return $this->hasOne(Games::className(), ['id' => 'games_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHero()
    {
        return $this->hasOne(Hero::className(), ['id' => 'hero_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlayer()
    {
        return $this->hasOne(Player::className(), ['id' => 'player_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeam()
    {
        return $this->hasOne(Team::className(), ['id' => 'team_id']);
    }
}
