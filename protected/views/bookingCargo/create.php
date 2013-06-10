<?php
$this->breadcrumbs=array(
	'Booking Cargos'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List BookingCargo','url'=>array('index')),
array('label'=>'Manage BookingCargo','url'=>array('admin')),
);
?>

<h1>Create BookingCargo</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>