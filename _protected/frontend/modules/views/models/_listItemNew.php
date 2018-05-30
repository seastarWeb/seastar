<?php
$t1 = Yii::$app->controller->module->id;
//die(var_dump($model->pls));
?>
<div class="col-sm-4 col-md-3 col-lg-3">
	<div class="caption">
		<h2 class='label'><?=$model->model?></h2>
		<p class='rrp'>£<?=$model->rrp?></p>
	</div>
	<?=$model->detailthumb ?>

<?php
		if (strpos($t1,'ucati') !== false) {
		    echo "<div class='DucatiCatContainer'></div>";
		}elseif(strpos($t1,'awasaki') !== false) {
		    echo "<div class='KawasakiCatContainer'></div>";
		}elseif(strpos($t1,'rambler') !== false) {
		    echo "<div class='ScramblerCatContainer'></div>";
		}else{
		    echo "<div class='SeastarCatContainer'></div>";
		}
?>
</div>