<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'passage-fare-rates-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'type',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'proposed',array('class'=>'span5','maxlength'=>100)); ?>

        <?php echo $form->dropDownListRow($model, 'class',CHtml::listData(SeatingClass::model()->findAll(),'id','name')); ?>
	<?php echo $form->textFieldRow($model,'price',array('class'=>'span1','maxlength'=>4)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
