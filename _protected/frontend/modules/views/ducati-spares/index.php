<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\grid\GridView;
 $this->title = 'Ducati Spares';
// $this->params['breadcrumbs'][] = $model->URL;
 $this->params['breadcrumbs'][] = ['label' => 'Ducati', 'url' => ['/ducati/ ']];
 $this->params['breadcrumbs'][] = ['label' => 'Ducati Spares',];
 $this->registerMetaTag(['name' => 'description', 'content' => $this->title.' also browse our Ducati accessories, spares and clothing at Ducati Norwich ']);
$thumbs = '/uploads/.thumbs/images/';
?>
<h1>Ducati Spares</h1>
<div class="ducati-spares-index">
<?php \yii\widgets\Pjax::begin();?>


<?php \yii\widgets\Pjax::end();?>
</div>
