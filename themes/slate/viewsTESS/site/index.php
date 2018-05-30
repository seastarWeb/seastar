<?php

/* @var $this yii\web\View */

use yii\widgets\ListView;
use yii\helpers\Html;
use evgeniyrru\yii2slick\Slick;
use yii\web\JsExpression;
$this->title = $model->title;
$this->registerMetaTag([
        'name' => 'description',
            'content' => Html::encode($model->metadesc) 
        ]);

?>
</div><!-- --escapes original container started in header - will need to eventually tidy -->

<div class="container-fluid hidden-xs">

	<div class="fullwidthimage maxwidth">
		
    <?php
    if ($haspromo==true){
    // Create promotion slider here if required
       
           echo '<p>'.$this->render('_listPromo', ['promos' => $promos, ]).'</p>' ;

        }
              ?>               
        <a href="http://pon.me.uk/ducati/">
	        <img class="img-fullwidth" src="http://www.pon.me.uk/themes/slate/images/slide-images/example-slide.jpg">
	    </a>
    
    </div>

</div>    

<div class="checkerboard ctawrapper">
            
    <div class="container">
                        
        <div class="row">
            
            <div class="col-xs-12 col-sm-7 vcenter ctatext">
                
                <h1><strong>Welcome</strong> to the authorised dealership for Ducati & Kawasaki motorcycles in Norwich</h1>
                
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi commodo, ipsum sed pharetra gravida, orci magna rhoncus neque, id pulvinar odio lorem non turpis. Nullam sit amet enim. Suspendisse id velit vitae ligula volutpat condimentum. Aliquam erat volutpat. Sed quis velit posuere sapien. </p>
                
            </div><!-- required for vcenter
                
            --><div class="col-xs-12 col-sm-3 col-sm-offset-2 vcenter ctatext">
                
                <a class="btn btn-textonly btn-lg" href="#"><strong>Get in touch</strong> <br>or pay us a visit <span class="glyphicon glyphicon-menu-right transition"></span></a> 
                
            </div>
            
        </div>
            
    </div>

</div>

<div class="container-fluid">

	<div class="fullwidthimage maxwidth">
                
        <img class="img-fullwidth" src="http://placehold.it/1400x350?text=1400x350-Showroom">
    
    </div>

</div>  

<div class="fullwidth bgdarkgrey">
	
	<div class="container spacer40">
	                        
	    <div class="row">
	        
	        <div class="col-xs-12 col-sm-6 spacer20">
	            
	            <a class="ctaimage" href="#">
	            	<img class="img-fullwidth ctaimage-image" src="http://www.pon.me.uk/themes/slate/images/cta-images/home-ducati.jpg">
	            	<div class="colorbar ducati"></div>
	            	<h2 class="ctaimage-text whitetext"><strong>Brand New</strong> <br>Ducati Motorcycles</h2>
	            	
	            </a>
	            
	        </div><!-- required for vcenter
	            
	        --><div class="col-xs-12 col-sm-6 spacer20">
	            
	            <a class="ctaimage" href="#">
		            
	            	<img class="img-fullwidth ctaimage-image" src="http://www.pon.me.uk/themes/slate/images/cta-images/home-kawasaki.jpg">
	            	<div class="colorbar kawasaki"></div>
	            	<h2 class="ctaimage-text whitetext"><strong>Brand New</strong> <br>Kawasaki Motorcycles</h2>
	            	
	            </a>
	            
	        </div><!-- required for vcenter
	            
	        --><div class="col-xs-12 col-sm-6 spacer20">
	            
	            <a class="ctaimage" href="#">
		            
	            	<img class="img-fullwidth ctaimage-image" src="http://www.pon.me.uk/themes/slate/images/cta-images/home-scrambler.jpg">
	            	<div class="colorbar scrambler"></div>
	            	<h2 class="ctaimage-text whitetext"><strong>Brand New</strong> <br>Scrambler Motorcycles</h2>
	            	
	            </a>
	            
	        </div><!-- required for vcenter
	            
	        --><div class="col-xs-12 col-sm-6 spacer20">
	            
	            <a class="ctaimage" href="#">
		            
	            	<img class="img-fullwidth ctaimage-image" src="http://www.pon.me.uk/themes/slate/images/cta-images/home-usedbikes.jpg">
	            	<div class="colorbar seastar"></div>
	            	<h2 class="ctaimage-text blacktext"><strong>Selected</strong> <br>Used Motorcycles</h2>
	            	
	            </a>
	            
	        </div><!-- required for vcenter
	            
	        --><div class="col-xs-12 col-sm-6 spacer20">
	            
	            <a class="ctaimage" href="#">
		            
	            	<img class="img-fullwidth ctaimage-image" src="http://www.pon.me.uk/themes/slate/images/cta-images/home-partsaccessories.jpg">
	            	<div class="colorbar seastar"></div>
	            	<h2 class="ctaimage-text whitetext"><strong>Motorcycle</strong> <br>Parts &amp; Accessories</h2>
	            	
	            </a>
	            
	        </div><!-- required for vcenter
	            
	        --><div class="col-xs-12 col-sm-6 spacer20">
	            
	            <a class="ctaimage" href="#">
	            	<img class="img-fullwidth ctaimage-image" src="http://www.pon.me.uk/themes/slate/images/cta-images/home-clothing.jpg">
	            	<div class="colorbar seastar"></div>
	            	<h2 class="ctaimage-text blacktext"><strong>Clothing &amp;</strong> <br>Protective Gear</h2>
	            	
	            </a>
	            
	        </div>
	        
	    </div>
	        
	</div>
	
