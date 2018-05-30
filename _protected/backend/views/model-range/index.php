<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SearchModelRange */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tbl Model Ranges';
$this->params['breadcrumbs'][] = $this->title;
// die(var_dump($searchModel));
?>
<div class="tbl-model-range-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tbl Model Range', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'model_range',
            'alias',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
