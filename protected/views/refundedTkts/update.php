<?php
$this->breadcrumbs=array(
	'Refunded Tkts'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List RefundedTkts','url'=>array('index')),
	array('label'=>'Create RefundedTkts','url'=>array('create')),
	array('label'=>'View RefundedTkts','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage RefundedTkts','url'=>array('admin')),
	);
	?>

	<h1>Update RefundedTkts <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>