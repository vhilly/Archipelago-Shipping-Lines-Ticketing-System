<?php
$this->breadcrumbs=array(
	'Stowage Cargo Maps'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List StowageCargoMap','url'=>array('index')),
array('label'=>'Manage StowageCargoMap','url'=>array('admin')),
);
?>

<h1>Create StowageCargoMap</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>