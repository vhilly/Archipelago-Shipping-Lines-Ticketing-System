
  <?php echo 'STEP:'.$purchase->step?>
<?php echo $this->renderPartial('_form', array('purchase'=>$purchase,'passengers'=>$passengers,'fares'=>$fares,'tickets'=>$tickets,'JSONforTransact'=>$JSONforTransact)); ?>
