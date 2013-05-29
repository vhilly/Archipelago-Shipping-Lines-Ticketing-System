<?php
$this->breadcrumbs=array(
	'Cargos'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List Cargo','url'=>array('index')),
array('label'=>'Manage Cargo','url'=>array('admin')),
);
?>

<h1>Create Cargo</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>