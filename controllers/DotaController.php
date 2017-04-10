<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers;


class DotaController extends AppController {
    
    public function actionTournament(){
        return $this->render('tournament');
    }
    
}
