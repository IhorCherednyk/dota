<?php

namespace app\controllers;

use Yii;
use app\models\Tournament;
use app\models\TournamentSearch;
use app\controllers\BackController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Match;
use yii\base\Model;

/**
 * AdminTournamentController implements the CRUD actions for Tournament model.
 */
class AdminTournamentController extends BackController {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Tournament models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TournamentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tournament model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Tournament model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Tournament();
        $count = count(Yii::$app->request->post('Match', []));
        D($count);
        $matches = [new Match()];
        for ($i = 1; $i < 3; $i++) {
            $matches[] = new Match();
        }
//        D($_POST);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
                        'matches' => $matches
            ]);
        }
    }

//    public function actionCreate()
//    {
//            $model = new Tournament();
//            //Find out how many products have been submitted by the form
//            $count = count(Yii::$app->request->post('Match', []));
//
//            //Send at least one model to the form
//            $matches = [new Match()];
//
//            //Create an array of the products submitted
//            for ($i = 1; $i < $count; $i++) {
//                $matches[] = new Match();
//            }
//            //Load and validate the multiple models
//            if (Model::loadMultiple($matches, Yii::$app->request->post()) && Model::validateMultiple($matches)) {
//
//                foreach ($matches as $match) {
//                    //Try to save the models. Validation is not needed as it's already been done.
//                    $match->save(false);
//                }
//                return $this->redirect('view');
//            }
//
//            return $this->render('create', ['matches' => $matches, 'model' => $model]);
//    }

    /**
     * Updates an existing Tournament model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        D($_POST);
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Tournament model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tournament model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tournament the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Tournament::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
