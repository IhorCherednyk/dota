<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
use app\models\Team;
use yii\helpers\ArrayHelper;
use app\models\Player;
use app\models\Hero;

/* @var $this yii\web\View */
/* @var $model app\models\Tournament */
/* @var $form yii\widgets\ActiveForm */

$teams = Team::find()->all();
$itemsTeam = ArrayHelper::map($teams, 'id', 'name');
$params = [
    'prompt' => 'Select Team'
];
?>



<div class="tournament-form">
    <style>
        .jsRemoveMatch {
            margin-top: 30px;
        }
    </style>
    <?php
    $form = ActiveForm::begin([
                'id' => 'contact-form',
                'fieldConfig' => [
                    'options' => [
                        'tag' => false,
                    ],
                ],
    ]);
    $arrhero = Hero::find()->all();
    $itemhero = ArrayHelper::map($arrhero, 'id', 'name');
    $itemshero = [
        'prompt' => 'Select Hero'
    ];
    ?>

    <?php ?>
    <h2>Tournament name: <?= $model->name ?></h2>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <div class="col-md-12">

        <h2>Matches</h2>
        <div class="match-form">
            <?php // D($model);?>
            <?php foreach ($model->Match as $key => $match): ?>
                <?php
                $arrmatch = Team::find()->where(['id' => $model->Match[$key]['team_1']])->orWhere(['id' => $model->Match[$key]['team_2']])->all();
                $itemsmatch = ArrayHelper::map($arrmatch, 'id', 'name');
                $itemsmatchparams = [
                    'prompt' => 'Select Winner Team'
                ];
                $arrplayer = Player::find()->where(['team_id' => $model->Match[$key]['team_1']])->orWhere(['team_id' => $model->Match[$key]['team_2']])->all();
                $itemsplayer = ArrayHelper::map($arrplayer, 'id', 'name');
                $itemsplayerparams = [
                    'prompt' => 'Select Player'
                ];
                ?>
                <?php ?>
                <div class="row match">
                    <div class="col-md-4">
                        <?= $form->field($model, 'Match[' . $key . '][team_1]')->dropDownList($itemsTeam, $params)->label('Team 1'); ?>
                    </div> 
                    <div class="col-md-4">
                        <?= $form->field($model, 'Match[' . $key . '][team_2]')->dropDownList($itemsTeam, $params)->label('Team 2'); ?>
                    </div> 
                    <div class="col-md-3">
                        <?= $form->field($model, 'Match[' . $key . '][start_date]')->textInput()->label('Date'); ?>
                    </div>
                    <div class="col-md-1">
                        <?php if ($key >= 1): ?>
                            <button class="jsRemoveMatch">X</button>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-8">

                        <div class="row games">
                            <?php foreach ($match['games'] as $gamekey => $game): ?>
                                <h3>Games: <?= $gamekey + 1 ?></h3>
                                <div class="col-md-12">
                                    <?= $form->field($model, 'Match[' . $key . '][games][' . $gamekey . '][winer_team_id]')->dropDownList($itemsmatch, $itemsmatchparams)->label('Winner Team'); ?>
                                </div>
                                <h3>Game INFO</h3>
                                <?php foreach ($game['gameInfos'] as $infokey => $info): ?>
                                    <div class="col-md-6">
                                        <?= $form->field($model, 'Match[' . $key . '][games][' . $gamekey . '][gameInfos][' . $infokey . '][player_id]')->dropDownList($itemsplayer, $itemsplayerparams)->label('Player Name'); ?>
                                    </div> 
                                    <div class="col-md-6">
                                        <?= $form->field($model, 'Match[' . $key . '][games][' . $gamekey . '][gameInfos][' . $infokey . '][hero_id]')->dropDownList($itemhero, $itemshero)->label('Hero Name'); ?>
                                    </div> 
                                <?php endforeach; ?>

                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <p>
                <?= Html::button('Add one more match', ['class' => 'btn btn-sm red jsAddOneMoreUrl']); ?>
            </p>
        </div> 
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord() ? 'Create' : 'Update', ['class' => $model->isNewRecord() ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?php $this->registerJs("
    
        $(document).on('click', '.jsAddOneMoreUrl', function(){
            var template = createTemplate();
            $(template).insertAfter('.match-form .match:last');

        });
        $(document).on('click', '.jsRemoveMatch', function(){
            if(itemCount = $('.match-form').find('.match').length > 1){
                 $(this).closest('.match').remove();
            }else{
                return false;
            }
        }); 
        function createTemplate(){
            var itemCount = $('.match-form').find('.match').length;
             var template = '<div class=\"row match\">' +
                                '<div class=\"col-md-4\">' +
                                '<label class=\"control-label\" for=\"tournamentform-Match-'+itemCount+'-team_1\">Team 1</label>' +
            '<select id=\"tournamentform-Match-'+itemCount+'-team_1\" class=\"form-control\" name=\"TournamentForm[Match]['+itemCount+'][team_1]\">' +
                '<option value=\"\" selected=\"\">Select Team</option>' +
            '</select>' +   
            '<div class=\"help-block\"></div>' +
                '</div>' +
                '<div class=\"col-md-4\">' +

                    '<label class=\"control-label\" for=\"tournamentform-Match-'+itemCount+'-team_2\">Team 2</label>' +
                    '<select id=\"tournamentform-Match-'+itemCount+'-team_2\" class=\"form-control\" name=\"TournamentForm[Match]['+itemCount+'][team_2]\">'+
                        '<option value=\"\">Select your Team</option>'+
                    '</select>'+

                    '<div class=\"help-block\"></div>'+
                '</div>' +
                '<div class=\"col-md-3\">' +
                    '<label class=\"control-label\" for=\"tournamentform-Match-'+itemCount+'-start_date\">Data</label>' +
                    '<input id=\"tournamentform-Match-'+itemCount+'-start_date\" class=\"form-control\" name=\"TournamentForm[Match]['+itemCount+'][start_date]\" value=\"\">'+
                    '<div class=\"help-block\"></div>' +
                '</div>' +
                                                '<script>' +
                                    'var teams=" . json_encode($itemsTeam) . ";'+
                                    'for(var i in teams){' +
                                    'var el = \"<option value=\'\"+i+\"\'>\"+teams[i]+\"<\/option>\";' +
                                    '$(\"#tournamentform-Match-'+itemCount+'-team_1\").append(el);' +
                                    '$(\"#tournamentform-Match-'+itemCount+'-team_2\").append(el);' +
                                    '}' +
                                    '<\/script>' +
                '<div class=\"col-md-1\">' +
                        '<button class=\"jsRemoveMatch\">X</button>' +
                    '</div>' +
            '</div>'
            return template;
        };

", View::POS_END);
?>


