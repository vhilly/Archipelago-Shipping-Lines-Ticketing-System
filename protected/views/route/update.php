<?php
$this->breadcrumbs=array(
	'Routes'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Route','url'=>array('index')),
	array('label'=>'Create Route','url'=>array('create')),
	array('label'=>'View Route','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Route','url'=>array('admin')),
);
?>

<h1>Update Route <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>