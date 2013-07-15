<?php
  $this->widget('bootstrap.widgets.TbEditableDetailView', array(
    'id' => 'booking-details',
    'data' => BookingCargo::model()->findByPk($bookingCargo->id),
    'url' => $this->createUrl('booking/editableSaver'), //common submit url for all editables
    'attributes'=>array(
      array('label'=>'PRICE','value'=>$bookingCargo->rate0->proposed_tariff),
      array('label'=>'STOWAGE','value'=>isset($bookingCargo->stowage) ? $bookingCargo->stowage0->name :'NO ASSIGNED STOWAGE'),
      array('label'=>'CLASS','value'=>$bookingCargo->cargo0->cargoClass->name),
      array('label'=>'VOYAGE','value'=>$bookingCargo->voyage0->name),
      array('label'=>'VESSEL','value'=>$bookingCargo->voyage0->vessel0->name),
      array('label'=>'DEPARTURE DATE','value'=>$bookingCargo->voyage0->departure_date),
      array('label'=>'DEPARTURE TIME','value'=>$bookingCargo->voyage0->departure_time),
      array('label'=>'ARRIVAL TIME','value'=>$bookingCargo->voyage0->arrival_time),
    )
  ));
?>
