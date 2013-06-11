<?php
$this->breadcrumbs=array(
	'Passengers'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List Passenger','url'=>array('index')),
array('label'=>'Manage Passenger','url'=>array('admin')),
);
?>

<h1>Create Passenger</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>