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
/* TESSELLATED */
/*
 *Prepare the part numbers for presentation in dropdown list
 * */

if (count($parts)>1){
  foreach($parts as $part){
      $items[]=[
    'label'=>$part['DESCRIPTION'].' - '.$part['STOCK_LEVEL'].' - '.$part['PARTNO'].' - '.$part['PRICE'],'url'=>Url::toRoute(['shop/add-to-cart','id'=>$part['partid']])
    ];
    if ($part['VAT']=='Z'){
      $price=$part['PRICE'];
    }else{
      if ($part['VAT']=='S'){
        $price=$part['PRICE']*1.2;
      }
    }

    }
}elseif(count($parts)>0)
{
/* 
Other wise single partnumber is returned to present a button rather than dropdown list.
$items[]=[    'label'=>$parts['DESCRIPTION'].' - '.$parts['STOCK_LEVEL'],'url'=>Url::toRoute(['shop/add-to-cart','id'=>$parts['partid']])   ];
*/
//die(print_r($parts));
    if ($parts[0]['VAT']=='Z'){
      $price=$parts[0]['PRICE'];
    }else{
      if ($parts[0]['VAT']=='S'){
        $price=$parts[0]['PRICE']*1.2;
      }
    }
    
};

/* iterate through models that fit it array and generate labels
*/
if (is_array($to_fit)){

   $out[]='<h3>Fits Models</h3><br/><p>Click on the models below to see all accessories available</p>';

    foreach($to_fit as $mod){
        $out[]=Html::a($mod['model'].'<span class="glyphicon glyphicon-menu-right transition"></span><br>',['/'.strtolower($mod['make']).'/accessorize/my/'.$mod['alias']] );
    }

}else{
  
  $out[]='<span class="badge">Nowt</span>';

}

$this->title = $model[0]['ProductLine'];
$this->params['breadcrumbs'][] = ['label' => 'Shop', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label'=>$model[0]['Brand'],'url'=> '/shop/index?ShopFor[Brand]='.$model[0]['Brand']];
$this->params['breadcrumbs'][] = ['label'=>$model[0]['Category'],'url'=> '/shop/index?ShopFor[Brand]='.$model[0]['Brand'].'&ShopFor[Category]='.$model[0]['Category']];
$this->params['breadcrumbs'][] = $this->title;

$productline= $model[0]['Url'];
$brand = $model[0]['Brand'];

$image = '/productline/'.strtolower($brand).'/'.$productline.'/lg.jpg';
$this->title='Buy '.$model[0]['Brand'].' '.$model[0]['ProductLine'].' in the Seastar online shop';

?>





<div class="container" itemscope itemtype="http://schema.org/Product">

  <div class="row spacer20">
        
        <div class="col-xs-12 col-md-6 spacer20">
          <span itemprop="brand" itemscope itemtype="http://schema.org/Brand"> by <h6 itemprop="name"><?=Html::encode($model[0]['Brand'])?></h6></span>
            
            <h1 itemprop="name"><?=Html::encode($model[0]['ProductLine'])?></h1>

            <h2><meta itemprop="priceCurrency" content="GBP" /><span itemprop="price"><?=Html::encode('£'.sprintf("%01.2f",$price))?></span> <span class="small">inc. VAT</span></h2>
            
            <span itemprop="description"><?=Html::encode($model[0]['Description'])?></span>
          <p>
            <a href=<?=Url::previous()?> class="btn btn-textonly btn-sm">Continue Browsing <span class="glyphicon glyphicon-menu-right transition"></span></a>
         </p> 
        <div class="spacer10">
         <?php  
              if ($model[0]['Department']=='Accessories'){
                  foreach($out as $item){echo $item; };
                } 
          ?>
        </div>               
        </div>
        
        <div class="col-xs-12 col-md-6 spacer20">
          
          <?=html::img($image,['itemprop'=>'image','class'=>'img-responsive img-fullwidth', 'alt'=>$model[0]['ProductLine']]) ?>          
          <div class="row">
            
            <div class="col-xs-4 col-md-4 spacer20">
              
              <a href="#">
                <img itemprop="image" class="img-fullwidth" src="http://placehold.it/400x400?text=product-image">
              </a>
              
            </div>
            
            <div class="col-xs-4 col-md-4 spacer20">
              
              <a href="#">
                <img itemprop="image" class="img-fullwidth" src="http://placehold.it/400x400?text=product-image">
              </a>
              
            </div>
            
            <div class="col-xs-4 col-md-4 spacer20">
              
              <a href="#">
                <img itemprop="image" class="img-fullwidth" src="http://placehold.it/400x400?text=product-image">
              </a>
              
            </div>
            
            <div class="col-xs-12">
                  
                <div class="productoptionsblock bgdarkgrey">
              
                    <div class="spacer10">
                        <?php 
                           //  echo Url::Previous().'Saved Url for Previous';

                          if (count($parts)>1){
                              echo 
                              Html::beginTag('div', ['class'=>'dropdown']).
                              Html::button('Select to add to basket <span class="glyphicon transition glyphicon-shopping-cart"></span>', ['type'=>'button', 'class'=>'btn btn-block btn-success transition', 'data-toggle'=>'dropdown']).
                              DropdownX::widget([ 'items' => $items, ]).
                              Html::endTag('div');
                          }else{
                              echo 
                              Html::a('Add to basket <span class="glyphicon transition glyphicon-shopping-cart"></span>', ['/shop/add-to-cart','id'=>$parts[0]['partid']], ['class'=>'btn btn-success btn-block transition'],'<span class="glyphicon transition glyphicon-shopping-cart"></span>');
                          }
                        ?>            
                    </div>
                    <div class="spacer10">
                      <?=Html::a('Continue Browsing <span class="glyphicon glyphicon-menu-right transition"></span>',Url::previous() , ['class' => 'btn btn-md btn-success btn-block'])?>
                    </div>

               </div>
            </div>
        
            <div class="col-xs-12 spacer20">
            <?=\imanilchaudhari\rrssb\ShareBar::widget([
                'title' => $model[0]['ProductLine'], // i.e. $model->title
                'media' => html::img($image,['class'=>'img-responsive img-rounded', 'alt'=>$model[0]['ProductLine']]), // Media Content
                'networks' => [
                    'Email',
                    'Facebook',
                    'GooglePlus',
                    'Twitter',
                ]
                ]); 
            ?>         
        
            </div>
          
        </div>
            
      </div>

        
    </div>

</div>  

