<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'route-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'from_port',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'to_port',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'active',array('class'=>'span5','maxlength'=>1)); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
  <?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'danger','buttonType'=>'link','icon'=>'','url'=>Yii::app()->createUrl('route/admin'),'label'=>'Cancel'));?>
</div>

<?php $this->endWidget(); ?>
