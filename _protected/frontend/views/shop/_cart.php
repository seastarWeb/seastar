<?php /*
 * Shopping Basket view file (_cart_item.php)$position is ShopItems model
 * */
?>
<div class="col-sm-6">
<?php
        /** @var ShoppingCart $sc */
        foreach(Yii::$app->cart->positions as $position){
	              echo $this->render('_cart_item',['position'=>$position]);
	        }
  ?>
</div>
