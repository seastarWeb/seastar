<?php

use yii\helpers\ArrayHelper; 
use kartik\tabs\TabsX;
/* @var $this yii\web\View */
$this->title = 'Seastar Admin Area';
?>
<div class="site-index">

  <div class="body-content">

    <div class="row">
        <?php echo TabsX::widget([
		 'position'=>TabsX::POS_LEFT,
        'items' => [
               [
                'label'=>'Data from Deep Blue ',
                'content'=> '<h3>Deep Blue Imported Data</h3>
                    <p>This facility allows you to edit directly the copy of Deep Blue Parts data.</p>
                    <p>
                    As this is the final arbiter of pricing on the website it is essential that this data is correct.
                    <br>
                    </p>
                    <p>
                    Further, as there is no reconciliation back to the Dealer Management system, when the data is refreshed - the original problem will be re-presented.<br>
                    </p>
                    <p>It follows that changes need to be made at source (within Deep Blue) for them to remain in place.</p>
                    <p>You may associate a part number to a model here.</p>
                    <p><a class="btn btn-default" href="/deep-blue/index">Deep Blue Parts &raquo;</a></p>',
                'active'=> false],
            [
            'label'=>'Motorcycle Models',
            'content'=> '
              <h3>Motorcycle Model Ranges</h3>
              <p><a class="btn btn-default" href="/model-range/index">Model Ranges &raquo;</a></p>
              <p>You can create and duplicate the model ranges of a manufacturer.</p>
              <p><a class="btn btn-default" href="/models/index">Model Maintenance &raquo;</a></p>
              <p>Characteristic relating to the model, including :
                  <ul>
                      <li>chassis</li>
                      <li>engine</li>
                      <li>general</li>
                      <li>colours</li>
                      <li>finance</li>
                   </ul> 
               </p>
              <p>
                  The idea behind this is that one model is created and the details populated. In this way, using the Scrambler as an example:
                  <ul>
                      <li>Create Scrambler Icon.</li>
                      <li>Fill in the details about the chassis, engine etc.</li>
                      <li>Create Scrambler Urban Enduro</li>
                      <li>Use the duplicate button to draw in the details from the Scrambler Icon</li>
                      <li>Alter the bits that are different e.g. wheels from alloy to spoked.</li>
                  </ul>    
              </p>
              ',
          'active'=> true],
            [
            'label'=>'Product Lines',
            'content'=> '
             <h3>Product Lines</h3>
              <p> The partnumbers or sku available from the dealer management system do not provide adequately for categorizing parts. </p>
             <p>
                 To overcome this limitation, the site has a Product Line table which allows for several products to be associated with on product description.
                 <br>
                 Product lines may be switched on or off as supply dictates.
                 A productline when defined will generate its own url slug. </br>
             </p>
             <p>
                 Partnumbers directly from Deep Blue dealer management system may then be associated with it.
                 To overcome the deficiencies of the data provided, a second product description field is populated using the original data. 
                 This may be subsequently edited/changed without being affected by re-populating the site data. 
              </p>
              <p><a class="btn btn-default" href="/product-line/index">Product Lines &raquo;</a></p>
              ',
          'active'=> false],
            [
            'label'=>'Orders',
            'content'=> '<h3>Customer Orders</h3>
              <p>This area is provided to verify the status and the pricing of the orders processed.
                  It is not possible to edit orders with a status of anything other than 0.
              </p>
              <p> Payments may only be processed against "new" orders (with a status of 0).</p>
              <p> Payments and order status should be transactional <br> - that is to say if the payment suceeds then the order should be marked as paid.</p>

              <p><a class="btn btn-default" href="/order/index">Customer Orders &raquo;</a></p>',
            'active'=> false],
             [
              'label'=>'Used Bikes',
              'content'=> '
                <h3>Used Bikes</h3>          
                <p> Amend the bikes for sale </p>
                <p><a class="btn btn-default" href="/bikes/index">Approved Used &raquo;</a></p>',
              'active'=> false],
	      ['label'=>'The Front Page',
	      'content'=>'
                <p><a class="btn btn-default" href="/promotions/index">Front Page Promotions &raquo;</a></p> ',
	      'active'=>false,
	      ]
          ]]);
        ?>
      </div>
     </div>
</div>

