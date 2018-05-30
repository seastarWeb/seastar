<?php
/* Detail view for main site submenu items
*/
use frontend\models\Menu;
$image=Menu::setMenuImage($model);
//die(var_dump($image));
?>
<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
	<div class="children">
		<a href=<?=$model->URL?>><?=$image?>
		</a>
		<div class="caption">
		<h3 ><?=$model->title?></h3>
		</div>
		<p class="text-danger"><?=$model->excerpt?></p>
<!-- Need to place conditional formatter here for Ducati/Kawasaki/Other -->

		<?php 
        $t1 = $model->title;
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
</div>
