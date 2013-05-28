<?php
$this->breadcrumbs=array(
	'Seating Classes'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SeatingClass','url'=>array('index')),
	array('label'=>'Create SeatingClass','url'=>array('create')),
	array('label'=>'View SeatingClass','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage SeatingClass','url'=>array('admin')),
);
?>

<h1>Update SeatingClass <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>