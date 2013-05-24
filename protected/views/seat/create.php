<?php
$this->breadcrumbs=array(
	'Seats'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Seat','url'=>array('index')),
	array('label'=>'Manage Seat','url'=>array('admin')),
);
?>

<h1>Create Seat</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>