<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MotodirectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Motor Cycle Gloves';
$this->params['breadcrumbs'][] = ['label'=>$this->title, 'url' => ['?MotodirectSearch[marketCategory]=GLOVES']];
var_dump($pagemodel);
$qp=Yii::$app->request->queryParams;
if (!$qp){
    // no parameters passed to view
}else{
    //prefix the title with the brand name
      if (isset($qp['MotodirectSearch']['brand'])){
            $brand=$qp['MotodirectSearch']['brand'];
             $this->title = $brand.' '.$this->title;
             $this->params['breadcrumbs'][] = ['label'=> $brand] ;
      }
}
?>
<div class="ducati-default-index">
<?php // var_dump($this->URL); ?>
<div class="motodirect-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'productID',
//            'productCode',
            'oneOfficeDescription',
           // 'replicationCode',
//            'tradePrice',
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




</div>

