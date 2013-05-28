<?php
$this->breadcrumbs=array(
	'Payment Statuses'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'List PaymentStatus','url'=>array('index')),
array('label'=>'Create PaymentStatus','url'=>array('create')),
array('label'=>'Update PaymentStatus','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete PaymentStatus','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage PaymentStatus','url'=>array('admin')),
);
?>

<h1>View PaymentStatus #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'name',
		'desc',
		'active',
),
)); ?>
