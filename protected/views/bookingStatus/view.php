<?php
$this->breadcrumbs=array(
	'Booking Statuses'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'List BookingStatus','url'=>array('index')),
array('label'=>'Create BookingStatus','url'=>array('create')),
array('label'=>'Update BookingStatus','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete BookingStatus','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage BookingStatus','url'=>array('admin')),
);
?>

<h1>View BookingStatus #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'name',
		'desc',
		'active',
),
)); ?>
