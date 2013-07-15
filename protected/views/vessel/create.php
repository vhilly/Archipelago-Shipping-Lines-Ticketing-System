<?php
$this->breadcrumbs=array(
	'Vessels'=>array('index'),
	'Add',
);

?>

<h1>Add Vessel</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
