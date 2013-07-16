<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'customer-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'company',array('class'=>'span3','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'contact_person',array('class'=>'span2','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'contact_no',array('class'=>'span2','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'address',array('class'=>'span3','maxlength'=>250)); ?>

	<?php echo $form->dropDownListRow($model,'active',array('Y'=>'Yes','N'=>'No'),array('class'=>'span2','maxlength'=>1)); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Add' : 'Save',
		)); ?>
  <?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'danger','buttonType'=>'link','icon'=>'','url'=>Yii::app()->createUrl('customer/admin'),'label'=>'Cancel'));?>
</div>

<?php $this->endWidget(); ?>
