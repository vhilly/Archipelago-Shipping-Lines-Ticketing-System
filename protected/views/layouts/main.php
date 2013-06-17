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
                array('icon'=>'book','label'=>'Booking', 'url'=>'#', 'items'=>array(
                    array('label'=>'Check-In', 'url'=>array('/booking/checkin')),
                    array('label'=>'Booked Tickets', 'url'=>array('/booking/index')),
                    array('label'=>'Booked Cargos', 'url'=>array('/bookingCargo/index')),
                ), 'visible'=>!Yii::app()->user->isGuest, ),
                array('icon'=>'print','label'=>'Print', 'url'=>'#', 'items'=>array(
                    array('icon'=>'calendar','label'=>'Boarding Pass', 'url'=>array('/booking/bpass')),
	            array('icon'=>'barcode','label'=>'Tickets', 'url'=>array('/ticket/index')),
		    array('icon'=>'file','label'=>'Bill of Lading', 'url'=>array('/waybill/index')),
                ), 'visible'=>!Yii::app()->user->isGuest, ),
		'...',
		    array('icon'=>'wrench','label'=>'Tools', 'url'=>'#', 'items'=>array(
                    array('icon'=>'book','label'=>'Booking Transfer', 'url'=>array('/booking/transfer')),
                    array('icon'=>'book','label'=>'Seat Availability', 'url'=>array('/seat/index')),
                    array('icon'=>'group','label'=>'Passenger', 'url'=>array('/passenger/index')),
					array('icon'=>'book','label'=>'Reports', 'url'=>'#', 'items'=>array(
						array('label'=>'Daily Revenue Report', 'url'=>array('/report/dailyRevenue')),
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
                    array('label'=>'Vessel', 'url'=>array('vessel/setup')),
                    '---',
                    array('label'=>'Voyage', 'url'=>array('voyage/setup')),
                    '---',
                    array('label'=>'TRANSACTION'),
                    array('label'=>'Transaction Type', 'url'=>array('/transactionType/setup')), 
                    '---',
                    array('label'=>'RATES'),
                    array('label'=>'Ticket', 'url'=>array('ticket/setup')), 
                    '---',
                    array('label'=>'Cargo', 'url'=>array('cargo/setup')),
                    '---',
                    array('icon'=>'off','label'=>'Logout', 'url'=>array('/site/logout')), 
                ),'visible'=>!Yii::app()->user->isGuest ),
            ),
        ),
    ),
)); ?>


<div class="container" id="page">
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
		<p><?php echo Yii::powered(); ?></p>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
