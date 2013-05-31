<?php
$this->breadcrumbs=array(
	'Booking Cargos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List BookingCargo','url'=>array('index')),
	array('label'=>'Create BookingCargo','url'=>array('create')),
	array('label'=>'View BookingCargo','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage BookingCargo','url'=>array('admin')),
	);
	?>

	<h1>Update BookingCargo <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>