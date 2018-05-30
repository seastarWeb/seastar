<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use common\models\Colours;
use common\models\TblProductLines;
// use yii;
 $this->registerJsFile('/js/ntcmod.js');
//Yii::$app()->clientScript->registerScript('/js/ntcmod.js', CClientScript::POS_END);

/* @var $this yii\web\View */
/* @var $model app\models\TblProductLines */

// Get the actual image from the file system to analyse
$prodImg = \Yii::getAlias('@webroot').strtolower('/uploads/images/'.$model->Brand.'/').$model->DefaultImage;
$delta = 160;
$reduce_brightness = true;
$reduce_gradients = true;
$num_results = 5;
$ex=new Colours;
$colors=$ex->Get_Color($prodImg, $num_results, $reduce_brightness, $reduce_gradients, $delta);

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Product Lines', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$viewprodImg = Url::home(true).strtolower('/uploads/images/'.$model->Brand.'/').$model->DefaultImage;

$js = <<<JS
//setup the on click event
$("#colourshade td").click(function(){ alert(ntc.name($(this).text())); });
function getcolours(hexcode){
    return (ntc.name(hexcode));};
JS;
$this->registerJs($js);
$fred = TblProductLines::setProductLineImage($model);

?>
<div class="tbl-product-lines-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="row">
        <div class="col-lg-2">
            <table id='colourshade'>
            <tr><td>Colour</td><td>Name</td><td>Percentage</td>
            <td rowspan="<?php echo (($num_results > 0)?($num_results+1):22500);?>"></td></tr> 
            <?php
            foreach ( $colors as $hex => $count )
        	{ if ( $count > 0 )
        		{ 
        		echo "<tr><td style=\"background-color:#".$hex.";\">".$hex."</td><td></td><td>".sprintf("%.2f%%", $count * 100)."</td></tr>"; 
        		}
        	}
            ?>
            </table>
        </div>
        <div class="col-lg-3">
            <img src=<?=$viewprodImg?>  width="300px">
        </div>
        <div class="col-lg-6">
                <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'Department',
            'Brand',
            'Category',
            'SubCategory',
            'ProductLine',
            'DefaultImage',
            'Fitment',
            'PartNumbers',
            'Description:ntext',
            'Colours',
            'Sizes',
            'Url',
            'Slug',

            ],
        ]) ?>
    </div>

    </div>

</div>
