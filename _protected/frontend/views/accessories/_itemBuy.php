<?php

use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\widgets\ListView;
use yii\widgets\ActiveForm;
use kartik\helpers\Html;
use kartik\dropdown\DropdownX;
use common\models\DucatiClothingCategories;
/* @var $this yii\web\View */
/* @var $model backend\models\TblProductLines */

/*
 *Prepare the part numbers for presentation in dropdown list
 * */
if (count($parts)>1){
  foreach($parts as $part){
      $items[]=[
    'label'=>$part['DESCRIPTION'].' - '.$part['STOCK_LEVEL'].' - '.$part['PARTNO'].' - '.$part['PRICE'],'url'=>Url::toRoute(['shop/add-to-cart','id'=>$part['partid']])
    ];
    }
  }
else{
/* 
Other wise single partnumber is returned to present a button rather than dropdown list.
$items[]=[    'label'=>$parts['DESCRIPTION'].' - '.$parts['STOCK_LEVEL'],'url'=>Url::toRoute(['shop/add-to-cart','id'=>$parts['partid']])   ];
*/

};

/* iterate through models that fit it array and generate labels
*/
if (is_array($to_fit)){
   $out[]='<span class="badge warning">Fits Models</span>';
  foreach($to_fit as $mod){

    //var_dump($mod);
    $out[]='<span class="badge">'.$mod['model_description'].'-'.$mod['year'].'</span><br>';
  }
}else{
  var_dump($to_fit);
  $out[]='<span class="badge">Nowt</span>';
}


//var_dump($out);
$this->title = $model[0]['ProductLine'];
$this->params['breadcrumbs'][] = ['label' => 'Shop', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label'=>$model[0]['Brand'],'url'=> '/shop/index?ShopFor[Brand]='.$model[0]['Brand']];
$this->params['breadcrumbs'][] = $this->title;

      //$noapostrophe=  str_replace('\'','',$model->ProductLine);
      $nopuncs = preg_replace("/[^0-9a-zA-Z- ]/", "", $model[0]['ProductLine']);
      $productline=  strtolower(str_replace(' ','_',$nopuncs));

$image = '/productline/'.strtolower($model[0]['Brand']).'/'.$productline.'/lg.jpg';
$this->title='Buy '.$model[0]['Brand'].' '.$model[0]['ProductLine'].' in the Seastar online shop';
//$image=DucatiClothingCategories::setProductCategoryImage($model).'/lg.jpg';
?>
<div class="tbl-product-lines-view">
    <h1><?= Html::encode($model[0]['ProductLine']) ?></h1>
    <p>
      <div class='row'>
      <div class='col-xs-9 col-sm-10 col-md-11'>
      <?php
        if (count($parts)>1){
            echo Html::Panel(['heading' =>  Html::a('Continue Shopping',Url::previous() , ['class' => 'btn btn-md btn-block']).
              Html::well(Html::encode($model[0]['Description'])).
              Html::beginTag('div', ['class'=>'dropdown']).
              Html::button('<span class="glyphicon glyphicon-shopping-cart pull-left"></span>Select to add to basket </button>', ['type'=>'button', 'class'=>'btn btn-md btn-block btn-default', 'data-toggle'=>'dropdown']).
              DropdownX::widget([ 'items' => $items, ]).
              Html::endTag('div')
                , 'body'=>html::img($image,['class'=>'img-responsive', 'alt'=>'']) , 'footer'=>html::well(Html::encode('See terms and conditions'))]);
        }else{
            echo Html::Panel(['heading' => Html::a('Continue Shopping',Url::previous() , ['class' => 'btn btn-md btn-block']).
              Html::well(Html::encode($model[0]['Description'])).
              Html::a('<span class="glyphicon glyphicon-shopping-cart pull-left"></span> Add to basket', ['/shop/add-to-cart','id'=>$parts[0]['partid']], ['class'=>'btn btn-default btn-block']),
              'body'=>html::img($image,['class'=>'img-responsive', 'alt'=>'']) , 'footer'=>html::well(Html::encode('See terms and conditions'))]);
        }
      ?>
    </div>
    <div class='col-xs-3 col-sm-2 col-md-1'>
      <?php      foreach($out as $item){                echo $item;        };
      ?>
      </div>
    </div>
  </p>
</div>
