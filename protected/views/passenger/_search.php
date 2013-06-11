<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

		<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'first_name',array('class'=>'span5','maxlength'=>100)); ?>

		<?php echo $form->textFieldRow($model,'last_name',array('class'=>'span5','maxlength'=>100)); ?>

		<?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>100)); ?>

		<?php echo $form->textFieldRow($model,'contact',array('class'=>'span5','maxlength'=>100)); ?>

		<?php echo $form->textFieldRow($model,'middle_name',array('class'=>'span5','maxlength'=>100)); ?>

		<?php echo $form->textFieldRow($model,'prefix',array('class'=>'span5','maxlength'=>5)); ?>

		<?php echo $form->textFieldRow($model,'gender',array('class'=>'span5','maxlength'=>1)); ?>

		<?php echo $form->textFieldRow($model,'civil_status',array('class'=>'span5','maxlength'=>1)); ?>

		<?php echo $form->textFieldRow($model,'nationality',array('class'=>'span5','maxlength'=>100)); ?>

		<?php echo $form->textFieldRow($model,'address',array('class'=>'span5','maxlength'=>255)); ?>

		<?php echo $form->textFieldRow($model,'birth_date',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
