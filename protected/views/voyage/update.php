<?php
$this->breadcrumbs=array(
	'Voyages'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

	?>

	<h1>Update Voyage</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
