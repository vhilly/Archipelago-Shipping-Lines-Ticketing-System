<?php
$this->breadcrumbs=array(
	'Vessels'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'List Vessel','url'=>array('index')),
array('label'=>'Create Vessel','url'=>array('create')),
array('label'=>'Update Vessel','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete Vessel','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Vessel','url'=>array('admin')),
);
?>

<h1>View Vessel #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'name',
		'description',
		'passenger_limit',
		'blocked_seats',
),
)); ?>
