<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "games".
 *
 * @property integer $id
 * @property integer $match_id
 * @property integer $winer_team_id
 *
 * @property GameInfo[] $gameInfos
 * @property Match $match
 * @property Team $winerTeam
 */
class Games extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'games';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['match_id', 'winer_team_id'], 'required'],
            [['match_id', 'winer_team_id'], 'integer'],
            [['match_id'], 'exist', 'skipOnError' => true, 'targetClass' => Match::className(), 'targetAttribute' => ['match_id' => 'id']],
            [['winer_team_id'], 'exist', 'skipOnError' => true, 'targetClass' => Team::className(), 'targetAttribute' => ['winer_team_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'match_id' => 'Match ID',
            'winer_team_id' => 'Winer Team ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGameInfos()
    {
        return $this->hasMany(GameInfo::className(), ['games_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatch()
    {
        return $this->hasOne(Match::className(), ['id' => 'match_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWinerTeam()
    {
        return $this->hasOne(Team::className(), ['id' => 'winer_team_id']);
    }
}
