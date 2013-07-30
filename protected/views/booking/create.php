<?php
$this->breadcrumbs=array(
	'Bookings'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List Booking','url'=>array('index')),
array('label'=>'Manage Booking','url'=>array('admin')),
);
?>

<h1>Create Booking</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>