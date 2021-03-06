
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'vessel-form',
	'enableAjaxValidation'=>false,
        
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span3','maxlength'=>100)); ?>

	<?php echo $form->textAreaRow($model,'description',array('rows'=>6, 'cols'=>50, 'class'=>'span4')); ?>

	<?php echo $form->textFieldRow($model,'passenger_limit',array('class'=>'span1')); ?>


<div class="form-actions">
  <?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Add' : 'Save',)); 
  ?>
  <?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'danger','buttonType'=>'link','icon'=>'','url'=>Yii::app()->createUrl('vessel/admin'),'label'=>'Cancel'));?>
</div>

<?php $this->endWidget(); ?>
