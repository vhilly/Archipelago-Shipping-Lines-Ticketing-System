<?php
$this->breadcrumbs=array(
	'Passage Fare Rates'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List PassageFareRates','url'=>array('index')),
array('label'=>'Manage PassageFareRates','url'=>array('admin')),
);
?>

<h1>Create PassageFareRates</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>