</div>

<div class="container spacer30">
                        
    <div class="row">
        
        <div class="col-xs-12 col-sm-4 col-sm-border-right">
            
            <div class="homeexcerpt">
	            
	            <h5><a href="#">Recent NEWS article</a></h5>
	            
	            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi commodo, ipsum sed pharetra gravida, orci magna rhoncus neque, id pulvinar odio lorem non turpis. </p>
            
            </div>
            
            <div class="homeexcerpt">
	            
	            <h5><a href="#">Recent NEWS article</a></h5>
	            
	            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi commodo, ipsum sed pharetra gravida, orci magna rhoncus neque, id pulvinar odio lorem non turpis. </p>
            
            </div>
            
        </div>
        
        <div class="col-xs-12 col-sm-4 col-sm-border-right">
            
            <div class="homeexcerpt">
	            
	            <h5><a href="#">Recent blog article</a></h5>
	            
	            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi commodo, ipsum sed pharetra gravida, orci magna rhoncus neque, id pulvinar odio lorem non turpis. </p>
            
            </div>
            
            <div class="homeexcerpt">
	            
	            <h5<a href="#">Recent news article</a></h5>
	            
	            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi commodo, ipsum sed pharetra gravida, orci magna rhoncus neque, id pulvinar odio lorem non turpis. </p>
            
            </div>
            <div class="homeexcerpt">
	            
	            <h5<a href="#">Recent news article</a></h5>
	            
	            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi commodo, ipsum sed pharetra gravida, orci magna rhoncus neque, id pulvinar odio lorem non turpis. </p>
            
            </div>
        </div>
        
        <div class="col-xs-12 col-sm-4">
            
            <div class="col-xs-6 col-sm-12">
	            
            	<img class="img-fullwidth spacer20" src="http://placehold.it/720x240">
            
            </div>
            
            <div class="col-xs-6 col-sm-12">
	            
            	<img class="img-fullwidth spacer20" src="http://placehold.it/720x240">
            
            </div>
            
        </div>
        
    </div>
        
</div>

<div class="fullwidth bgdarkgrey">
	
	<div class="container spacer40">
	                        
	    <div class="row">
                
                   <?php
                   /*
                * List view rendering subform _listItem with paging and images 
                */
                $i=0;
                echo ListView::widget( [
                        'dataProvider' => $dataProvider,
                        'itemView' => '_listItem',
                        'pager' => ['class' => \kop\y2sp\ScrollPager::className()],
                        'layout' => '{items}{pager}','itemOptions' => ['container' =>  'infinite',
                        'class' => 'item'],
                    ]);
                    ?>
        </div>
    </div>
</div>

