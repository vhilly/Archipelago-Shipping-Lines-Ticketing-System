<?php
$this->breadcrumbs=array(
	'Voyages'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Voyage','url'=>array('index')),
	array('label'=>'Create Voyage','url'=>array('create')),
	array('label'=>'View Voyage','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Voyage','url'=>array('admin')),
);
?>

<h1>Update Voyage <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>