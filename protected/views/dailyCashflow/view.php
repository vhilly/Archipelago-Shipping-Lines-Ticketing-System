<?php
$this->breadcrumbs=array(
	'Daily Cashflows'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List DailyCashflow','url'=>array('index')),
array('label'=>'Create DailyCashflow','url'=>array('create')),
array('label'=>'Update DailyCashflow','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete DailyCashflow','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage DailyCashflow','url'=>array('admin')),
);
?>

<h1>View DailyCashflow #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'vessel',
		'date',
		'is_sync',
),
)); ?>
