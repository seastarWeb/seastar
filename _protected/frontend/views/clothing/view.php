<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\TblProductLines */

$this->title = $model->ProductLine;
$this->params['breadcrumbs'][] = ['label' => 'Shop', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->Brand;
$this->params['breadcrumbs'][] = $this->title;
var_dump($model);
?>
<div class="tbl-product-lines-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'Department',
            'Brand',
            'Category',
            'SubCategory',
            'ProductLine',
            'DefaultImage',
            'Fitment',
            'PartNumbers',
            'Description:ntext',
            'Colours',
            'Sizes',
        ],
    ]) ?>

</div>
