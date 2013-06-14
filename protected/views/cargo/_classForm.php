<?php

    $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
      'title' => 'Cargo Class',
      'headerIcon' => 'icon-th-list',
      'htmlOptions' => array('class'=>'seat_avail')
    ));

?>
<div id=cargoClass>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'cargo-class-form',
	'enableAjaxValidation'=>false,
	'type'=>'inline',
)); ?>


<?php echo $form->errorSummary($class); ?>
	<?php echo $form->textFieldRow($class,'name',array('class'=>'span3','maxlength'=>100)); ?>
	<?php echo $form->textAreaRow($class,'description',array('class'=>'span3','maxlength'=>100)); ?>
	<?php echo $form->textFieldRow($class,'lane_meter',array('class'=>'span3','maxlength'=>100)); ?>
	<?php echo $form->radioButtonListRow($class,'active',array('Y'=>'Yes','N'=>'No')); ?>

	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$class->isNewRecord ? 'Create' : 'Save',
		)); ?>

<?php $this->endWidget(); ?>
</div>

<div class=clearfix></div>
<?php
$gridColumns = array(
           array(
             'name'=>'name',
           ),
           array(
             'name'=>'description',
           ),
           array(
             'name'=>'lane_meter',
           ),
            
);
  $this->widget('bootstrap.widgets.TbGridView', array(
	'type' => 'striped bordered',
	'dataProvider'=> $classTable->search(),
	'template' => "{items},{pager}",
        'htmlOptions'=>array('class'=>''),
        'filter'=>$classTable,
     //   'ajaxUpdate'=>false,
        'afterAjaxUpdate'=>"function() {
          jQuery('#Transaction_trans_date').datepicker({'format':'yyyy-mm-dd','language':'en','weekStart':0});
          jQuery('#Transaction_input_date').datepicker({'format':'yyyy-mm-dd','language':'en','weekStart':0});
        }",
	//'columns' => array(
	//	'date_booked',
        //)
        'columns'=>$gridColumns
));
?>

<?php $this->endWidget(); ?>

