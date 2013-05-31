<?php
$this->breadcrumbs=array(
	'Vessels'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Vessel','url'=>array('index')),
	array('label'=>'Create Vessel','url'=>array('create')),
	array('label'=>'View Vessel','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Vessel','url'=>array('admin')),
);
?>

<h1>Update Vessel <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>