<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'daily-cashflow-field-form',
	'enableAjaxValidation'=>false,
)); ?>


<?php echo $form->errorSummary($model); ?>
<?php echo $form->textFieldRow($model,'name',array('class'=>'span3','maxlength'=>255)); ?>
<?php echo $form->dropDownListRow($model,'parent',CHtml::listData(DailyCashflowField::model()->findAll(array('condition'=>'parent IS NULL')),'id','name'),array('class'=>'span3','empty'=>'None')); ?>
<?php echo $form->dropDownListRow($model,'value_type',array(1=>'None',2=>'User Input',3=>'Mathematical Operation'))?>
<?php echo $form->textFieldRow($model,'weight',array('class'=>'span1')); ?>
<div class="form-actions">
  <?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Add' : 'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>
