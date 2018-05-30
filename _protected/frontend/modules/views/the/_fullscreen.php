<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
// use yii\grid\GridView;
use common\models\TblModelRange;
use common\models\TblModels;
use xj\supersized\Supersized;
/*
Setup supersize widget
*/
$assetsDir = Supersized::widget([
    'theme' => Supersized::THEME_SLIDESHOW,
    'returnType' => Supersized::RETURN_ASSETS,
    'options' => [
        'slide_interval' => 3000,
        'transition' => 3,
        'transition_speed' => 700,
        'slide_links' => 'blank',
        'slides' => [
            ['image' => 'http://buildinternet.s3.amazonaws.com/projects/supersized/3.2/slides/kazvan-1.jpg', 'title' => 'Image Credit: Maria Kazvan'],
            ['image' => 'http://buildinternet.s3.amazonaws.com/projects/supersized/3.2/slides/kazvan-2.jpg', 'title' => 'Image Credit: Maria Kazvan'],
            ['image' => 'http://buildinternet.s3.amazonaws.com/projects/supersized/3.2/slides/kazvan-3.jpg', 'title' => 'Image Credit: Maria Kazvan'],
            ['image' => 'http://buildinternet.s3.amazonaws.com/projects/supersized/3.2/slides/wojno-1.jpg', 'title' => 'Image Credit: Maria Kazvan'],
            ['image' => 'http://buildinternet.s3.amazonaws.com/projects/supersized/3.2/slides/wojno-2.jpg', 'title' => 'Image Credit: Maria Kazvan'],
            ['image' => 'http://buildinternet.s3.amazonaws.com/projects/supersized/3.2/slides/wojno-3.jpg', 'title' => 'Image Credit: Colin Wojno'],
            ['image' => 'http://buildinternet.s3.amazonaws.com/projects/supersized/3.2/slides/shaden-1.jpg', 'title' => 'Image Credit: Colin Wojno'],
            ['image' => 'http://buildinternet.s3.amazonaws.com/projects/supersized/3.2/slides/shaden-2.jpg', 'title' => 'Image Credit: Colin Wojno'],
            ['image' => 'http://buildinternet.s3.amazonaws.com/projects/supersized/3.2/slides/shaden-3.jpg', 'title' => 'Image Credit: Brook Shaden'],
        ]
    ]
]);
?>

<!--Thumbnail Navigation-->
<div id="prevthumb"></div>
<div id="nextthumb"></div>

<!--Arrow Navigation-->
<a id="prevslide" class="load-item"></a>
<a id="nextslide" class="load-item"></a>

<div id="thumb-tray" class="load-item">
    <div id="thumb-back"></div>
    <div id="thumb-forward"></div>
</div>

<!--Time Bar-->
<div id="progress-back" class="load-item">
    <div id="progress-bar"></div>
</div>

<!--Control Bar-->
<div id="controls-wrapper" class="load-item">
    <div id="controls">

        <a id="play-button"><img id="pauseplay" src="<?=$assetsDir?>/img/pause.png"/></a>

        <!--Slide counter-->
        <div id="slidecounter">
            <span class="slidenumber"></span> / <span class="totalslides"></span>
        </div>

        <!--Slide captions displayed here-->
        <div id="slidecaption"></div>

        <!--Thumb Tray button-->
        <a id="tray-button"><img id="tray-arrow" src="<?=$assetsDir?>/img/button-tray-up.png"/></a>

        <!--Navigation-->
        <ul id="slide-list"></ul>

    </div>
</div>