<?php
$this->breadcrumbs=array(
	'Vessels'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Vessel','url'=>array('index')),
	array('label'=>'Manage Vessel','url'=>array('admin')),
);
?>

<h1>Create Vessel</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>