<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'transaction-type-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'navigation_title',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'passenger',array('class'=>'span5','maxlength'=>1)); ?>

	<?php echo $form->textFieldRow($model,'cargo',array('class'=>'span5','maxlength'=>1)); ?>

	<?php echo $form->textFieldRow($model,'discount',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'discount_percent',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'free_passenger',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'minimum_passenger',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'maximum_passenger',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'free_cargo',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'minimum_cargo',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'active',array('class'=>'span5','maxlength'=>1)); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>
