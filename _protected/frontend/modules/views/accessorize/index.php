<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
// use yii\grid\GridView;
use common\models\TblModelRange;
use common\models\Models;
use kartik\grid\GridView;
use yii\bootstrap\Carousel;
use yii\jui\Accordion;
use kartik\nav\NavX;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Button;
use yii\jui\Draggable;
//die(var_dump($dataProvider));
/* @var $this yii\web\View */
/* @var $searchModel common\models\SearchModels */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Accessorize Your Motorcycle ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="models-index">
<h1><?= Html::encode($this->title) ?></h1>
    <div class="col-xs-12 col-sm-12 col-md-12">
    <?php \yii\widgets\Pjax::begin(['id' => 'resultSet']);?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'responsive'=>true,
            'hover'=>true,
            'export'=>false,
            'id'=>'resultSet',
            'columns' => [
                ['attribute'=>'model_range', 
                'width'=>'180px',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(TblModelRange::find()->orderBy('model_range')->asArray()->all(), 'model_range', 'model_range'), 
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                    ],
                'filterInputOptions'=>['placeholder'=>'Any ...'],
                'format'=>'raw'
                ],
                'thumb:html',
                'model',
                'year',

           ],
        ]); 
        ?>
    <?php \yii\widgets\Pjax::end(); ?>
    </div>
</div>




