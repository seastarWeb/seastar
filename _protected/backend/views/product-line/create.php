<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TblProductLines */

$this->title = 'Create Tbl Product Lines';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Product Lines', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-product-lines-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
