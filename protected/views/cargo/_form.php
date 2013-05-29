<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'cargo-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'shipper',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'company',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'destination',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'address',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'cargo_class',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'arcticle_no',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textAreaRow($model,'article_desc',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'weight',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'length',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'contact',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'voyage',array('class'=>'span5')); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>
