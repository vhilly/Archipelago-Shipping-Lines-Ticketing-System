<?php
$this->breadcrumbs=array(
	'Stowages'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List Stowage','url'=>array('index')),
	array('label'=>'Create Stowage','url'=>array('create')),
	array('label'=>'View Stowage','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Stowage','url'=>array('admin')),
	);
	?>

	<h1>Update Stowage <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>