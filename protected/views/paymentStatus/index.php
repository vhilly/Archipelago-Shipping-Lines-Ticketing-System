<?php
$this->breadcrumbs=array(
	'Payment Statuses',
);

$this->menu=array(
array('label'=>'Create PaymentStatus','url'=>array('create')),
array('label'=>'Manage PaymentStatus','url'=>array('admin')),
);
?>

<h1>Payment Statuses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
