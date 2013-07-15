<?php
$this->breadcrumbs=array(
	'Misc Fees',
);

$this->menu=array(
array('label'=>'Create MiscFees','url'=>array('create')),
array('label'=>'Manage MiscFees','url'=>array('admin')),
);
?>

<h1>Misc Fees</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
