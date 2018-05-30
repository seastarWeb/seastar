<?php /*
 * Shopping Basket view file (_cart_item.php)$position is ShopItems model
 * */
?>
<?= $position->partno ?>
<?= ' '.$position->description ?>
<?= ' £'.$position->price ?>
<?= ' '.$position->quantity ?>
<br>
