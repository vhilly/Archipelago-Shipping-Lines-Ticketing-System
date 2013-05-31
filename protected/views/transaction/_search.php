<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

		<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'type',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'payment_method',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'payment_status',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'uid',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'trans_date',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'input_date',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'ovamount',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'ovdiscount',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'reference',array('class'=>'span5','maxlength'=>100)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
