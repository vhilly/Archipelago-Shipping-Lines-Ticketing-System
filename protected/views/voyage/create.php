<?php
$this->breadcrumbs=array(
	'Voyages'=>array('index'),
	'Create',
);

?>

<h1>Add Voyage</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
