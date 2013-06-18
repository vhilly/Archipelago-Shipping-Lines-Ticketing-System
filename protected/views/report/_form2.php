
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
'id'=>'inlineForm',
'type'=>'inline',
'htmlOptions'=>array('class'=>'well'),
)); ?>
 

 <?php echo $form->dropDownListRow($model, 'voyage',CHtml::listData(Voyage::model()->findAll(),'id','name'))?>
 <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Generate Report')); ?>
 
 <?php $this->endWidget(); ?>
