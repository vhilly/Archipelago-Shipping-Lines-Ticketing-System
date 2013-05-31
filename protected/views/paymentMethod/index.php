<?php
$this->breadcrumbs=array(
	'Payment Methods',
);

$this->menu=array(
array('label'=>'Create PaymentMethod','url'=>array('create')),
array('label'=>'Manage PaymentMethod','url'=>array('admin')),
);
?>

<h1>Payment Methods</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
