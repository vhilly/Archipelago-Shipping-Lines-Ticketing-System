<?php
$this->breadcrumbs=array(
	'Booking Cargos'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List BookingCargo','url'=>array('index')),
array('label'=>'Create BookingCargo','url'=>array('create')),
array('label'=>'Update BookingCargo','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete BookingCargo','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage BookingCargo','url'=>array('admin')),
);
?>

<h1>View BookingCargo #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'transaction',
		'cargo',
		'status',
		'date_booked',
		'departure_date',
),
)); ?>
