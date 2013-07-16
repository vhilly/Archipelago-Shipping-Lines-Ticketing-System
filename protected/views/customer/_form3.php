<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'customer-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->hiddenField($model,'company',array('class'=>'span3','maxlength'=>100)); ?>
	<?php echo $form->textFieldRow($model,'plate_no',array('class'=>'span3','maxlength'=>100)); ?>
	<?php echo $form->dropDownListRow($model,'classification',CHtml::listData(CargoClass::model()->findAll(),'id','name'),array('class'=>'span3','maxlength'=>100)); ?>



<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Add' : 'Save',
		)); ?>
  <?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'danger','buttonType'=>'link','icon'=>'','url'=>Yii::app()->createUrl("customer/authorized&AuthorizedCustShipper[company]=$model->company&AuthorizedCustVehicle[company]=$model->company"),'label'=>'Cancel'));?>
</div>

<?php $this->endWidget(); ?>
