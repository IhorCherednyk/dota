<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "match".
 *
 * @property integer $id
 * @property integer $start_date
 * @property integer $winer_match_team_id
 *
 * @property Games[] $games
 * @property Team $winerMatchTeam
 * @property Tournament[] $tournaments
 */
class Match extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'match';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['start_date', 'winer_match_team_id'], 'required'],
            [['start_date', 'winer_match_team_id'], 'integer'],
            [['winer_match_team_id'], 'exist', 'skipOnError' => true, 'targetClass' => Team::className(), 'targetAttribute' => ['winer_match_team_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'start_date' => 'Start Date',
            'winer_match_team_id' => 'Winer Match Team ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGames()
    {
        return $this->hasMany(Games::className(), ['match_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWinerMatchTeam()
    {
        return $this->hasOne(Team::className(), ['id' => 'winer_match_team_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTournaments()
    {
        return $this->hasMany(Tournament::className(), ['match_id' => 'id']);
    }
}
