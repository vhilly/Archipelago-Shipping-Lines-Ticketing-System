<?php
$this->breadcrumbs=array(
	'Passage Fare Types'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'List PassageFareTypes','url'=>array('index')),
array('label'=>'Create PassageFareTypes','url'=>array('create')),
array('label'=>'Update PassageFareTypes','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete PassageFareTypes','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage PassageFareTypes','url'=>array('admin')),
);
?>

<h1>View PassageFareTypes #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'name',
		'proposed',
),
)); ?>
