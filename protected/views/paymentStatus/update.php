<?php
$this->breadcrumbs=array(
	'Payment Statuses'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List PaymentStatus','url'=>array('index')),
	array('label'=>'Create PaymentStatus','url'=>array('create')),
	array('label'=>'View PaymentStatus','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage PaymentStatus','url'=>array('admin')),
	);
	?>

	<h1>Update PaymentStatus <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>