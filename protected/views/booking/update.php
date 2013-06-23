<?php
$this->breadcrumbs=array(
	'Bookings'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List Booking','url'=>array('index')),
	array('label'=>'Create Booking','url'=>array('create')),
	array('label'=>'View Booking','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Booking','url'=>array('admin')),
	);
	?>

	<h1>Update Booking <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>