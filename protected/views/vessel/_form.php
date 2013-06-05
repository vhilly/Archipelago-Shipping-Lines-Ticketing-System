<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'vessel-form',
	'enableAjaxValidation'=>false,
)); ?>
	<p class="help-block">Fields with <span class="required">*</span> are required.</p>
	<?php echo $form->errorSummary($model); ?>
	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>100)); ?>
	<?php echo $form->textAreaRow($model,'desc',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
	<?php echo $form->textFieldRow($model,'passenger_limit',array('class'=>'span1')); ?>
	<?php echo $form->dropdownListRow($model,'blocked_seats',CHtml::listData(Seat::model()->findAll(),'id','name'),array('class'=>'span3','multiple'=>true,'style'=>'width:150px;','size'=>'10')); ?>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
