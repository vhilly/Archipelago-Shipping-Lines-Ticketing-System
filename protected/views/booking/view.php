<div class='pull-right'>
<?php
$this->widget('bootstrap.widgets.TbEditableField', array(
   'type'      => 'select',
   'model'     => $booking,
   'attribute' => 'status',
   'url'       => $this->createUrl('booking/editableSaver'),  //url for submit data
   'source'    => CHtml::listData(BookingStatus::model()->findAll(),'id','name'),
   'placement' => 'bottom', 
));	

?>
</div>
