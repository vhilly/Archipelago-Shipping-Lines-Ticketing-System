<?php
$this->breadcrumbs=array(
	'Cargo Classes'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List CargoClass','url'=>array('index')),
array('label'=>'Create CargoClass','url'=>array('create')),
array('label'=>'Update CargoClass','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete CargoClass','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage CargoClass','url'=>array('admin')),
);
?>

<h1>View CargoClass #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'class',
		'desc',
		'lane_meter',
		'lane_meter_rate',
		'proposed_tariff',
		'as_of',
		'active',
),
)); ?>
