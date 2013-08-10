<?php
$this->breadcrumbs=array(
	'Upgrades'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List Upgrades','url'=>array('index')),
array('label'=>'Create Upgrades','url'=>array('create')),
array('label'=>'Update Upgrades','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete Upgrades','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Upgrades','url'=>array('admin')),
);
?>

<h1>View Upgrades #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'voyage',
		'amt',
),
)); ?>
