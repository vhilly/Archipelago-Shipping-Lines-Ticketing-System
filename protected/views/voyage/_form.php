<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'voyage-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->dropDownListRow($model,'vessel',CHtml::listData(Vessel::model()->findAll(),'id','name'),array('class'=>'span5')); ?>

	<?php echo $form->dropDownListRow($model,'route',CHtml::listData(Route::model()->findAll(),'id','name'),array('class'=>'span5')); ?>

        <?php echo $form->datePickerRow($model, 'departure_date', array('append'=>'<i class="icon-calendar" style="cursor:pointer"></i>','class'=>'span2','options'=>array( 'format' => 'yyyy-mm-dd')));?>

        <?php echo $form->timepickerRow($model, 'departure_time', array('append'=>'<i class="icon-time" style="cursor:pointer"></i>','class'=>'span2','options'=>array('template'=>'modal','defaultTime'=>'01:00','minuteStep'=>1,'showMeridian'=>false)));?>

        <?php echo $form->timepickerRow($model, 'arrival_time', array('append'=>'<i class="icon-time" style="cursor:pointer"></i>','class'=>'span2','options'=>array('template'=>'modal','defaultTime'=>'02:30','minuteStep'=>1,'showMeridian'=>false)));?>


<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Add' : 'Save',
		)); ?>
  <?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'danger','buttonType'=>'link','icon'=>'','url'=>Yii::app()->createUrl('voyage/admin'),'label'=>'Cancel'));?>
</div>

<?php $this->endWidget(); ?>
