<?php
/* @var $this CargoController */
/* @var $model Cargo */

$this->breadcrumbs=array(
	'Cargos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Cargo', 'url'=>array('index')),
	array('label'=>'Create Cargo', 'url'=>array('create')),
	array('label'=>'Update Cargo', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Cargo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Cargo', 'url'=>array('admin')),
);
?>

<h1>View Cargo #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'shipper',
		'company',
		'destination',
		'address',
		'cargo_class',
		'article_no',
		'article_desc',
		'weight',
		'length',
		'contact',
		'voyage',
	),
)); ?>
