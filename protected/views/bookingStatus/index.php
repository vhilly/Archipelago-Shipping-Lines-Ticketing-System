<?php
/* @var $this BookingStatusController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Booking Statuses',
);

$this->menu=array(
	array('label'=>'Create BookingStatus', 'url'=>array('create')),
	array('label'=>'Manage BookingStatus', 'url'=>array('admin')),
);
?>

<h1>Booking Statuses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
