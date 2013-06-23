<div style="<?=$purchase->current_step==3? '':'display:none'?>">
  <?php echo 'TOTAL AMOUNT: P'.$purchase->payment_total?><br><br>
  <fieldset>
    <?php echo $form->radioButtonListRow($purchase, 'payment_method',CHtml::listData(PaymentMethod::model()->findAll(),'id','name')); ?>
    <?php echo $form->dropDownListRow($purchase, 'payment_status',CHtml::listData(PaymentStatus::model()->findAll(),'id','name')); ?>
  </fieldset>
</div>
