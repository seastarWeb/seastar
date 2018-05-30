<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\People */
/* @var $form ActiveForm */

// check if total is above finance threshold.
if (1==0){
$finopts=Html::submitButton('Pay Now', ['class' => 'btn btn-success pull-right']); 
}else{
$finopts=Html::submitButton('Pay Now', ['class' => 'btn btn-success pull-right']);
$finopts=Html::submitButton('Finance Now', ['class' => 'btn btn-success pull-right']);
}
$usr=0;
// Member options
if (!Yii::$app->user->isGuest) {
    $tstr=Yii::$app->user->identity->username ;
    $usr=1;
}

?>
<div class="customer">
    <div class="panel panel-default">
      <div class="form-group">
      	<?php 
          echo Html::submitButton('Pay Now', ['class' => 'btn btn-success pull-right','value'=>'Pay', 'name'=>'submit']);
          echo Html::submitButton('Finance Now', ['class' => 'btn btn-success pull-right','value'=>'Finance', 'name'=>'submit']);       
          if ($usr==1) {
            echo Html::submitButton('Reserve Items Now - Members only', ['class' => 'btn btn-success pull-right','value'=>'Reserve', 'name'=>'submit']);
            echo Html::submitButton('Create Wishlist - '.$tstr, ['class' => 'btn btn-success pull-right','value'=>'Wish', 'name'=>'submit']);
      	}else{
          echo Html::submitButton('Reserve Items Now - Members only', ['class' => 'btn btn-success pull-right','disabled' => true,]);
          echo Html::submitButton('Create Wishlist - Members only', ['class' => 'btn btn-success pull-right','disabled' => true,]);
        }?>
        </div>
	</div>
</div>