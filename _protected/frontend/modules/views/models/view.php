<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Carousel;
use yii\helpers\Url;
use kartik\tabs\TabsX;
use yii\widgets\ListView;


/* @var $this yii\web\View */
$this->title = $model->model_description;
$this->params['breadcrumbs'][] = ['label' => 'Ducati', 'url' => ['/ducati//']];
$this->params['breadcrumbs'][] = ['label' => 'Ducati Models', 'url' => ['/ducati/ducati-models/ ']];
$this->params['breadcrumbs'][]  = $model->model;
$this->registerMetaTag(['name' => 'description', 'content' => $this->title.' also browse our Ducati accessories, spares and clothing
	at Ducati Norwich ']);
//die(var_dump($slides));
?>
<div class="row">
<h1><?= Html::encode($this->title) ?></h1>

 	<?php	echo TabsX::widget([
    'items' => [
        [
        'label'=>'<span>'.$model->model.' Images</span> ',
		'content'=> Carousel::widget([
    		'items' => $slides]),
        'active'=>true
        ],
        [
        'label'=>'<span>Bike Specifications</span> ',
        'content'=> DetailView::widget([
			'model' => $model,
			'attributes' => [
			'make',
			'model',
			//'colour',
			//'mileage',
			'model_description',
			'id',
			'rrp',
			//'cc',
			//    'from',
			//    'sale_date',
			//    'sale_price',
			//    'sold',
			//'display_price',
			],
		]) ,
        'active'=>false
        ],
        [ 'label'=>'Finance Example',
        	'content'=> DetailView::widget([
            'model' => $finance,
            'condensed'=>true,
            'hover'=>true,
            'mode'=>DetailView::MODE_VIEW,
            'buttons1'=>'{update}',
            'panel'=>[
                'heading'=>'Finance Deal',
      //          'type'=>DetailView::TYPE_INFO,
                ],
            'attributes'=>[
                  ['attribute'=>'plan_name',
                  'format'=>'raw',
                  'value'=>'<span class="text-justify"><em>' . $finance->plan_name .
                  '</em></span>',
                  'type'=>DetailView::INPUT_TEXTAREA,
                  'options'=>['rows'=>4]],
                  ['attribute'=>'deposit',
                  'label'=>'Deposit (£)',
                  'format'=>['decimal', 2],
                  'inputWidth' => '40%',
                  ],
                  ['attribute'=>'total_credit',
                    'label'=>'Total Credit (£)',
                    'format'=>['decimal', 2],
                    'inputWidth' => '40%',
                  ],
                  ['attribute'=>'purchase_fee',
                  'format'=>['decimal', 2],
                  'inputWidth' => '40%',
                  ],
                  ['attribute'=>'credit_facility_fee',
                  'format'=>['decimal', 2],
                  'inputWidth' => '40%',
                  ],
                  ['attribute'=>'total_payable',
                  'format'=>['decimal', 2],
                  'inputWidth' => '40%',
                  ],
                  ['attribute'=>'initial_payment',
                  'format'=>['decimal', 2],
                  'inputWidth' => '40%',
                  ],
                  ['attribute'=>'monthly_payments',
                  'format'=>['decimal', 2],
                  'inputWidth' => '40%',
                  ],
                  ['attribute'=>'optional_final_payment',
                  'format'=>['decimal', 2],
                  'inputWidth' => '40%',
                  ],
                  ['attribute'=>'agreement_duration',
                  'inputWidth' => '40%',
                  ],
                  ['attribute'=>'representative_apr',
                  'inputWidth' => '40%',],
                  ['attribute'=>'interest_rate',
                  'inputWidth' => '40%',],
                  ['attribute'=>'date_from',
                  'format'=>'date',
                  'type'=>DetailView::INPUT_DATE,
                  'value'=>$finance->date_from,
                  'widgetOptions' => [
                      'pluginOptions'=>['format'=>'yyyy-mm-dd']
                    ],

                  ],
                  ['attribute'=>'date_to',
                  'format'=>'date',
                  'type'=>DetailView::INPUT_DATE,
                  'value'=>$finance->date_to,
                  'widgetOptions' => [
                      'pluginOptions'=>['format'=>'yyyy-mm-dd']
                    ],

                  ],
                ]])
        ],

   	],

    'position'=>TabsX::POS_ABOVE,
    'align'=>TabsX::ALIGN_LEFT,
    'bordered'=>false,
    'encodeLabels'=>false]);
 	 ?>

?>

<h1> <?= $model->model_description?></h1>
<p>
This view will require the details of the models to be added.
<?= $model->model_page ?>
</p>
