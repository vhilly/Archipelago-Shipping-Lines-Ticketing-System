<?php
$this->breadcrumbs=array(
	'Passage Fare Rates'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Passage Fare Rates','url'=>array('index')),
	array('label'=>'Manage Passage Fare Rates','url'=>array('admin')),
);
?>

<h1>Create New  Fare Rate</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
