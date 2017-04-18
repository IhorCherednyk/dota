<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%tournament}}".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Match[] $matches
 * @property TournamentHasTeam[] $tournamentHasTeams
 */
class Tournament extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    
    public static function tableName()
    {
        return '{{%tournament}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatches()
    {
        return $this->hasMany(Match::className(), ['tournament_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTournamentHasTeams()
    {
        return $this->hasMany(TournamentHasTeam::className(), ['team_id' => 'id']);
    }
}
