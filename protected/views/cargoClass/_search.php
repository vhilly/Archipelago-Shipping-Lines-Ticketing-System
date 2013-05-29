<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

		<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'class',array('class'=>'span5','maxlength'=>100)); ?>

		<?php echo $form->textAreaRow($model,'desc',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

		<?php echo $form->textFieldRow($model,'lane_meter',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'lane_meter_rate',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'proposed_tariff',array('class'=>'span5','maxlength'=>20)); ?>

		<?php echo $form->textFieldRow($model,'as_of',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'active',array('class'=>'span5','maxlength'=>1)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>