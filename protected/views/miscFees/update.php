<?php
$this->breadcrumbs=array(
	'Misc Fees'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List MiscFees','url'=>array('index')),
	array('label'=>'Create MiscFees','url'=>array('create')),
	array('label'=>'View MiscFees','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage MiscFees','url'=>array('admin')),
	);
	?>

	<h1>Update MiscFees <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>