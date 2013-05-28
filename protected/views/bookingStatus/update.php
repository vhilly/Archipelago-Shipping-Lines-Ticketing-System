<?php
$this->breadcrumbs=array(
	'Booking Statuses'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List BookingStatus','url'=>array('index')),
	array('label'=>'Create BookingStatus','url'=>array('create')),
	array('label'=>'View BookingStatus','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage BookingStatus','url'=>array('admin')),
	);
	?>

	<h1>Update BookingStatus <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>