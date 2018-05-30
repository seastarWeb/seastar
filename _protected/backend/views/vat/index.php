<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SearchVat */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tbl Vats';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-vat-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tbl Vat', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'wef',
            'rate',
            'tds',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
