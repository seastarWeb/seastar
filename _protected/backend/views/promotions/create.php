<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TblPromotion */

$this->title = 'Create Tbl Promotion';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Promotions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-promotion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
