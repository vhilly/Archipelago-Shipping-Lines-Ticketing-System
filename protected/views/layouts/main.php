<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<?php Yii::app()->bootstrap->register(); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />
</head>

<body>

<?php $this->widget('bootstrap.widgets.TbNavbar',array(
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
        ),
    ),
)); ?>


<?php
  $transLink = array();
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
    'collapse'=>true, // requires bootstrap-responsive.css
    'fluid'=>true,
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>array(
		'...',
                array('icon'=>'home','label'=>'Home', 'url'=>array('/site/index')),
		'...',
                #array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
                #array('label'=>'Contact', 'url'=>array('/site/contact')),
                array('icon'=>'align-justify','label'=>'Transaction', 'url'=>'#', 'items'=>$transLink,
                'visible'=>!Yii::app()->user->isGuest, ),
		'...',
                array('icon'=>'book','label'=>'Booking', 'url'=>'#', 'items'=>array(
                    array('label'=>'Booked Tickets', 'url'=>array('/booking/index')),
                    array('label'=>'Booked Cargos', 'url'=>array('/bookingCargo/index')),
                ), 'visible'=>!Yii::app()->user->isGuest, ),
		'...',
                array('icon'=>'book','label'=>'Seat Availability', 'url'=>array('/seat/index'), 'items'=>array(
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
                array('icon'=>'book','label'=>'Reports', 'url'=>'#', 'items'=>array(
                    array('label'=>'Daily Revenue Report', 'url'=>array('/report/index')),
                ), 'visible'=>!Yii::app()->user->isGuest, ),
                array('icon'=>'off','label'=>'Login', 'url'=>array('/user/login'), 'visible'=>Yii::app()->user->isGuest),
                array('icon'=>'user','label'=>'('.Yii::app()->user->name.')', 'url'=>'#', 'items'=>array(
                    array('icon'=>'cog','label'=>'SETTINGS'),
                    array('label'=>'Seats', 'url'=>array('seat/admin')),
                    array('label'=>'Routes', 'url'=>array('route/')),
                    array('label'=>'Voyages', 'url'=>array('voyage/')),
                    array('label'=>'Vessels', 'url'=>array('vessel/')),
                    '---',
                    array('label'=>'PAYMENT'),
                    array('label'=>'Payment Method', 'url'=>array('/paymentMethod')), 
                    array('label'=>'Payment Status', 'url'=>array('/paymentStatus')), 
                    '---',
                    '---',
                    array('label'=>'TRANSACTION'),
                    array('label'=>'Transaction Type', 'url'=>array('/transactionType')), 
                    '---',
                    array('label'=>'RATES'),
                    array('label'=>'Passage Fare Rates', 'url'=>array('/passageFareRates')), 
                    '---',
                    array('icon'=>'off','label'=>'Logout', 'url'=>array('/site/logout')), 
                ),'visible'=>!Yii::app()->user->isGuest ),
            ),
        ),
    ),
)); ?>


<div class="container-fluid" id="page">


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
