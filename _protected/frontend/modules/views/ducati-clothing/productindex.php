<?php

//use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;
use kartik\helpers\Html;
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

$this->title = 'Ducati Clothing';
$this->registerMetaTag(['name' => 'description', 'content' => $model->metadesc ]);
$this->params['breadcrumbs'][] = ['label'=> 'Ducati', 'url' => ['/ducati/ ']];
$this->params['breadcrumbs'][] = ['label'=> 'Ducati Clothing', 'url' => ['/ducati/ducati-clothing/ ']];
if (isset(Yii::$app->request->queryParams))
	{
		$cat=Yii::$app->request->queryParams;
		$fred=TblProductlines::find()->select('Category')->distinct()->where(['=','Brand','Ducati'])->andwhere(['LIKE','Category',$cat['Category']])->one();
		$this->params['breadcrumbs'][] = ['label'=> $cat['Category']];
	}
  
$t1=Yii::$app->request->queryParams;

//$cat=($params['plBrowse']['Category']);
/* iterate through search params for next breadcrumb
if ($t1){
	foreach (array_values($t1)[0] as $v)
	{
		$this->params['breadcrumbs'][] =$v;
	}
}
//		$this->params['breadcrumbs'][] =$cat;
*/

//die(print_r($catProvider,true));
?>
<div class="clothing-index">
	<h1><?= Html::encode($this->title) ?></h1>
        <?php Pjax::begin();?>
	   <div class="container">
	       <div class="row">
			<div class="jumbotron">
				<h2><?=$fred->Category ?></h2>
			</div>
		<?php
		echo ListView::widget([
			'dataProvider' => $catProvider,
			'itemOptions' => [
			'container' =>  'infinite',
			'class' => 'item'],
			'itemView' => '_listItem',
		'pager' => ['triggerText'=>'Click for more...','triggerTemplate'=>'<div class="ias-trigger" style="text-align: center; cursor: pointer;"><h3><span class="label label-default"><a>{text}</a></span></h3></div>','noneLeftText'=>'That\'s all folks!!','class' => \kop\y2sp\ScrollPager::className()],
			]);
		?>
		</div>
	   </div>
        <?php Pjax::end();?>
</div>



