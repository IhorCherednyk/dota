<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

use yii\base\Model;
use app\models\Match;
use Yii;

class TournamentForm extends Model {

    public $model;
    public $Match;
    public $name;
    public $id;

    public function __construct($model = null) {
        if(!is_null($model)){
            $this->model = $model;
            $this->Match = Match::findAll(['tournament_id' => $model->id]);
           
            $this->setAttributes($this->model->getAttributes(), '');
        }else {
            $this->Match = [new Match()];
            $this->model = new Tournament();
        }

    }

    public function isNewRecord() {
        return $this->model->isNewRecord;
    }

    public function save($data,$id = null) {
            $this->model->name = $data['TournamentForm']['name'];
       
            if($this->model->save()){
                $this->setAttributes($this->model->getAttributes(), '');
                $delMatch = Match::deleteAll(['tournament_id' => $this->model->id]);
                
                $matchcount = count($data['TournamentForm']['Match']);
                for ($i = 0; $i < $matchcount; $i++) {
                    $matches[] = new Match();
                }
                foreach ($data['TournamentForm']['Match'] as $key => $match) {
                    $data['TournamentForm']['Match'][$key]['tournament_id'] = $this->model->id;
                }

                
                if (Model::loadMultiple($matches, $data['TournamentForm']) && Model::validateMultiple($matches)) {
                    foreach ($matches as $match) {
                        $match->save(false);
                    }
                    return true;
                }
            }

    }

}
