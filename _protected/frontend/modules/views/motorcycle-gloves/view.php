<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use  yii\web\Session;

/* @var $this yii\web\View */
/* @var $model common\models\Motodirect */

$session = Yii::$app->session;
// check if a session is already open
if ($session->isActive){}else
{
// open a session
 $session->open();
}
// // close a session
// $session->close();
// // destroys all data registered to a session.
// $session->destroy();
//

$this->title = $model->modelDescription;
$this->params['breadcrumbs'][] = ['label' => 'Motorcycle Gloves', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label'=> $model->brand,'url'=>['index?MotodirectSearch[marketCategory]=GLOVES&MotodirectSearch[brand]='.$model->brand]] ;
$this->params['breadcrumbs'][] = $this->title;
$qp=Yii::$app->request->queryParams;
if (!$qp){
    // no parameters passed to view
}else{
    //prefix the title with the brand name
        //$brand=$qp['MotodirectSearch']['brand'];
        $this->title = $model->brand.' '.$this->title;
      //  $this->params['breadcrumbs'][] = ['label'=> $model->brand] ;
//[]['MotodirectSearch']['marketCategory']);
// print_r(MotodirectSearch.['brand']);
}
if ($session->has('basket')){
    $qty = $session['basket']['qty'];
    $qty=$qty + 1;
    if ($session->has('product')){     
	    $session['basket']['product']=[
	    'productcode' => $model->productCode,
	    'size'=> $model->product_size,
	    'qty' => $qty,
	    ];
	    }else{
    $session['basket'] = [
	    'product' => $model->productCode,
	    'size'=> $model->product_size,
	    'qty' => $qty,
	    ];} 
    echo $session['basket']['product'];
    echo '---------';
    echo $session['basket']['qty'].'Qty';
    echo $session['basket']['size'].'Size';
    echo '=======---------';
}else {
    $session['basket'] = [
	    'product' => $model->productCode,
	    'qty' => 1,
	    'size'=> $model->product_size,
	    ];
    echo $session['basket']['product'];
    echo $session['basket']['qty'];
    echo $session['basket']['size'];
    echo 'new--new--new--new';
}
foreach ($session as $session_name => $session_value){
    	echo $session_name.' Session name <br>';
	foreach($session_value as $session_key =>$session_value) {
	    echo $session_key.'--'.$session_value.'<br>';
	   foreach($session_key as $session_item=>$session_value) {
	       echo $session_key.'item'.session_item;
	       foreach($session_item as $item =>$session_value) {
		   echo $item.'~'.$session_value;
	       }
		}
	}
}
?>
<h1><?= Html::encode($this->title) ?></h1>
<div class="row">  
    <div class="col-xs-3">
        <?= Html::img($model->imageURL, ['alt' => $model->oneOfficeDescription]) ?>
    </div>    
    <div class="col-xs-6">
<div class="motodirect-view">
 

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
       //     'productID',
            'productCode',
            'oneOfficeDescription',
        //    'replicationCode',
       //     'tradePrice',
            'salePrice',
    //    'taxCode',
            'brand',
     //       'marketCategory',
            'modelDescription',
            'colourStyle',
     //       'barCode',
     //       'defaultImage',
     //       'imageURL:url',
     //       'productSpecification:ntext',
      //      'deepbluePartNo',
      //      'product_line',
            'product_size',
        ],
    ]) ?>
</div>
</div>
</div>
