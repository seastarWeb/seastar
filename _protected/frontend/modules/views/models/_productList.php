<?php 
use kartik\helpers\Html;
use evgeniyrru\yii2slick\Slick;
use yii\web\JsExpression;
/*
 * View component for displaying products that have been associated with the model in question.
 */

$slick1= array();
foreach ($products as $product){
	$slick1[]=Html::a($product['Image'],'/shop/for/'.strtolower($product['Brand']).'/'.$product['Url']).' <br>'.Html::bslabel(wordwrap($product['ProductLine'], 40, "<br />\n"), Html::TYPE_WARNING);
    }
 //   die(print_r($slick1));
?> 
    <div class="panel panel-default">
        <div class='carousel'>
            <?php 
             echo Slick::widget([
                'itemContainer' => 'div',
                'containerOptions' => ['class' => 'col-xs-12 col-sm-12 col-md-12'],
                'items' => $slick1,
                'itemOptions' => ['class' => 'image-rounded'],
                'clientOptions' => [
                    'autoplay' => false,
                    'dots'     => true,
                    'lazyLoad' => 'ondemand',
                    'slidesToShow'=>5,
                    'slidesToScroll'=>1,
                    'swipeToSlide'=>true,
                    'responsive'=>[
                    	[
                    	'breakpoint'=>480,
                        'settings' => 'unslick',
                		],
                ],
                // note, that for params passing function you should use JsExpression object
                'onAfterChange' => new JsExpression('function() {console.log("The next product has shown")}'),
                ],
                
               ]); 
            /*
               */
               ?>
        </div>
</div>