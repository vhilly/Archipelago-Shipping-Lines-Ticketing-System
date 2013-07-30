<?php
$this->breadcrumbs=array(
	'Booking Nos'=>array('index'),
	$model->id,
);

$this->menu=array(
/*array('label'=>'List BookingNo','url'=>array('index')),
array('label'=>'Create BookingNo','url'=>array('create')),
array('label'=>'Update BookingNo','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete BookingNo','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
*/
array('label'=>'Manage BookingNo','url'=>array('admin')),
);
?>

<h1>View BookingNo #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'tkt_no',
		'booking_no',
		'transaction',
		'passenger',
		array(
                        'label'=>'Passenger',
                        'value'=>$model->passenger0->first_name.' '.$model->passenger0->last_name,
                ),
		array(
			'label'=>'Voyage',
			'value'=>$model->voyage0->name,
		),
		'seat',
		'status',
		'date_booked',
		'rate',
		'type',
),
)); ?>
