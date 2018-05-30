<?php 
/*
 * View component for displaying motorcycle stock
 * Expects directory of images within lowercase stocknumber e.g. backend/uploads/images/bikestock/a123/
 *
 */

use frontend\models\Product;
 
//$image=Product::getProductImage(strtolower($model->defaultimage),$model->part_no);
$i=$index+1;
$productline=  str_replace('\'','',$model->ProductLine);
$productline=  str_replace(' ','_',$productline);
$productline=  strtolower($productline);
$image='/productline/'.strtolower($model->Brand).'/'.$productline.'/tn.jpg';
    ?> 

       <div class="item">
            <div class="thumbnail">
		<a href='/ducati/ducati-accessories/view?id=1'><img src=<?=$image?> class="img-rounded" alt='<?=$model->ProductLine ?>'></a>
		<div class="caption">
			<h6><?=$model->ProductLine ?></h6>
		</div>
		<p><?= $model->Description ?></p>
		<panel>
		<p><a href="#" class="btn btn-primary btn-sm">Add to basket <?=$model->id?></a> </p>
		</panel>
            </div>
     </div>
<?php
/*
// clear fix for small screen breakdown
 	 if ($i % 2 == 0) { echo ('<div class="clearfix visible-sm-block"></div>'); }
// clear fix for tablet screen breakdown
 	 if ($i % 3 == 0) { echo ('<div class="clearfix visible-md-block"></div>'); }
// stick another row in if it warrents it
 	 if ($i % 6 == 0) { 
     echo ('</div><div class="row">'); 
	     }
*/ 
?>    
