<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
// use yii\grid\GridView;
use common\models\TblModelRange;
use kartik\grid\GridView;
use yii\bootstrap\Carousel;
use yii\jui\Accordion;
use kartik\nav\NavX;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Button;
use yii\jui\Draggable;


/* @var $this yii\web\View */
/* @var $searchModel common\models\SearchModels */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Models';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="models-index">
<h1><?= Html::encode($this->title) ?></h1>
<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<div class="row" >
	<?= Html::a('Create Model', ['create'], ['class' => 'btn btn-success']) ?>
</div>	

	<div class="col-xs-12 col-sm-9 col-md-9">
	<?php \yii\widgets\Pjax::begin(['id' => 'resultSet']);?>
		<?= GridView::widget([
			'dataProvider' => $dataProvider,
			'filterModel' => $searchModel,
			
			'export'=>false,
			'id'=>'resultSet',
			'columns' => [
		//	['class' => 'yii\grid\SerialColumn'],
		//	['attribute'=>'id',
		//	'contentOptions' =>['style'=>'width:50px;'],
		//	],
			['attribute'=>'model_range_id', 
				'width'=>'180px',
				'filterType'=>GridView::FILTER_SELECT2,
				'filter'=>ArrayHelper::map(TblModelRange::find()->orderBy('model_range')->asArray()->all(), 'id', 'model_range'), 
				'filterWidgetOptions'=>[
					'pluginOptions'=>['allowClear'=>true],
					],
				'filterInputOptions'=>['placeholder'=>'Any ...'],
				'format'=>'raw'
			],
			'model_description',
			'model',
			['attribute'=>'year',
			'contentOptions' =>['style'=>'width:80px;'],
			],
			['class' => 'yii\grid\ActionColumn','template'=>'{view}{delete}',],
			],
		]); 
		?>
	</div>
</div>



<?php \yii\widgets\Pjax::end(); ?>
