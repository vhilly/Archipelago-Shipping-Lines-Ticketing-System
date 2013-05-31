<?php
$this->breadcrumbs=array(
	'Cargo Classes'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List CargoClass','url'=>array('index')),
array('label'=>'Manage CargoClass','url'=>array('admin')),
);
?>

<h1>Create CargoClass</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>