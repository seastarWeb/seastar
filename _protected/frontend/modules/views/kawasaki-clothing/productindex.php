<?php

//use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;
use kartik\helpers\Html;
use yii\helpers\Url;
use kartik\nav\NavX; 
use kartik\dropdown\DropdownX;
use common\models\DucatiClothingCategories;
use common\models\TblProductlines;

use evgeniyrru\yii2slick\Slick;
use yii\web\JsExpression;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\BikeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kawasaki Clothing';
$this->registerMetaTag(['name' => 'description', 'content' => $model->metadesc ]);
$this->params['breadcrumbs'][] = ['label'=> 'Kawasaki', 'url' => ['/kawasaki/ ']];
$this->params['breadcrumbs'][] = ['label'=> 'Kawasaki Clothing', 'url' => ['/kawasaki/kawasaki-clothing/ ']];
if (isset(Yii::$app->request->queryParams))
	{
		$cat=Yii::$app->request->queryParams;
		$fred=TblProductlines::find()->select('Category')->distinct()->where(['=','Brand','Kawasaki'])->andwhere(['LIKE','Category',$cat['Category']])->one();
		$this->params['breadcrumbs'][] = ['label'=> $cat['Category']];
	}
  
$t1=Yii::$app->request->queryParams;


?>
<div class="kawasaki-clothing-index">
	<h1><?= Html::encode($this->title) ?></h1>
        <?php Pjax::begin();?>
	   <div class="container">
	       <div class="row">
	       	<div class="jumbotron">
	       		<h2><?=$fred->Category ?></h2>
	        </div>
	       	<br>
   	
       	 	<?= \yii\helpers\Html::a( 'Back', Yii::$app->request->referrer); ?>

			<?php
			echo ListView::widget([
				'dataProvider' => $catProvider,
				'itemOptions' => [
				'container' =>  'infinite',
				'class' => 'item'],
				'itemView' => '_listItem',
			'pager' => ['triggerText'=>'Click for  more...','triggerTemplate'=>'<div class="ias-trigger" style="text-align: center; cursor: pointer;"><h3><span class="label label-default"><a>{text}</a></span></h3></div>','noneLeftText'=>'That\'s all folks!!','class' => \kop\y2sp\ScrollPager::className()],
				]);
			?>
			</div>
	   </div>
        <?php Pjax::end();?>
</div>



