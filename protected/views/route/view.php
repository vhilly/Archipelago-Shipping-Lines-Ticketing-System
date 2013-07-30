<?php
$this->breadcrumbs=array(
	'Routes'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'List Route','url'=>array('index')),
array('label'=>'Create Route','url'=>array('create')),
array('label'=>'Update Route','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete Route','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Route','url'=>array('admin')),
);
?>

<h1>View Route #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'name',
		'from_port',
		'to_port',
		'active',
),
)); ?>
