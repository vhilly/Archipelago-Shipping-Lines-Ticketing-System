<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'cargo-class-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span2','maxlength'=>100)); ?>

	<?php echo $form->textAreaRow($model,'description',array('rows'=>4, 'cols'=>50, 'class'=>'span4')); ?>

	<?php echo $form->textFieldRow($model,'lane_meter',array('class'=>'span1')); ?>

	<?php echo $form->textFieldRow($model,'bundled_passenger',array('class'=>'span1')); ?>

	<?php echo $form->textFieldRow($model,'active',array('class'=>'span1','maxlength'=>1)); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
  <?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'danger','buttonType'=>'link','icon'=>'','url'=>Yii::app()->createUrl('cargoClass/admin'),'label'=>'Cancel'));?>
</div>

<?php $this->endWidget(); ?>
