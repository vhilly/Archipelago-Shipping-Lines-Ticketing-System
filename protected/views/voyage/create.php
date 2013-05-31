<?php
$this->breadcrumbs=array(
	'Voyages'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Voyage','url'=>array('index')),
	array('label'=>'Manage Voyage','url'=>array('admin')),
);
?>

<h1>Create Voyage</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>