<?php
  $this->renderPartial('_seatClassForm',array('seatClass'=>$seatClass,'seatClassTable'=>$seatClassTable));
  $this->renderPartial('_seatForm',array('seat'=>$seat,'seatsTable'=>$seatsTable));
?>
