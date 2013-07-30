<?php
$this->breadcrumbs=array(
	'Refunded Tkts',
);

$this->menu=array(
array('label'=>'Create RefundedTkts','url'=>array('create')),
array('label'=>'Manage RefundedTkts','url'=>array('admin')),
);
?>

<h1>Refunded Tkts</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
