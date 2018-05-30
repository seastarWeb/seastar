<?php 
/*
 * Basic template for product categories
 *
 */

use common\models\TblProductLines;
use yii\helpers\Url;
use yii\helpers\Html;

$image=TblProductLines::setCategoryImage($model);
$url = Url::toRoute(['clothing/category/'.$model->Category ]);
?> 

<a href=<?=$url?>>
   <?=$image?>
</a>

<h2 itemprop="name"><a href=<?=$url?>><?=strtoupper($model->Category) ?></a></h2>
    

            
