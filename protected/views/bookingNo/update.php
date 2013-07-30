<?php
$this->breadcrumbs=array(
	'Booking Nos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	/*array('label'=>'List BookingNo','url'=>array('index')),
	array('label'=>'Create BookingNo','url'=>array('create')),
	array('label'=>'View BookingNo','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage BookingNo','url'=>array('admin')),
	*/
	);
	?>

	<h1>Update BookingNo <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
