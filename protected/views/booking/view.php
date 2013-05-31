<?php
  $this->widget('bootstrap.widgets.TbEditableDetailView', array(
    'id' => 'booking-details',
    'data' => Booking::model()->findByPk($booking->id),
    'url' => $this->createUrl('ticket/editableSaver'), //common submit url for all editables
    'attributes'=>array(
      array('label'=>'SEAT','value'=>'dds'),
    )
  ));
?>
