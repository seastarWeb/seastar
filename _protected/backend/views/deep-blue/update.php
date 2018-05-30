<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\DeepBlueParts */

$this->title = 'Update Deep Blue Parts: ' . ' ' . $model->partid;
$this->params['breadcrumbs'][] = ['label' => 'Deep Blue Parts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->partid, 'url' => ['view', 'id' => $model->partid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="deep-blue-parts-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
