<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'voyage-form',
	'enableAjaxValidation'=>false,
)); ?>


<?php echo $form->dropDownListRow($model,'status',CHtml::listData(VoyageStatus::model()->findAll(),'id','name'),array('class'=>'span5')); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Add' : 'Save',
		)); ?>
  <?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'danger','buttonType'=>'link','icon'=>'','url'=>Yii::app()->createUrl('voyage/index'),'label'=>'Cancel'));?>
</div>

<?php $this->endWidget(); ?>
