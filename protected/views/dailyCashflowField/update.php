<?php
$this->breadcrumbs=array(
	'Daily Cashflow Fields'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List DailyCashflowField','url'=>array('index')),
	array('label'=>'Create DailyCashflowField','url'=>array('create')),
	array('label'=>'View DailyCashflowField','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage DailyCashflowField','url'=>array('admin')),
	);
	?>

	<h1>Update DailyCashflowField <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>