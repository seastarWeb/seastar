 <?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use backend\models\Categories;
use common\models\TblProductLines;
use backend\models\SearchStock;
//use yii\grid\GridView;
use yii\imagine\Image;
use kartik\widgets\ColorInput;
use kartik\grid\GridView;
use scotthuangzl\googlechart\GoogleChart;

//use yii;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductLineSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Product Lines';
$this->params['breadcrumbs'][] = $this->title;
/*colour Plugin options - to be removed to model.
 *
 * */
$colorPluginOptions =  [
'showPalette' => true,
    'showPaletteOnly' => true,
    'showSelectionPalette' => true,
    'showAlpha' => false,
    'allowEmpty' => true,
    'preferredFormat' => 'name',
    'palette' =>[
        [
        "Red",
        "Orange",
        "Yellow",
        "Brown",
        ],
        [
        "Green",
        "Blue",
        "Purple",
        "Black",
        ],
        [
        "Grey",
        "silver",
        "gold",
        "White" ,
        ],
    ]
];
$categorylevels=SearchStock::getDistinctCategories();
$stocklevels=array();
$stocklevels[]=array('Category','StockLevel');
foreach($categorylevels as $cat){
	$stocklevels[]=array($cat['Category'],intval($cat['StockLevel']));
}
$brandlevels=SearchStock::getStockBrandValues();
//die(var_dump('tf'));
$stockval=array();
$stockval[]=array('Brand','StockLevel');
foreach($brandlevels as $br){
	$stockval[]=array($br['Brand'],intval($br['StockValue']));
}
?>
<div class="tbl-product-lines-index">

    <h1><?= Html::encode($this->title) ?></h1>
<div class='row'>
<div class='col-lg-6'>
<?=GoogleChart::widget(array('visualization' => 'PieChart', 'data'=>$stocklevels ,'options' => array('title' => 'Categories with stock','height'=>500)));?>
</div>
<div class='col-lg-6'>
<?=GoogleChart::widget(array('visualization' => 'PieChart', 'data'=>$stockval ,'options' => array('title' => 'Brands with Nett Price','height'=>500)));?>
</div>

</div>
<p>
        <?= Html::a('Create Product Lines', ['create'], ['class' => 'btn btn-success']) ?>
	</p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'export'=>false,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

           // ['attribute'=>'id',
           //  'contentOptions' =>['style'=>'width:50px;'],
           //     ],
            ['class' => 'yii\grid\ActionColumn'],
            'thumb:html',

            ['attribute'=>'Department','width'=>'8%',],
            ['attribute'=> 'Brand',	
                'width'=>'10%',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(TblProductLines::find()->distinct('Brand')->orderBy('Brand')->asArray()->all(), 'Brand', 'Brand'), 
                'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
                ],
            'filterInputOptions'=>['placeholder'=>'Any ...'],
            'format'=>'raw'
            ],
            ['attribute'=>'Category', 'width'=>'180px',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(Categories::find()->orderBy('Category')->asArray()->all(), 'Category', 'Category'), 
                'filterWidgetOptions'=>[
            	'pluginOptions'=>['allowClear'=>true],
              ],
            'filterInputOptions'=>['placeholder'=>'Any ...'],
            'format'=>'raw'
            ],
    	    [
    	    'attribute'=>'SubCategory', 
    	    'width'=>'180px',
    	    'filterType'=>GridView::FILTER_SELECT2,
    	    'filter'=>ArrayHelper::map(Categories::find()->orderBy('SubCategory')->asArray()->all(), 'SubCategory', 'SubCategory'), 
    	    'filterWidgetOptions'=>[
    		'pluginOptions'=>['allowClear'=>true],
    		      ] ,
    		'filterInputOptions'=>['placeholder'=>'Any ...'],
    		'format'=>'raw'
    	     ],
             'ProductLine',
            [
            'class' => 'kartik\grid\EditableColumn',
            'attribute'=>'Active',
            'value' => function ($model) {
                return $model->Active ? 'Active' : 'On Hold';
                }, 
            'contentOptions'=>['style'=>'max-width: 100px;'],
            'editableOptions' => [
                'header' => 'Activate Product',
                'inputType' => \kartik\editable\Editable::INPUT_SWITCH,
                'format'=>'button',
                ],
            'hAlign'=>'right', 
            'vAlign'=>'middle',
            'width'=>'100px',
            'pageSummary' => true
            ],             
             /*
        	    array(
        		'format' => 'image',
        		'value'=>function($data) { return
        		Yii::$app->urlManagerFrontend->baseUrl.'/productline/'.strtolower($data->Brand).'/'.str_replace(' ', '_', strtolower($data->ProductLine)).'/tn.jpg'; 
                }
        		),
                */
            [
            'attribute'=>'Colours',
            'value'=>function ($model, $key, $index, $widget) {
             return "<span class='badge' style='background-color: {$model->Colours}'> </span>  <code>" . $model->Colours .
             '</code>';
             },
             'contentOptions'=>['style'=>'max-width: 150px;'],
             'width'=>'150px',
             'filterType'=>GridView::FILTER_COLOR,
             'filterWidgetOptions'=>[
             'showDefaultPalette'=>false,
             'pluginOptions'=>$colorPluginOptions,
             ],
            'vAlign'=>'middle',
            'format'=>'raw'
            ],

            // 'DefaultImage',
            // 'Fitment',
            // 'PartNumbers',
            // 'Description:ntext',
        ],
    ]); ?>
</div>
