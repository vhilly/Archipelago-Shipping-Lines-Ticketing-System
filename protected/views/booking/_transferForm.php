<style>
#Booking_voyage.voyage {
  width:200px;
}
</style>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
  'id'=>'booking-transfer-form',
  'enableAjaxValidation'=>false,
)); ?>
  <?php echo $form->hiddenField($model,'transaction') ?>
  <?php echo $form->hiddenField($model,'booking_no') ?>
  <?php echo $form->hiddenField($model,'tkt_no') ?>
  <?php echo $form->hiddenField($model,'passenger') ?>
  <?php echo $form->hiddenField($model,'seat') ?>
  <?php echo $form->hiddenField($model,'status') ?>
  <?php echo $form->hiddenField($model,'date_booked') ?>
  <?php echo $form->hiddenField($model,'rate') ?>
<?php
?>
<table>
  <tr>
    <td>SELECT VOYAGE:</td>
    <td><?php echo $form->dropDownList($model,'voyage',CHtml::listData(Voyage::model()->findAll(array('condition'=>'status=1','params'=>array(':id'=>$model->voyage))),'id','name'),array('class'=>'voyage seatChange'))?></td>
    <!--<td><?php echo $form->dropDownList($model,'voyage',CHtml::listData(SeatingClass::model()->findAll(),'id','name'),array('class'=>'voyage seatChange'))?></td>-->
    <td>Seat:</td>
    <td style="padding:0"><div id="seatValue" class="well well-small" style="width:25px;font-weight:bold;background:#f68938"><?=$model->seat0->name?><div></td>
    <td valign=top><?php $this->widget('bootstrap.widgets.TbButton', array(
      'buttonType'=>'submit',
      'type'=>'primary',
      'label'=>'Transfer'
    )); ?></td>
  </tr>
</table>
<div id='seatBox'></div>
<?php $this->endWidget(); ?>
<script>
  $('#seatBox').load('<?=Yii::app()->baseUrl;?>?r=seat/map&class=<?=$model->rate0->class?>&id=Booking_seat&voyage=<?=$model->voyage?>');

  $('.seatChange').bind('change', function(Event){
    $('#seatBox').load('<?=Yii::app()->baseUrl;?>?r=seat/map&class=<?=$model->rate0->class?>&id=Booking_seat&voyage='+this.value);
  });

</script>
