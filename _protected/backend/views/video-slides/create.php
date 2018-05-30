<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TblVideoslides */

$this->title = 'Create Tbl Videoslides';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Videoslides', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-videoslides-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
