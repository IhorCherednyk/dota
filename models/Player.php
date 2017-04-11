<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "player".
 *
 * @property integer $id
 * @property string $name
 * @property string $avatar
 *
 * @property GameInfo[] $gameInfos
 * @property PlayerHasTeam[] $playerHasTeams
 */
class Player extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'player';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 100],
            [['avatar'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'avatar' => 'Avatar',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGameInfos()
    {
        return $this->hasMany(GameInfo::className(), ['player_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlayerHasTeams()
    {
        return $this->hasMany(PlayerHasTeam::className(), ['player_id' => 'id']);
    }
}
