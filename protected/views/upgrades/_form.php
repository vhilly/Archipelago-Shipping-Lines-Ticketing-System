<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'upgrades-form',
	'enableAjaxValidation'=>false,
)); ?>



	<?php echo $form->dropDownListRow($model,'voyage',CHtml::listData(Voyage::model()->findAll(array('order'=>'id DESC')),'id','name'),array('class'=>'span2')); ?>

	<?php echo $form->textFieldRow($model,'amt',array('class'=>'span1','maxlength'=>20)); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Add' : 'Save',
		)); ?>
  <?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'danger','buttonType'=>'link','icon'=>'','url'=>Yii::app()->createUrl('upgrades/admin'),'label'=>'Cancel'));?>
</div>

<?php $this->endWidget(); ?>
