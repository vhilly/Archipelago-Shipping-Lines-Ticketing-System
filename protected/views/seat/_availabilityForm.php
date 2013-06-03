
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
'id'=>'inlineForm',
'type'=>'inline',
'htmlOptions'=>array('class'=>'well'),
)); ?>
 
  <p class="help-block">Fields with <span class="required">*</span> are required.</p>

 <?php echo $form->errorSummary($model); ?>
 <?php echo $form->datepickerRow($model, 'departure_date',
   array('prepend'=>'<i class="icon-calendar"></i>',
        'options'=>array('format'=>'yyyy-mm-dd'),
   )
 ); 
 ?>
 <?php echo $form->dropDownListRow($model, 'voyage',CHtml::listData(Voyage::model()->findAll(),'id','name'))?>
 <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Generate Report')); ?>
 
 <?php $this->endWidget(); ?>
