<?php
use frontend\assets\AppAsset;
use frontend\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use kartik\nav\NavX;
use kartik\form\ActiveForm;
use evgeniyrru\yii2slick\Slick;
use yii\web\JsExpression;

/* @var $this \yii\web\View */
/* @var $content string */
// Activate Cart if required
$itemsCount = \Yii::$app->cart->getCount();
//$itemsCount=0;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <link rel="shortcut icon" href="<?php echo Yii::$app->request->baseUrl; ?>/favicon.ico" type="image/x-icon" />
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <link href="https://plus.google.com/{+PageId}" rel="publisher">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <div class="wrap">

        <div class="container header">
            
            <div class="fullwidthcontent hidden-phone">
                
                <div class="row">
                    
                    <div id="dh_topnavbar" class="col-xs-12 col-sm-10 col-sm-offset-2">
                        <?php
                            NavBar::begin([
                                'brandLabel' => Yii::t('app', Yii::$app->name),
                                'brandUrl' => Yii::$app->homeUrl,
                                'options' => [
                                    'class' => 'navbar-dh',
                                ],
                            ]);
                
                            // everyone can see Blog, About and Contact pages
                            $menuItems[] = ['label' => Yii::t('app', 'Blog'), 'url' => ['/blog/']];
                            $menuMainItems=frontend\models\Menu::getMenu();        
                
                            // we do not need to display Article/index, About and Contact pages to editor+ roles
                            if (!Yii::$app->user->can('editor')) 
                            {
                                
                             //   $menuItems[] = ['label' => Yii::t('app', 'Articles'), 'url' => ['/article/index']];
                                $menuItems[] = ['label' => Yii::t('app', 'About'), 'url' => ['/site/about']];
                                $menuItems[] = ['label' => Yii::t('app', 'Contact'), 'url' => ['/site/contact']];
                            }
                
                            // display Article admin page to editor+ roles
                            if (Yii::$app->user->can('editor'))
                            {
                                $menuItems[] = ['label' => Yii::t('app', 'Articles'), 'url' => ['/article/admin']];
                            }            
                            
                
                            $menuItems[]='<li>
                                        <form class="navbar-form" role="search" action="/find/our/">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search" name="SearchTerm" id="SearchTerm">
                                            <div class="input-group-btn">
                                                <button class="btn btn-search-dh" type="submit"><i class="glyphicon glyphicon-sm glyphicon-search"></i></button>
                                            </div>
                                        </div>
                                        </form>
                                        </li>';
                
                            if ($itemsCount > 0){
                                $menuItems[]=['label'=>$itemsCount, 'url'=>['/cart/list'],'linkOptions'=>['class'=>'glyphicon glyphicon-shopping-cart pull-right red']];
                            }
                            // display Signup and Login pages to guests of the site
                            if (Yii::$app->user->isGuest) 
                            {
                              //  $menuItems[] = ['label' => Yii::t('app', 'Signup'), 'url' => ['/site/signup']];
                                $menuItems[] = ['label' => Yii::t('app', 'Login'), 'url' => ['/site/login']];
                            }
                            // display Logout to all logged in users
                            else 
                            {
                                $menuItems[] = [
                                    'label' => Yii::t('app', 'Logout'). ' (' . Yii::$app->user->identity->username . ')',
                                    'url' => ['/site/logout'],
                                    'linkOptions' => ['data-method' => 'post']
                                ];
                            }
                        
                            echo Nav::widget([
                                'options' => ['class' => 'navbar-nav navbar-right'],
                                'items' => $menuItems,
                            ]);
                            
                            NavBar::end();
                        ?> 
                    </div>
                    
                </div><!--.row -->
                
            </div><!--.fullwidthcontent -->
            
        </div>
            <div class="row-fluid">
                <div class=".col-xs-12 col-sm-6">
                    <a href="http://www.pon.me.uk/" title="Seastar Superbikes"><img src="/themes/slate/images/seastarsuperbikeslogo.png" alt="Seastar Superbikes" class="seastarlogo"></a>
                </div>

                <div class="col-sm-6 headercontact hidden-phone">
                    <a href="tel:01508%20471919">01508 471919</a><br>
                    <a href="mailto:info@seastarsuperbikes.co.uk">info@seastarsuperbikes.co.uk</a>
                </div>
            </div>
                <?= Alert::widget() ?>
            <div id="dh_mainnavbar" class="fullwidthcontent">
                    

                <nav id="w4" class="navbar-main-dh navbar-default navbar" role="navigation">
                    <div class="container">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#w4-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div id="w4-collapse" class="collapse navbar-collapse">
                            <ul id="w5" class="navbar-nav nav">
                                <li><a href="/">Home</a></li>
                                <li><a href="/ducati/" class="has-children">Ducati</a>
                                    <div class="sub-menu ducatimenu">
                                        <div class="inner-container">
                                            <div class="top-menu">
                                                <ul class="clearfix">
                                                    <li class="active has-children"><a href="/ducati/models/">New Ducati Bikes</a></li>
                                                    <li><a href="/ducati/ducati-clothing">Ducati Clothing</a></li>
                                                </ul>
                                            </div>
                                            <div class="products-slider">
                                                <div class="product">
                                                    <div class="product-image">
                                                        <img src="/menu-images/ducati-diavel.jpg" />
                                                    </div>
                                                    <ul class="product-list">
                                                        <li class="main"><a href="#">Diavel</a></li>
                                                    </ul>
                                                </div>
                                                <div class="product">
                                                    <div class="product-image">
                                                        <img src="/menu-images/ducati-superbikes.jpg" />
                                                    </div>
                                                    <ul class="product-list">
                                                        <li class="main">Superbikes</li>
                                                        <li><a href="#">899 Panigale</a></li>
                                                        <li><a href="#">1299 Panigale</a></li>
                                                        <li><a href="#">1299S Panigale</a></li>
                                                        <li><a href="#">1199R Panigale</a></li>
                                                    </ul>
                                                </div>
                                                <div class="product">
                                                    <div class="product-image">
                                                        <img src="/menu-images/ducati-streetfighter.jpg" />
                                                    </div>
                                                    <ul class="product-list">
                                                        <li class="main"><a href="#">Streetfighter</a></li>
                                                    </ul>
                                                </div>
                                                <div class="product">
                                                    <div class="product-image">
                                                        <img src="/menu-images/ducati-hypermotard.jpg" />
                                                    </div>
                                                    <ul class="product-list">
                                                        <li class="main">Hypermotard</li>
                                                        <li><a href="#">Hypermotard</a></li>
                                                        <li><a href="#">HypermotardSP</a></li>
                                                    </ul>
                                                </div>
                                                <div class="product">
                                                    <div class="product-image">
                                                        <img src="/menu-images/ducati-hyperstrada.jpg" />
                                                    </div>
                                                    <ul class="product-list">
                                                        <li class="main"><a href="#">Hyperstrada</a></li>
                                                    </ul>
                                                </div>
                                                <div class="product">
                                                    <div class="product-image">
                                                        <img src="/menu-images/ducati-monster.jpg" />
                                                    </div>
                                                    <ul class="product-list">
                                                        <li class="main">Monster</li>
                                                        <li><a href="#">Moster821</a></li>
                                                        <li><a href="#">Moster1200</a></li>
                                                    </ul>
                                                </div>
                                                <div class="product">
                                                    <div class="product-image">
                                                        <img src="/menu-images/ducati-multistrada.jpg" />
                                                    </div>
                                                    <ul class="product-list">
                                                        <li class="main">Multistrada</li>
                                                        <li><a href="#">Multistrada 1200</a></li>
                                                        <li><a href="#">Multistrada 1200S</a></li>
                                                    </ul>
                                                </div>
                                                <div class="product">
                                                    <div class="product-image">
                                                        <img src="/menu-images/ducati-diavel.jpg" />
                                                    </div>
                                                    <ul class="product-list">
                                                        <li class="main">Superbikes</li>
                                                        <li><a href="#">899 Panigale</a></li>
                                                        <li><a href="#">1299 Panigale</a></li>
                                                        <li><a href="#">1299S Panigale</a></li>
                                                        <li><a href="#">1199R Panigale</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li><a href="/kawasaki/" class="has-children ">Kawasaki</a>
                                    <div class="sub-menu kawasakimenu">
                                        <div class="inner-container">
                                            <div class="top-menu">
                                                <ul class="clearfix">
                                                    <li class="active has-children"><a href="#">New Kawasaki Bikes</a></li>
                                                    <li><a href="/kawasaki/clothing">Kawasaki Clothing</a></li>
                                                </ul>
                                            </div>
                                            <div class="products-slider">
                                                <div class="product">
                                                    <div class="product-image">
                                                        <img src="/menu-images/kawasaki-supersports-ninja-H2R.jpg" />                                                                  </div>
                                                    <ul class="product-list">
                                                        <li class="main"><a href="#">Kawasaki Supersports</a></li>
                                                        <li><a href="#">Kawasaki Ninja</a></li>
                                                        <li><a href="#">Kawasaki Model</a></li>
                                                    </ul>
                                                </div>
                                                <div class="product">
                                                    <div class="product-image">
                                                        <img src="/menu-images/kawasaki-sports-ER-6f.jpg" />
                                                    </div>
                                                    <ul class="product-list">
                                                        <li class="main"><a href="#">Kawasaki Sports</a></li>
                                                        <li><a href="#">Kawasaki model</a></li>
                                                        <li><a href="#">Kawasaki model</a></li>
                                                        <li><a href="#">Kawasaki model</a></li>
                                                    </ul>
                                                </div>
                                                <div class="product">
                                                    <div class="product-image">
                                                        <img src="/menu-images/kawasaki-sports-tourer-Z1000SX.jpg" />
                                                    </div>
                                                    <ul class="product-list">
                                                        <li class="main"><a href="#">Kawasaki Sports Tourer</a></li>
                                                    </ul>
                                                </div>
                                                <div class="product">
                                                    <div class="product-image">
                                                        <img src="/menu-images/kawasaki-cruiser-vulcan-S.jpg" />
                                                    </div>
                                                    <ul class="product-list">
                                                        <li class="main"><a href="#">Kawasaki Cruiser</a></li>
                                                        <li><a href="#">Kawasaki model</a></li>
                                                        <li><a href="#">Kawasaki model</a></li>
                                                    </ul>
                                                </div>
                                                <div class="product">
                                                    <div class="product-image">
                                                        <img src="/menu-images/kawasaki-dual-purpose-verys-1000.jpg" />
                                                    </div>
                                                    <ul class="product-list">
                                                        <li class="main"><a href="#">Kawasaki Dual Purpose</a></li>
                                                        <li><a href="#">Kawasaki model</a></li>
                                                        <li><a href="#">Kawasaki model</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li><a href="/scrambler/models/" class="has-children">Scrambler</a>
                                    <div class="sub-menu scramblermenu">
                                        <div class="inner-container">
                                            <div class="top-menu">
                                                <ul class="clearfix">
                                                    <li class="active has-children"><a href="#">New Scrambler Bikes</a></li>
                                                    <li><a href="/ducati/clothing">Scrambler Clothing</a></li>
                                                </ul>
                                            </div>
                                            <div class="products-slider">
                                                <div class="product">
                                                    <div class="product-image">
                                                        <img src="/menu-images/scrambler-temp.jpg" />
                                                    </div>
                                                    <ul class="product-list">
                                                        <li class="main">Scrambler Bike</li>
                                                        <li><a href="#">Scrambler model</a></li>
                                                        <li><a href="#">Scrambler model</a></li>
                                                    </ul>
                                                </div>
                                                <div class="product">
                                                    <div class="product-image">
                                                        <img src="/menu-images/scrambler-temp.jpg" />
                                                    </div>
                                                    <ul class="product-list">
                                                        <li class="main">Scrambler Bike</li>
                                                    </ul>
                                                </div>
                                                <div class="product">
                                                    <div class="product-image">
                                                        <img src="/menu-images/scrambler-temp.jpg" />
                                                    </div>
                                                    <ul class="product-list">
                                                        <li class="main">Scrambler Bike</li>
                                                        <li><a href="#">Scrambler model</a></li>
                                                        <li><a href="#">Scrambler model</a></li>
                                                        <li><a href="#">Scrambler model</a></li>
                                                    </ul>
                                                </div>
                                                <div class="product">
                                                    <div class="product-image">
                                                        <img src="/menu-images/scrambler-temp.jpg" />
                                                    </div>
                                                    <ul class="product-list">
                                                        <li class="main">Scrambler Bike</li>
                                                        <li><a href="#">Scrambler model</a></li>
                                                        <li><a href="#">Scrambler model</a></li>
                                                    </ul>
                                                </div>
                                                <div class="product">
                                                    <div class="product-image">
                                                        <img src="/menu-images/scrambler-temp.jpg" />
                                                    </div>
                                                    <ul class="product-list">
                                                        <li class="main">Scrambler Bike</li>
                                                    </ul>
                                                </div>
                                                <div class="product">
                                                    <div class="product-image">
                                                        <img src="/menu-images/scrambler-temp.jpg" />
                                                    </div>
                                                    <ul class="product-list">
                                                        <li class="main">Scrambler Bike</li>
                                                    </ul>
                                                </div>
                                                <div class="product">
                                                    <div class="product-image">
                                                        <img src="/menu-images/scrambler-temp.jpg" />
                                                    </div>
                                                    <ul class="product-list">
                                                        <li class="main">Scrambler Bike</li>
                                                        <li><a href="#">Scrambler model</a></li>
                                                        <li><a href="#">Scrambler model</a></li>
                                                        <li><a href="#">Scrambler model</a></li>
                                                        <li><a href="#">Scrambler model</a></li>
                                                    </ul>
                                                </div>
                                                <div class="product">
                                                    <div class="product-image">
                                                        <img src="/menu-images/scrambler-temp.jpg" />
                                                    </div>
                                                    <ul class="product-list">
                                                        <li class="main">Scrambler Bike</li>
                                                        <li><a href="#">Scrambler model</a></li>
                                                        <li><a href="#">Scrambler model</a></li>
                                                        <li><a href="#">Scrambler model</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li><a href="/clothing/">Clothing</a></li>
                                <li><a href="/accessories/">Accessories</a></li>
                                <li><a href="/service/">Service</a></li>
                                <li><a href="/motorcycles/">Bikes</a></li>
                                
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>	
<div class="container-fluid header">
		
	</div>		
		
		
