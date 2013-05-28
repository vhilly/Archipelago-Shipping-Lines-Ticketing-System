<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'transaction-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'type',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'payment_method',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'payment_status',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'uid',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'trans_date',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'input_date',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'ovamount',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'ovdiscount',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'reference',array('class'=>'span5','maxlength'=>100)); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>
