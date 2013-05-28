<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>


	<?php echo $form->textFieldRow($model,'type',array('class'=>'span5','maxlength'=>100)); ?>
	<?php echo $form->textFieldRow($model,'proposed',array('class'=>'span5','maxlength'=>100)); ?>
	<?php echo $form->textFieldRow($model,'class',array('class'=>'span5','maxlength'=>100)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
