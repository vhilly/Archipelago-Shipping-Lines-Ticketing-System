<?php
$this->breadcrumbs=array(
	'Stowage Cargo Maps'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List StowageCargoMap','url'=>array('index')),
array('label'=>'Create StowageCargoMap','url'=>array('create')),
array('label'=>'Update StowageCargoMap','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete StowageCargoMap','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage StowageCargoMap','url'=>array('admin')),
);
?>

<h1>View StowageCargoMap #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'cargo',
		'stowage',
),
)); ?>
