<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\DeepBlueParts */

$this->title = 'Create Deep Blue Parts';
$this->params['breadcrumbs'][] = ['label' => 'Deep Blue Parts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="deep-blue-parts-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
