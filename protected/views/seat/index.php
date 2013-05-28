<?php
$this->breadcrumbs=array(
	'Seats',
);

$this->menu=array(
	array('label'=>'Create Seat','url'=>array('create')),
	array('label'=>'Manage Seat','url'=>array('admin')),
);
?>

<h1>Seats</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
