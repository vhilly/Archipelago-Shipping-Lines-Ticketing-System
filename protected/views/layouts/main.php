<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<?php Yii::app()->bootstrap->register(); ?>
</head>

<body>

<?php $this->widget('bootstrap.widgets.TbNavbar',array(
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
        ),
    ),
)); ?>

<?php $this->widget('bootstrap.widgets.TbNavbar', array(
    'type'=>'inverse', // null or 'inverse'
    'brand'=>Yii::app()->name,
    'brandUrl'=>'#',
    'collapse'=>true, // requires bootstrap-responsive.css
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>array(
                array('label'=>'Home', 'url'=>array('/site/index')),
                #array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
                #array('label'=>'Contact', 'url'=>array('/site/contact')),
                array('label'=>'Transaction', 'url'=>'#', 'items'=>array(
                    array('label'=>'Purchase Ticket', 'url'=>array('/purchase/index')),
                    array('label'=>'Purchase Cargo Ticket', 'url'=>'#'),
                    array('label'=>'Purchase Bulk Ticket', 'url'=>'#'),
                    '---',
                    array('label'=>'TRANSACTIONS'),
                    array('label'=>'Overview', 'url'=>'#'),
                ), 'visible'=>!Yii::app()->user->isGuest, ),
            ),
        ),
       // '<form class="navbar-search pull-left" action=""><input type="text" class="search-query span2" placeholder="Search"></form>',
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'htmlOptions'=>array('class'=>'pull-right'),
            'items'=>array(
                array('label'=>'Login', 'url'=>array('/user/login'), 'visible'=>Yii::app()->user->isGuest),
                array('label'=>'Admin('.Yii::app()->user->name.')', 'url'=>'#', 'items'=>array(
                    array('label'=>'Seat', 'url'=>array('seat/')),
                    array('label'=>'Route', 'url'=>array('route/')),
                    array('label'=>'Voyage', 'url'=>array('voyage/')),
                    array('label'=>'Vessel', 'url'=>array('vessel/')),
                    array('label'=>'Something else here', 'url'=>'#'),
                    '---',
                    array('label'=>'RATES'),
                    array('label'=>'Passage Fare Rates', 'url'=>array('/passageFareRates')), 
                    '---',
                    array('label'=>'Logout', 'url'=>array('/site/logout')), 
                ),'visible'=>!Yii::app()->user->isGuest ),
            ),
        ),
    ),
)); ?>


<div class="container" id="page">

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
