<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TblModelRange */

$this->title = 'Update Tbl Model Range: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Model Ranges', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
//die(var_dump($model->models));
?>
<div class="tbl-model-range-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
