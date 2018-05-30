<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use kartik\widgets\SideNav;
use yii\widgets\Pjax;
use yii\web\JsExpression;
use execut\widget\TreeView;
Pjax::begin([
    'id' => 'pjax-container',
]);

echo \yii::$app->request->get('page');

Pjax::end();

$onSelect = new JsExpression(<<<JS
function (undefined, item) {
    if (item.href !== location.pathname) {
        $.pjax({
            container: '#pjax-container',
            url: item.href,
            timeout: null
        });
    }

    var otherTreeWidgetEl = $('.treeview.small').not($(this)),
        otherTreeWidget = otherTreeWidgetEl.data('treeview'),
        selectedEl = otherTreeWidgetEl.find('.node-selected');
    if (selectedEl.length) {
        otherTreeWidget.unselectNode(Number(selectedEl.attr('data-nodeid')));
    }
}
JS
);
//die(print_r($items));
/*
$items = [
    [
        'text' => 'Parent 1',
        'href' => Url::to(['', 'page' => 'parent1']),
        'nodes' => [
            [
                'text' => 'Child 1',
                'href' => Url::to(['', 'page' => 'child1']),
                'nodes' => [
                    [
                        'text' => 'Grandchild 1',
                        'href' => Url::to(['', 'page' => 'grandchild1'])
                    ],
                    [
                        'text' => 'Grandchild 2',
                        'href' => Url::to(['', 'page' => 'grandchild2'])
                    ]
                ]
            ],
        ],
    ],
];
*/ 

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SearchMenu */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Site Maintenance';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="menu-maintenance-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
        if (Yii::$app->user->can('admin'))
        {
            ?>

    <p>
        <?= Html::a('Create Page', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php } ?>
<div class="col-xs-2">
<?php
    if (Yii::$app->user->can('admin'))
        {
echo TreeView::widget([
    'data' => $items,
    'size' => TreeView::SIZE_SMALL,
    'clientOptions' => [
    'collapsed' => true,
        'onNodeSelected' => $onSelect,
    ],
]);
    /*     echo SideNav::widget([
          	'options' => ['class' => 'navbar-nav navbar-left'],
           	'items' => $menuItems,
           	]);
*/
    }else{
        echo "SideNav only visible to admin group";
    }
?>
</div>
<div class="col-xs-9">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'pid',
	    ['attribute'=>'parent',
	    'value'=>'parent.menu'
	    ],
            'menu',
            'metadesc',
            'title',
//             'excerpt:ntext',
            // 'page:ntext',
            // 'template',
            // 'status',
            // 'version',
            // 'URL:url',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
</div>
