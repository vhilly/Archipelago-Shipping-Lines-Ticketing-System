<?php
$this->breadcrumbs=array(
	'Passengers'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List Passenger','url'=>array('index')),
	array('label'=>'Create Passenger','url'=>array('create')),
	array('label'=>'View Passenger','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Passenger','url'=>array('admin')),
	);
	?>

	<h1>Update Passenger <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>