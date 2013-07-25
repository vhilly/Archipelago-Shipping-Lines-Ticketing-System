<?php
$this->breadcrumbs=array(
	'Seating Classes'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'List SeatingClass','url'=>array('index')),
array('label'=>'Create SeatingClass','url'=>array('create')),
array('label'=>'Update SeatingClass','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete SeatingClass','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage SeatingClass','url'=>array('admin')),
);
?>

<h1>View SeatingClass #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'name',
		'description',
),
)); ?>
