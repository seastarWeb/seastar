<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\MenuMaintenance */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Menu Maintenance', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-maintenance-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id',
            'pid',
            'menu',
            'metadesc',
            'title',
            'excerpt:html',
            'page:html',
            'template',
            'status',
            'version',
            'URL:url',
        ],
    ]) ?>

</div>
