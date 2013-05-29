<?php
$this->breadcrumbs=array(
	'Cargo Classes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List CargoClass','url'=>array('index')),
	array('label'=>'Create CargoClass','url'=>array('create')),
	array('label'=>'View CargoClass','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage CargoClass','url'=>array('admin')),
	);
	?>

	<h1>Update CargoClass <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>