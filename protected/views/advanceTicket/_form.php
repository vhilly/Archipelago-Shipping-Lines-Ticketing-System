<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'advance-ticket-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>


	<?php echo $form->dropDownListRow($model,'class',CHtml::listData(SeatingClass::model()->findAll(),'id','name'),array('class'=>'span3')); ?>

	<?php echo $form->dropDownListRow($model,'type',CHtml::listData(PassageFareTypes::model()->findAll(),'id','name'),array('class'=>'span3')); ?>


	<?php echo $form->textFieldRow($model,'first_name',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'last_name',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'age',array('class'=>'span5')); ?>

        <?php echo $form->datePickerRow($model, 'validity_date', array('append'=>'<i class="icon-calendar" style="cursor:pointer"></i>','class'=>'span2','options'=>array( 'format' => 'yyyy-mm-dd')));?>
<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
  <?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'danger','buttonType'=>'link','icon'=>'','url'=>Yii::app()->createUrl('advanceTicket/admin'),'label'=>'Cancel'));?>
</div>

<?php $this->endWidget(); ?>
