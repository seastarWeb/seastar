<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'part_id',
            'part_no',
            'shortdesc',
            'description:ntext',
            'pricenett',
            array(
'format' => 'image',
'value'=>function($data) { return $data->imagelocation.$data->imagename; },
   ),
            // 'taxcode',
            // 'defaultimage',
            // 'imagelocation',
            // 'imagename',
            // 'brand',
            // 'fitment',
            // 'sku',
            // 'category',
            // 'subcat',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
