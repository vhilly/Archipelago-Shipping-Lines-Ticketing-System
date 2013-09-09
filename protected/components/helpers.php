<?php
    function numberGenerator($type){
      $digits = 6;
      $tktNumber = Counter::model()->findByPk($type);
      $tktNumber->saveCounters(array('counter'=>1));
      $tktNumber->save();
      return $tktNumber->code.str_pad($tktNumber->counter,$digits,0,STR_PAD_LEFT);
    }
?>
