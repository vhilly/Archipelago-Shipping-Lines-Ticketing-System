<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'booking-no-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>



	<?php echo $form->textFieldRow($model,'tkt_no',array('class'=>'span3','maxlength'=>12,'disabled'=>'disabled')); ?>

	<?php echo $form->textFieldRow($model,'booking_no',array('class'=>'span3','maxlength'=>32)); ?>

	<?php echo $form->textFieldRow($model,'transaction',array('class'=>'span3','disabled'=>'disabled')); ?>

	<?php echo $form->textFieldRow($model,'First Name',array('class'=>'span3','disabled'=>'disabled','value'=>$model->passenger0->first_name)); ?>

	<?php echo $form->textFieldRow($model,'Last Name',array('class'=>'span3','disabled'=>'disabled','value'=>$model->passenger0->last_name)); ?>

	<?php echo $form->textFieldRow($model,'voyage',array('class'=>'span3','disabled'=>'disabled')); ?>



<!--
	<?php echo $form->textFieldRow($model,'seat',array('class'=>'span3','disabled'=>'disabled')); ?>

	<?php echo $form->textFieldRow($model,'status',array('class'=>'span3','disabled'=>'disabled')); ?>

	<?php echo $form->textFieldRow($model,'date_booked',array('class'=>'span3','disabled'=>'disabled')); ?>

	<?php echo $form->textFieldRow($model,'rate',array('class'=>'span3','disabled'=>'disabled')); ?>

	<?php echo $form->textFieldRow($model,'type',array('class'=>'span3','disabled'=>'disabled')); ?>
-->





<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>
