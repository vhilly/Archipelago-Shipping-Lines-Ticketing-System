<?php
$this->breadcrumbs=array(
	'Vessels'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

?>

	<h1>Update Vessel <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
