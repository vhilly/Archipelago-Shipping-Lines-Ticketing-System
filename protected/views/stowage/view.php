<?php
$this->breadcrumbs=array(
	'Stowages'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'List Stowage','url'=>array('index')),
array('label'=>'Create Stowage','url'=>array('create')),
array('label'=>'Update Stowage','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete Stowage','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Stowage','url'=>array('admin')),
);
?>

<h1>View Stowage #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'name',
		'active',
),
)); ?>
