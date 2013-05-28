<?php
/* @var $this BookingStatusController */
/* @var $model BookingStatus */

$this->breadcrumbs=array(
	'Booking Statuses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BookingStatus', 'url'=>array('index')),
	array('label'=>'Manage BookingStatus', 'url'=>array('admin')),
);
?>

<h1>Create BookingStatus</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>