<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TblSetting */

$this->title = 'Update Tbl Setting: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Settings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbl-setting-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
