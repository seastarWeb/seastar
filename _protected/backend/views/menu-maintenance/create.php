<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\MenuMaintenance */

$this->title = 'Create Menu Maintenance';
$this->params['breadcrumbs'][] = ['label' => 'Menu Maintenances', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-maintenance-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
