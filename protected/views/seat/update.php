<?php
$this->breadcrumbs=array(
	'Seats'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Seat','url'=>array('index')),
	array('label'=>'Create Seat','url'=>array('create')),
	array('label'=>'View Seat','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Seat','url'=>array('admin')),
);
?>

<h1>Update Seat <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>