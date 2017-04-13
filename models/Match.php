<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "match".
 *
 * @property integer $id
 * @property integer $start_date
 * @property integer $winer_match_team_id
 * @property integer $tournament_id
 *
 * @property Games[] $games
 * @property Team $winerMatchTeam
 * @property Tournament $tournament
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
            [['start_date', 'tournament_id'], 'required'],
            [['start_date', 'winer_match_team_id', 'tournament_id'], 'integer'],
            [['winer_match_team_id'], 'exist', 'skipOnError' => true, 'targetClass' => Team::className(), 'targetAttribute' => ['winer_match_team_id' => 'id']],
            [['tournament_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tournament::className(), 'targetAttribute' => ['tournament_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'start_date' => Yii::t('app', 'Start Date'),
            'winer_match_team_id' => Yii::t('app', 'Winer Match Team ID'),
            'tournament_id' => Yii::t('app', 'Tournament ID'),
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
    public function getTournament()
    {
        return $this->hasOne(Tournament::className(), ['id' => 'tournament_id']);
    }
}