<div class="container-fluid">

	<div class="fullwidthimage maxwidth">
                
   <!--     <img class="img-fullwidth" src="http://www.pon.me.uk/themes/slate/images/slide-images/example-slide.jpg"> -->

        <?= Breadcrumbs::widget([ 'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>    
    
    </div>

</div>   
            <div class="container">
                                
                <div class="row">
                    
                    <div class="col-xs-12 col-sm-7 vcenter ctatext">
                        
                        <h4><strong>Ready to get on the road?</strong> <br>or want to find out more?</h4>
                        <p>Additional call to action text would go here</p>
                        
                    </div><!-- required for vcenter
                        
                    --><div class="col-xs-12 col-sm-5 vcenter ctatext">
                        
                        <a class="btn btn-textonly btn-lg" href="#">Visit Our Showroom <span class="glyphicon glyphicon-menu-right transition"></span></a> 
                        <p>or get in touch on </p>
                        <span class="phone">01508 471919</span>
                        
                    </div>
                    
                </div>
                    
            </div>
        
        </div>
        <div class="mapwrapper">
            
            <div class="container">
                                
                <div class="row">
                    
                    <div class="col-xs-12 col-sm-4 vcenter maptext">
                        
                        <h4><strong>Find Us</strong></h4>
                        <p>Seastar Superbikes can be found 6 miles south of Norwich on the A140 main Norwich to Ipswich road.</p>
                        <a class="btn btn-textonly btn-md" href="#">View Map <span class="glyphicon glyphicon-menu-right transition"></span></a> 
                        
                    </div><!-- required for vcenter
                        
                    --><div class="col-xs-12 col-sm-8 vcenter mapimage">
                        
                        <a class="hidden-xs" href="#">
                            <img class="img-responsive" src="../../../../themes/slate/images/map-desktop.gif" alt="Seastar Superbikes Map">
                        </a>
                        
                    </div>
                    
                </div>
                    
            </div>
            
            <a class="visible-xs-block" href="#">
                <img class="img-responsive" src="../../../../themes/slate/images/map-mobile.gif" alt="Seastar Superbikes Map">
            </a>
                        
            <div class="mapbackgroundright hidden-xs"></div>
        
        </div>

    </div>

<footer class="footer">
    <div class="container footer">
                        
            <div class="row">
                
                <div class="col-xs-12 col-sm-6 col-md-3 footerlogos">
                        
                    <div class="row">
                        
                        <div class="col-xs-6 spacer10">
						
							<a href="#">
								<img class="img-fullwidth ctaimage-image" src="../../../../themes/slate/images/footer-seastar.jpg">
							</a>
						
                        </div>
                        
                        <div class="col-xs-6 spacer10">
						
							<a href="#">
								<img class="img-fullwidth ctaimage-image" src="../../../../themes/slate/images/footer-ducati.jpg">
							</a>
						
                        </div>
                        
                        <div class="col-xs-6 spacer10">
						
							<a href="#">
								<img class="img-fullwidth ctaimage-image" src="../../../../themes/slate/images/footer-kawasaki.jpg">
							</a>
						
                        </div>
                        
                        <div class="col-xs-6 spacer10">
						
							<a href="#">
								<img class="img-fullwidth ctaimage-image" src="../../../../themes/slate/images/footer-scrambler.jpg">
							</a>
						
                        </div>
                        
                        <div class="col-xs-6 spacer10">
						
							<a href="#">
								<img class="img-fullwidth ctaimage-image" src="../../../../themes/slate/images/footer-koptions.jpg">
							</a>
						
                        </div>
                        
                        <div class="col-xs-6 spacer10">
						
							<a href="#">
								<img class="img-fullwidth ctaimage-image" src="../../../../themes/slate/images/footer-trioptions.jpg">
							</a>
						
                        </div>
                    
                    </div>
                
                </div>
                
                <div class="col-xs-12 col-sm-6 col-md-3 footermenu">
                    
                    <h6>More Information</h6>
                            
                    <ul class="list-unstyled">
                        <li>Delivery & Returns </li>
                        <li>FAQs </li>
                        <li>Special Offers</li> 
                        <li>Shop Tour </li>
                        <li>Contact Us</li>
                    </ul>
                
                </div>
                
                <div class="col-sm-12 col-md-6">
                
                    <div class="row">
                    
                        <div class="col-xs-12 col-sm-6">
                            
                            <div class="row">
                                
                                <div class="col-xs-12 footeropeningtimes">
                            
                                    <h6>Opening times</h6>
                                    <p>9.00-6.00 Monday - Saturday <br>(Closed Sundays & bank holidays)</p>
                            
                                </div>
                            
                            </div>
                            
                            <div class="row">
                                
                                <div class="col-xs-12 footersubscribe">
                                    
                                    <h6>Subscribe to our newsletter</h6>
                                    <p>Subscribe form here</p>
                            
                                </div>
                                
                            </div>
                            
                        </div>
                        
                        <div class="col-xs-12 col-sm-6">
                            
                            <div class="row">
                                
                                <div class="col-xs-12 footercontact">
                            
									<div class='vcard' id='main_vcard' itemscope itemtype='http://schema.org/Organization'>
									
										<h6>Contact Us</h6>
                                        
                                        <p><span class='tel' itemprop='telephone'>01508 471919</span> <br><a href="mailto:#" itemprop="email">info@seastarsuperbikes.co.uk</a></p>
                                        
                                        <span class='adr' itemprop='address' itemscope itemtype='http://schema.org/PostalAddress'>

	                                        <address>Seastar Superbikes<br>
	                                        <span class='street-address' itemprop='streetAddress'> The Garage <br>
	                                        Newton Flotman, <br>
	                                        Norwich, Norfolk,</span><span class='postal-code' itemprop='postalCode'> NR15 1PN</span>
	                                        </address>
                                        </span>  
                                                                             
									</div>
									
                                    <div style="clear:both;"></div>
                                    
                                    <div class="footericon">
                                        <a class="transition" href="#" target="_blank">
                                            <img src="../../../../themes/slate/images/footer-twitter.png" alt="Twitter">
                                        </a>
                                    </div>
                                    
                                    <div class="footericon">
                                        <a class="transition" href="#" target="_blank">
                                            <img src="../../../../themes/slate/images/footer-facebook.png" alt="Facebook">
                                        </a>
                                    </div>
                                    
                                    <div class="footericon">
                                        <a class="transition" href="#" target="_blank">
                                            <img src="../../../../themes/slate/images/footer-instagram.png" alt="Instagram">
                                        </a>
                                    </div>
                                    
                                    <div class="footericon">
                                        <a class="transition" href="#" target="_blank">
                                            <img src="../../../../themes/slate/images/footer-youtube.png" alt="YouTube">
                                        </a>
                                    </div>
                                    
                                    <div class="footericon">
                                        <a class="transition" href="#" target="_blank">
                                            <img src="../../../../themes/slate/images/footer-linkedin.png" alt="LinkedIn">
                                        </a>
                                    </div>
                                    
                                </div>
                                
                            </div>
                            
                        </div>
                        
                    </div>
                
                </div>
                
                <div class="col-xs-12 copyright">
                
                    <p>&copy; <?= date('Y') ?> Seastar Superbikes | The Seastar Co. Ltd t/a Seastar Superbikes, The Garage, Ipswich Road, Newton Flotman, Norfolk. NR15 1PN </p>
                    <p>By using this website, you agree that we can set and use cookies.  For more details of these cookies and how to disable them, see our cookie policy.</p>
                    
                    <div class="geo hidden">Newton Flotman<span class="latitude">52.538</span>; <span class="longitude">1.262</span></div>

                </div>
              
            </div>
            
            <div style="clear:both;"></div>
                        
    </div>
</footer>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
