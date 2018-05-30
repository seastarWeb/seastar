<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ListView;
use kartik\tabs\TabsX;
//ause kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\SearchPL */
/* @var $dataProvider yii\data\ActiveDataProvider */
$control=ucfirst(Yii::$app->controller->id);
$this->title = 'Seastar catalogue of motorcycle clothing';
$this->params['breadcrumbs'][] = ['label'=> $control, 'url' => [Url::toRoute('/'.Yii::$app->controller->id)]];
?>
<div class="container">


    <h1><?= Html::encode($this->title) ?></h1>

            <?php  Pjax::begin();
            echo ListView::widget( ['dataProvider' => $dataProvider,
                        'itemOptions' => [
                        'container' =>  'infinite',
                        'class' => 'col-xs-12 col-sm-6 col-md-4 col-lg-3 vtop',
                        'itemtype'=>'http://schema.org/Product'],
                        'itemView' => '_listCat',
                        'pager' => ['triggerText'=>'Click for more...','triggerTemplate'=>'<div class="ias-trigger" style="text-align: center; cursor: pointer;"><h3><span class="label label-default"><a>{text}</a></span></h3></div>','noneLeftText'=>'That\'s all folks!!','class' => \kop\y2sp\ScrollPager::className()],

                        ])

            ?>

</div>
