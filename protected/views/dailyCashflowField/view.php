<?php
$this->breadcrumbs=array(
	'Daily Cashflow Fields'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'List DailyCashflowField','url'=>array('index')),
array('label'=>'Create DailyCashflowField','url'=>array('create')),
array('label'=>'Update DailyCashflowField','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete DailyCashflowField','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage DailyCashflowField','url'=>array('admin')),
);
?>

<h1>View DailyCashflowField #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'name',
		'parent',
		'weight',
),
)); ?>
