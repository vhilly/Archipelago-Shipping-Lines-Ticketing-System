<div style="<?=$purchase->current_step==3? '':'display:none'?>">
  <?php echo 'PASSENGER TOTAL FARE: P'.$purchase->total_fares?><br>
  <?php if($purchase->cargo_cost):?>
  <?php echo 'CARGO FARE: P'.$purchase->cargo_cost?><br>
  <?php endif;?>
  <?php echo 'OVERALL AMOUNT: P'.$purchase->payment_total?><br>
  <?php echo 'DISCOUNT: P'.$purchase->payment_discount?><br><br>
  <?php echo 'TOTAL AMOUNT: P'.($purchase->payment_total - $purchase->payment_discount)?><br><br>
  <?php 
  ?>
  <fieldset>
    <?php echo $form->radioButtonListRow($purchase, 'payment_method',CHtml::listData(PaymentMethod::model()->findAll(),'id','name')); ?>
    <?php echo $form->dropDownListRow($purchase, 'payment_status',CHtml::listData(PaymentStatus::model()->findAll(),'id','name')); ?>
  </fieldset>
</div>
