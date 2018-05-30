<?php
/* @var $order common\models\Order */
use yii\helpers\Html;
?>

<h1>Seastar Superbikes Order #<?= $order->order_id ?></h1>

<h2>Contact</h2>

<ul>
    <li>Phone: <?= Html::encode($order->phone) ?></li>
        <li>Email: <?= Html::encode($order->email) ?></li>
	</ul>

	<h2>Notes</h2>

	<?= Html::encode($order->notes) ?>

	<h2>Items</h2>

	<ul>
	<?php
	$sum = 0;
	foreach ($order->orderItems as $item): ?>
	<?php $sum += $item->quantity * $item->price ?>
	      <li><?= Html::encode($item->quantity.'x'.$item->title . ' @ £' . $item->price ) ?></li>
	<?php endforeach ?>
	</ul>
	<p><string>Total: </string> 
	
	<?= Html::encode('£'.$sum) ?>
	</p>

