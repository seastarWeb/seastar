<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use himiklab\thumbnail\EasyThumbnailImage;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->registerMetaTag(['name' => 'keywords', 'content' => $model->shortdesc ]);
$this->title = $model->shortdesc;
$this->registerMetaTag(['name' => 'description', 'content' => 'Buy '.$this->title.'online with free delivery on order overs £50 or browse our
        Ducati accessories, spares and clothing at Ducati Norwich ']);
$this->params['breadcrumbs'][] = ['label' => 'Ducati Spares', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->title = $this->title.'- Buy Online at Ducati Norwich';
$imgtoprocess=Yii::getAlias('@webroot/images/'.$model->defaultimage);

?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->part_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->part_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'part_id',
            'part_no',
            'shortdesc',
            'description:ntext',
            'pricenett',
            'taxcode',
            'brand',
            'fitment',
            'category',
            'subcat',
        ],
    ]) ?>

</div>
