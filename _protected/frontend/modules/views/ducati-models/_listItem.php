<?php 
/*
 * View component for displaying motorcycle stock
 * Expects directory of images within lowercase stocknumber e.g. backend/uploads/images/bikestock/a123/
 *
 */

use frontend\models\Menu;
 
$image=Menu::getMenuImage($model->imagelocation);
$i=$index+1;

    ?>
	<div class="col-sm-6 col-md-4 col-lg-2">
            <div class="thumbnail">
		<a href=<?=$model->URL?>><img src=<?=$model->imagelocation?> class="img-rounded"
		alt=<?=$model->title?>></a>
		<div class="caption">
		<h6><?=$model->title?></h6>
		</div>
		<p class="text-danger"><?=$model->excerpt?></p>
            </div>
        </div>
<?php
// clear fix for small screen breakdown
 	 if ($i % 2 == 0) { echo ('<div class="clearfix visible-sm-block"></div>'); }
// clear fix for tablet screen breakdown
 	 if ($i % 3 == 0) { echo ('<div class="clearfix visible-md-block"></div>'); }
// stick another row in if it warrents it
 	 if ($i % 6 == 0) { 
     echo ('</div><div class="row">'); 
	     }

	?>    
