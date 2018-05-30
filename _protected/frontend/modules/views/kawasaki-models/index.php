<?php
/* @var $this yii\web\View */
use yii\helpers\Html;

 $this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Kawasaki', 'url' => ['/kawasaki/ ']];
$this->params['breadcrumbs'][]  = ['label' => 'Kawasaki Models', 'url' => ['/kawasaki/kawasaki-models/ ']];
$this->params['breadcrumbs'][]  = $model->title;
 $this->registerMetaTag(['name' => 'description', 'content' => $this->title.' also browse our Kawasaki accessories, spares and clothing at Norwich Kawasaki ']);
  $slides = [
    [
        'title' => '2015 Ducati Panigale 1299',
        'href' => 'https://www.youtube.com/watch?v=TTY5HTcM1iM&list=UUzGsJzGNCfvY9x6Ij2XiODw',
        'type' => 'text/html',
        'youtube' => 'TTY5HTcM1iM',
        'poster' => 'http://www.ducati.com/cms-web/upl/img/bikes/2015/Model_page_main_img/Superbike/Model-Page_2015_SBK1299_Red_01_960x420.jpg',
    ],
    [
        'title' => '2014 Ducati Panigale 899',
        'href' => 'https://www.youtube.com/watch?v=odeOSst4-bs',
        'type' => 'text/html',
        'youtube' => 'odeOSst4-bs',
        'poster' => 'http://www.seastarsuperbikes.co.uk/Ducati%202014/899/800/899%20white%20rhsf.jpg',
    ],
    [
        'title' => '2014 Ducati Monster 1200',
        'href' => 'https://www.youtube.com/watch?v=piS_c1ZD2Ak',
        'type' => 'text/html',
        'youtube' => 'piS_c1ZD2Ak',
        'poster' => 'http://www.seastarsuperbikes.co.uk/Ducati%202014/Monster%201200%20and%20S/800/M-1200_2014_Studio_R_G01_1920x1080_mediagallery_output_image_%5B750x423%5D.jpg',
    ],

    [
        'title' => '2015 Ducati MultiStrada 1200',
        'href' => 'https://www.youtube.com/watch?v=QyKUo2ZlvEw',
        'type' => 'text/html',
        'youtube' => 'QyKUo2ZlvEw',
        'poster' => 'http://www.ducati.com/cms-web/upl/img/bikes/2015/Model_page_main_img/Multistrada/Model-Page_2015_MTS1200S_Red_01_960x420.jpg',
    ],
    [
        'title' => '2015 Ducati Diavel 1200',
        'href' => 'https://www.youtube.com/watch?v=O-GnlaA6ddc',
        'type' => 'text/html',
        'youtube' => 'O-GnlaA6ddc',
        'poster' => 'http://www.ducati.com/cms-web/upl/img/bikes/2015/Model_page_main_img/Diavel/Model-Page_2015_Diavel-Titanium_01_960x420.jpg',
    ],
];
 $slides[]='';
?>
<h1><?=  $model->title ?></h1>
<div class="col-lg-12">
<?=  $model->page ?>
    
    <?= dosamigos\gallery\Carousel::widget([
    'items' => $slides, 'json' => true,
    'clientEvents' => [
        'onslide' => 'function(index, slide) {
            console.log(slide);
        }'
]]); ?>

</div>

<div class="ducati-default-index">


</div>

