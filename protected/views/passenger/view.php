<?php
$this->breadcrumbs=array(
	'Passengers'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List Passenger','url'=>array('index')),
array('label'=>'Create Passenger','url'=>array('create')),
array('label'=>'Update Passenger','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete Passenger','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Passenger','url'=>array('admin')),
);
?>

<h1>View Passenger #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'first_name',
		'last_name',
		'email',
		'contact',
		'middle_name',
		'prefix',
		'gender',
		'civil_status',
		'nationality',
		'address',
		'birth_date',
),
)); ?>
