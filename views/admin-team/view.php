<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Team */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Teams', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="team-view">
    <style>
        table.detail-view th {
            width: 25%;
        }

        table.detail-view td {
            width: 75%;
        }
    </style>
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Create Team', ['creates'], ['class' => 'btn btn-success']) ?>
        <?=
        Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'avatar',
        ],
    ])
    ?>

    <h2>Players</h2>
    <?php
    foreach ($players as $key => $value) {
        echo DetailView::widget([
            'model' => $value,
            'attributes' => [
                'name',
                    [
                    'label' => 'Show Detail',
                    'format' => 'raw',
                    'value' => function ($data) {
                        return Html::a('detail', ['/admin-player/view', 'id' => $data->id],['class' => 'btn btn-success']);
                    },
                ],
            ],
        ]);
    }
    ?>



</div>
