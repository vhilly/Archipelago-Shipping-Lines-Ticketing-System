<?php
$this->breadcrumbs=array(
	'Customers',
);

$this->menu=array(
array('label'=>'Create Customer','url'=>array('create')),
array('label'=>'Manage Customer','url'=>array('admin')),
);
?>

<h1>Customers</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
