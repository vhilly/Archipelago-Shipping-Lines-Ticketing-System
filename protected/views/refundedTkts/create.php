<?php
$this->breadcrumbs=array(
	'Refunded Tkts'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List RefundedTkts','url'=>array('index')),
array('label'=>'Manage RefundedTkts','url'=>array('admin')),
);
?>

<h1>Create RefundedTkts</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>