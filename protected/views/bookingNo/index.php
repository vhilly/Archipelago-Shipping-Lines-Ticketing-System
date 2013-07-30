<?php
$this->breadcrumbs=array(
	'Booking Nos',
);

$this->menu=array(
array('label'=>'Create BookingNo','url'=>array('create')),
array('label'=>'Manage BookingNo','url'=>array('admin')),
);
?>

<h1>Booking Nos</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
