<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TblProductLines */

$this->title = 'Update Tbl Product Lines: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Product Lines', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbl-product-lines-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
