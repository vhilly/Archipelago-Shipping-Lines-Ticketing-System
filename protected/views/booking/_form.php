<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
  'id'=>'booking-form',
  'enableAjaxValidation'=>false,
)); ?>

  <p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>


<?php echo $form->textFieldRow($model,'tkt_serial',array('class'=>'span5')); ?>

<?php echo $form->dropDownListRow($model,'status',CHtml::listData(BookingStatus::model()->findAll(),'id','name'),array('class'=>'span5')); ?>
<?php echo $form->dropDownListRow($model,'voyage',CHtml::listData(Voyage::model()->findAll(),'id','name'),array('class'=>'span2')); ?>
<?php echo $form->dropDownListRow($model,'seat',CHtml::listData(Seat::model()->findAll(),'id','name'),array('class'=>'span2')); ?>


  <div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
      'buttonType'=>'submit',
      'type'=>'primary',
      'label'=>$model->isNewRecord ? 'Create' : 'Save',
    )); ?>
  </div>

<?php $this->endWidget(); ?>
