<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MotodirectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Motor Cycle Helmets';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="motodirect-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Motodirect', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'productID',
            'productCode',
            'oneOfficeDescription',
           // 'replicationCode',
            'tradePrice',
            // 'salePrice',
            // 'taxCode',
             'brand',
             'marketCategory',
            // 'modelDescription',
             'colourStyle',
            // 'barCode',
                            array(
                            'format' => 'image',
                            'value'=>function($data) { return $data->imageURL; }, 
                               ),
            // 'defaultImage',
            // 'imageURL:url',
            // 'productSpecification:ntext',
            // 'deepbluePartNo',
             'product_line',
             'product_size',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

<div class="ducati-default-index">


</div>

