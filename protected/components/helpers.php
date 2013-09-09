<?php
    function numberGenerator($type){
      $countBooking = Counter::model()->findByPk($type);
      $countBooking->saveCounters(array('counter'=>1));
      $countBooking->save();
      return $countBooking->counter;
    }
?>
