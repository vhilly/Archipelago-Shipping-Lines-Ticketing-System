<?php
$this->breadcrumbs=array(
	'Booking Statuses',
);

$this->menu=array(
array('label'=>'Create BookingStatus','url'=>array('create')),
array('label'=>'Manage BookingStatus','url'=>array('admin')),
);
?>

<h1>Booking Statuses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
