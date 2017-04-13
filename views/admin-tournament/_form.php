<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Tournament */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tournament-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <div class="col-md-5">
        <?= Html::label(Yii::t('app', 'Web site URL')); ?>
        <?= Html::textInput('Tournament[0][startDate]', '', ['class' => 'form-control jsUrlField']) ?>
        <?= Html::textInput('Tournament[0][game][0][redTeam]', '', ['class' => 'form-control jsUrlField']) ?>
        <?= Html::textInput('Tournament[0][game][0][blueTeam]', '', ['class' => 'form-control jsUrlField']) ?>
        <?= Html::textInput('Tournament[0][game][1][redTeam]', '', ['class' => 'form-control jsUrlField']) ?>
        <?= Html::textInput('Tournament[0][game][1][blueTeam]', '', ['class' => 'form-control jsUrlField']) ?>
        <?= Html::textInput('Tournament[1][startDate]', '', ['class' => 'form-control jsUrlField']) ?>
        <?= Html::textInput('Tournament[1][game][0][redTeam]', '', ['class' => 'form-control jsUrlField']) ?>
        <?= Html::textInput('Tournament[1][game][0][blueTeam]', '', ['class' => 'form-control jsUrlField']) ?>
        <?= Html::textInput('Tournament[1][game][1][redTeam]', '', ['class' => 'form-control jsUrlField']) ?>
        <?= Html::textInput('Tournament[1][game][1][blueTeam]', '', ['class' => 'form-control jsUrlField']) ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
