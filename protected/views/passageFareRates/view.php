<?php
$this->breadcrumbs=array(
	'Passage Fare Rates'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List PassageFareRates','url'=>array('index')),
	array('label'=>'Create PassageFareRates','url'=>array('create')),
	array('label'=>'Update PassageFareRates','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete PassageFareRates','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PassageFareRates','url'=>array('admin')),
);
?>

<h1>View PassageFareRates #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'type',
		'proposed',
		array('label'=>'Class','value'=>$model->class0->name),
		'price',
	),
)); ?>
