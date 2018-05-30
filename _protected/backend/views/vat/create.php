<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TblVat */

$this->title = 'Create Tbl Vat';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Vats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-vat-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
