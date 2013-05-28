<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'route-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span2','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'from',array('class'=>'span2','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'to',array('class'=>'span2','maxlength'=>100)); ?>

        <?php echo $form->radioButtonListRow($model, 'active',
          array('Y'=>'Yes','N'=>'No')); 
        ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
