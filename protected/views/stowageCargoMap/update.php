<?php
$this->breadcrumbs=array(
	'Stowage Cargo Maps'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List StowageCargoMap','url'=>array('index')),
	array('label'=>'Create StowageCargoMap','url'=>array('create')),
	array('label'=>'View StowageCargoMap','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage StowageCargoMap','url'=>array('admin')),
	);
	?>

	<h1>Update StowageCargoMap <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>