<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Team;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Player */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="player-form">

    <?php $form = ActiveForm::begin(); 
        $teams = Team::find()->all();
        $items = ArrayHelper::map($teams,'id','name');
        $params = [
             'prompt' => 'Выберете команду'
        ];
    ?>
        
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'avatar')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'team_id')->dropDownList($items,$params) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
