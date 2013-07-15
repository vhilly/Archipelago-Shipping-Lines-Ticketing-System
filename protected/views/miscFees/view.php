<?php
$this->breadcrumbs=array(
	'Misc Fees'=>array('index'),
	$model->name,
);

$this->menu=array(
array('label'=>'List MiscFees','url'=>array('index')),
array('label'=>'Create MiscFees','url'=>array('create')),
array('label'=>'Update MiscFees','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete MiscFees','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage MiscFees','url'=>array('admin')),
);
?>

<h1>View MiscFees #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'name',
		'description',
		'amt',
		'transaction_type',
		'active',
),
)); ?>
