<?php
$this->breadcrumbs=array(
	'Misc Fees'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List MiscFees','url'=>array('index')),
array('label'=>'Manage MiscFees','url'=>array('admin')),
);
?>

<h1>Create MiscFees</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>