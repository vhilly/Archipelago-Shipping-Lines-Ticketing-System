<?php
$this->breadcrumbs=array(
	'Transactions'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List Transaction','url'=>array('index')),
array('label'=>'Create Transaction','url'=>array('create')),
array('label'=>'Update Transaction','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete Transaction','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Transaction','url'=>array('admin')),
);
?>

<h1>View Transaction #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'type',
		'payment_method',
		'payment_status',
		'uid',
		'trans_date',
		'input_date',
		'ovamount',
		'ovdiscount',
		'reference',
),
)); ?>
