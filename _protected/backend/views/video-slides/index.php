<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use common\models\TblModels;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\mpdf\Pdf;
/* @var $this yii\web\View */
/* @var $searchModel common\models\SearchVideos */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tbl Videoslides';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-videoslides-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tbl Videoslides', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'export'=>false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'vid',
            'title',
            'href',
            'type',
            // 'youtube',
            // 'poster',
            ['attribute'=>'model_id', 
            'width'=>'180px',
            'filterType'=>GridView::FILTER_SELECT2,
            'filter'=>ArrayHelper::map(TblModels::find()->orderBy('model,year DESC,model')->asArray()->all(), 'id', 'model'),
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
                ],
            'filterInputOptions'=>['placeholder'=>'Any ...'],
            'format'=>'raw'
            ],
           // 'model_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
