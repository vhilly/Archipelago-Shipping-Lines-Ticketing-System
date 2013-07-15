<?php
$this->breadcrumbs=array(
	'Tickets'=>array('index'),
	$booking->id,
);

?>
<?php
  $this->widget('bootstrap.widgets.TbEditableDetailView', array(
    'id' => 'booking-details',
    'data' => Booking::model()->findByPk($booking->id),
    'url' => $this->createUrl('booking/editableSaver'), //common submit url for all editables
    'attributes'=>array(
      array('label'=>'PRICE','value'=>$booking->rate0->price),
      array('label'=>'SEAT','value'=>isset($booking->seat) ? $booking->seat0->name :'NO ASSIGNED SEAT'),
      array('label'=>'CLASS','value'=>$booking->rate0->class0->name),
      array('label'=>'RATE','value'=>$booking->rate0->type0->name),
      array('label'=>'VOYAGE','value'=>$booking->voyage0->name),
      array('label'=>'VESSEL','value'=>$booking->voyage0->vessel0->name),
      array('label'=>'DEPARTURE DATE','value'=>$booking->voyage0->departure_date),
      array('label'=>'DEPARTURE TIME','value'=>$booking->voyage0->departure_time),
      array('label'=>'ARRIVAL TIME','value'=>$booking->voyage0->arrival_time),
    )
  ));
?>
