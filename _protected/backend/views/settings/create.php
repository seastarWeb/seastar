<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TblSetting */

$this->title = 'Create Tbl Setting';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Settings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-setting-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
