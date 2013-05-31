<?php
$this->breadcrumbs=array(
	'Stowages'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List Stowage','url'=>array('index')),
array('label'=>'Manage Stowage','url'=>array('admin')),
);
?>

<h1>Create Stowage</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>