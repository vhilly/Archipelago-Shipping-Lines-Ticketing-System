<?php
$this->breadcrumbs=array(
	'Refunded Tkts'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List RefundedTkts','url'=>array('index')),
array('label'=>'Create RefundedTkts','url'=>array('create')),
array('label'=>'Update RefundedTkts','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete RefundedTkts','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage RefundedTkts','url'=>array('admin')),
);
?>

<h1>View RefundedTkts #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'tkt_no',
		'tkt_serial',
		'booking_no',
		'transaction',
		'passenger',
		'voyage',
		'seat',
		'status',
		'date_booked',
		'rate',
		'type',
),
)); ?>
