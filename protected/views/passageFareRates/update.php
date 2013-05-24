<?php
$this->breadcrumbs=array(
	'Passage Fare Rates'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PassageFareRates','url'=>array('index')),
	array('label'=>'Create PassageFareRates','url'=>array('create')),
	array('label'=>'View PassageFareRates','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage PassageFareRates','url'=>array('admin')),
);
?>

<h1>Update PassageFareRates <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>