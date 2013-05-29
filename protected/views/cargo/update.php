<?php
$this->breadcrumbs=array(
	'Cargos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List Cargo','url'=>array('index')),
	array('label'=>'Create Cargo','url'=>array('create')),
	array('label'=>'View Cargo','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Cargo','url'=>array('admin')),
	);
	?>

	<h1>Update Cargo <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>