<?php
$this->breadcrumbs=array(
	'Advance Tickets'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List AdvanceTicket','url'=>array('index')),
	array('label'=>'Create AdvanceTicket','url'=>array('create')),
	array('label'=>'View AdvanceTicket','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage AdvanceTicket','url'=>array('admin')),
	);
	?>

	<h1>Update AdvanceTicket <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>