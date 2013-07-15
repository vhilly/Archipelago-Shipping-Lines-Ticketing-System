<?php
$this->breadcrumbs=array(
	'Voyages'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'List Voyage','url'=>array('index')),
array('label'=>'Create Voyage','url'=>array('create')),
array('label'=>'Update Voyage','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete Voyage','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Voyage','url'=>array('admin')),
);
?>

<h1>View Voyage #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'name',
		'vessel',
		'route',
		'departure_time',
		'arrival_time',
		'departure_date',
		'status',
),
)); ?>
