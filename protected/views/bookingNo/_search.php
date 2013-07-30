<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

		<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'tkt_no',array('class'=>'span5','maxlength'=>32)); ?>

		<?php echo $form->textFieldRow($model,'booking_no',array('class'=>'span5','maxlength'=>32)); ?>

		<?php echo $form->textFieldRow($model,'transaction',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'passenger',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'voyage',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'seat',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'status',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'date_booked',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'rate',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'type',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
