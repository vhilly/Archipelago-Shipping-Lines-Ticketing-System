<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	
	<?php Yii::app()->bootstrap->register(); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />
	<style>
		* {
			font-size:12px;
		}
	</style>
</head>

<body>



<?php
  $transLink = array();
  $types = array();
  $types=CHtml::listData(TransactionType::model()->findAll(),'id','navigation_title');
  if(count($types)){
    foreach($types as $key=>$type){
      $transLink[] =  array('label'=>$type, 'url'=>array('/purchase/index','type'=>$key));
    }
  }
  

  $fees = array();
  $fees=CHtml::listData(MiscFees::model()->findAll(),'id','name');
  if(count($fees)){
    $transLink[] =  array('label'=>'Misc Fees');
    foreach($fees as $key=>$fee){
      $transLink[] =  array('label'=>$fee, 'url'=>array('/fees/pay','type'=>$key));
    }
  }
  
  $transLink[] =  array('label'=>'TRANSACTIONS');
  $transLink[] =  array('icon'=>'eye-open','label'=>'Overview', 'url'=>array('/transaction/index'));
?>


<?php $this->widget('bootstrap.widgets.TbNavbar', array(
    'type'=>'inverse', // null or 'inverse'
    'brand'=>'',
    'brandUrl'=>'#',
    'collapse'=>false, // requires bootstrap-responsive.css
    'fluid'=>false,
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>array(
		'...',
                array('icon'=>'home','label'=>'Home', 'url'=>array('/site/index')),
		'...',
                #array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
                #array('label'=>'Contact', 'url'=>array('/site/contact')),
                array('icon'=>'credit-card','label'=>'Transaction', 'url'=>'#', 'items'=>$transLink,
                'visible'=>!Yii::app()->user->isGuest, ),
		'...',
                array('label'=>'Voyage', 'url'=>array('/voyage/index'
                ), 'visible'=>!Yii::app()->user->isGuest, ),
		'...',
                array('icon'=>'book','label'=>'Cargo', 'url'=>'#', 'items'=>array(
                    array('label'=>'Booked Cargos', 'url'=>array('/bookingCargo/index')),
                    array('label'=>'Check-In', 'url'=>array('/bookingCargo/checkin')),
                    array('label'=>'Board', 'url'=>array('/bookingCargo/board')),
                ), 'visible'=>!Yii::app()->user->isGuest, ),
		'...',
                array('icon'=>'group','label'=>'Passenger', 'url'=>'#', 'items'=>array(
                    array('label'=>'Booked Passengers', 'url'=>array('/booking/index')),
                    array('label'=>'Check-In', 'url'=>array('/booking/checkin')),
                    array('label'=>'Board', 'url'=>array('/booking/board')),
                ), 'visible'=>!Yii::app()->user->isGuest, ),
		'...',
                array('icon'=>'print','label'=>'Print', 'url'=>'#', 'items'=>array(
	            array('icon'=>'file','label'=>'Tickets', 'url'=>array('/booking/tkt')),
                    array('icon'=>'file','label'=>'Boarding Pass', 'url'=>array('/booking/bpass')),
		    array('icon'=>'file','label'=>'Bill of Lading', 'url'=>array('/bookingCargo/wBill')),
		    array('icon'=>'file','label'=>'Manifest', 'url'=>array('/booking/manifest')),
                ), 'visible'=>!Yii::app()->user->isGuest, ),
		'...',
		    array('icon'=>'wrench','label'=>'Tools', 'url'=>'#', 'items'=>array(
                    array('icon'=>'book','label'=>'Booking Transfer', 'url'=>array('/booking/transfer')),
                    array('icon'=>'book','label'=>'Seat Availability', 'url'=>array('/seat/index')),
                    array('icon'=>'group','label'=>'Passenger', 'url'=>array('/passenger/index')),
		      array('icon'=>'book','label'=>'Reports', 'url'=>'#', 'items'=>array(
		        array('label'=>'Daily Revenue Report', 'url'=>array('/report/dailyRevenue')),
		        array('label'=>"Inspection Report", 'url'=>array('/report/inspection')),
	              ),
					),
                ), 'visible'=>!Yii::app()->user->isGuest, ),
		'...',


            ),
        ),
       // '<form class="navbar-search pull-left" action=""><input type="text" class="search-query span2" placeholder="Search"></form>',
						'<div class="pull-right sub-brand"></div>',
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'htmlOptions'=>array('class'=>'pull-right'),
            'items'=>array(
                
                array('icon'=>'off','label'=>'Login', 'url'=>array('/user/login'), 'visible'=>Yii::app()->user->isGuest),
                array('icon'=>'user','label'=>'('.Yii::app()->user->name.')', 'url'=>'#', 'items'=>array(
                    array('icon'=>'cog','label'=>'SETTINGS'),
                    array('label'=>'Seat', 'url'=>array('seat/setup')),
                    '---',
                    array('label'=>'Seating Class', 'url'=>array('seatingClass/admin')),
                    '---',
                    array('label'=>'Vessel', 'url'=>array('vessel/admin')),
                    '---',
                    array('label'=>'Route', 'url'=>array('route/admin')),
                    '---',
                    array('label'=>'Voyage', 'url'=>array('voyage/admin')),
                    '---',
                    array('label'=>'Cargo Class', 'url'=>array('cargoClass/admin')),
                    '---',
                    array('label'=>'Fare Types', 'url'=>array('passageFareTypes/admin')),
                    '---',
                    array('label'=>'Customers', 'url'=>array('customer/admin')),
                    '---',
                    array('label'=>'TRANSACTION'),
                    array('label'=>'Transaction Type', 'url'=>array('/transactionType/setup')), 
                    '---',
                    array('label'=>'RATES'),
                    array('label'=>'Ticket', 'url'=>array('passageFareRates/rates')), 
                    '---',
                    array('label'=>'Cargo', 'url'=>array('cargoFareRates/rates')),
                    '---',
                    array('icon'=>'off','label'=>'Logout', 'url'=>array('/site/logout')), 
                ),'visible'=>!Yii::app()->user->isGuest ),
            ),
        ),
    ),
)); ?>


<div class="fluid" id="page">
  <center>
<?php
  $msgType='';
  if(Yii::app()->user->hasFlash("success"))
   $msgType='success';
  if(Yii::app()->user->hasFlash("error"))
   $msgType='error';
  if(Yii::app()->user->hasFlash("info"))
   $msgType='info';
  $this->widget('bootstrap.widgets.TbAlert', array(
    'block'=>true, // display a larger alert block?
    'fade'=>true, // use transitions?
    'closeText'=>'x', // close link text - if set to false, no close link is displayed
    'alerts'=>array( // configurations per alert type
	    $msgType=>array('block'=>true, 'fade'=>true, 'closeText'=>'x'), // success, info, warning, error or danger
    ),
  ));
?>
  </center>
	<?php echo $content; ?>

	<div class="clear"></div>

	<div class="footer">
		<p>&copy; <?php echo date('Y'); ?> Archipelago | Philippine Ferries Corporation.<p/>
		<p>Designed by A-Team.<p/>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
