<?php
$this->breadcrumbs=array(
	'Booking Nos'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List BookingNo','url'=>array('index')),
array('label'=>'Manage BookingNo','url'=>array('admin')),
);
?>

<h1>Create BookingNo</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>