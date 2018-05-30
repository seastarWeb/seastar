<?php 
/*
 * Basic template for product categories
 * 
 *
 */

use common\models\DucatiClothingCategories;
$image=DucatiClothingCategories::setClothingCategoryImage($model);
use yii\helpers\Url;
use yii\helpers\Html;
$url = Url::toRoute(['ducati-clothing/browse/'.$model->Category ]);
?> 
<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 vtop" itemscope itemtype="http://schema.org/Product">

	<a href=<?=$url?>>
	    <img itemprop="image" class="img-fullwidth" src="http://placehold.it/400x400?text=product-image">
	</a>

	<h2 itemprop="name"><a href="#"><?=strtoupper($model->Category) ?></a></h2>

	<p><meta itemprop="priceCurrency" content="GBP" />&pound;<span itemprop="price">XX.XX</span></p>
            
</div>
<div class='col-xs-12 col-sm-6 col-md-4 col-lg-3'>
	<div class='DucatiCatContainer'>
		<div class="itemcategory"><?=strtoupper($model->Category) ?></div>
		<a href=<?=$url?>><?=$image?></a>
	</div>
</div>
