<?php
$this->breadcrumbs=array(
	'Payment Statuses'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List PaymentStatus','url'=>array('index')),
array('label'=>'Manage PaymentStatus','url'=>array('admin')),
);
?>

<h1>Create PaymentStatus</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>