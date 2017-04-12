<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Player;

/**
 * PlayerSearch represents the model behind the search form about `app\models\Player`.
 */
class PlayerSearch extends Player
{
    /**
     * @inheritdoc
     */
    public $teamName;
    
    public function rules()
    {
        return [
            [['id', 'team_id'], 'integer'],
            [['name', 'avatar','teamName'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Player::find()->alias('p');
        $query->select(['p.*', 't.name as teamName']);
        $query->leftJoin('team t', 'team_id = t.id');
        
//        $query->groupBy('p.id');
//        echo  $query->createCommand()->getRawSql();die(); 

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'p.name', $this->name])
            ->andFilterWhere(['like', 't.name', $this->teamName]);
//        echo  $query->createCommand()->getRawSql();die(); 
        return $dataProvider;
    }
}
