<?php
    $sc =SeatingClass::model()->findAll();
    $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
      'title' => 'Seats',
      'headerIcon' => 'icon-th-list',
      'htmlOptions' => array('class'=>'seat_avail')
    ));

?>
<div id=seat>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'seat-form',
	'enableAjaxValidation'=>false,
	'type'=>'inline',
)); ?>


<?php echo $form->errorSummary($seat); ?>
	<?php echo $form->textFieldRow($seat,'name',array('class'=>'span3','maxlength'=>100)); ?>
	<?php echo $form->radioButtonListRow($seat,'active',array('Y'=>'Yes','N'=>'No')); ?>
	<?php echo $form->dropDownListRow($seat,'seating_class',CHtml::listData($sc,'id','name')); ?>

	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$seat->isNewRecord ? 'Create' : 'Save',
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
             'name'=>'seating_class',
             'filter'=>CHtml::listData($sc,'id','name'),
             'value'=>'$data->seatingClass->name'
           ),
           array(
             'name'=>'active',
              'filter'=>array('Y'=>'Yes','N'=>'No'),
             'value'=>'$data->active == "Y" ? "Yes" : "No"',
           ),
            
);
  $this->widget('bootstrap.widgets.TbGridView', array(
	'type' => 'striped bordered',
	'dataProvider'=> $seatsTable->search(),
	'template' => "{items},{pager}",
        'htmlOptions'=>array('class'=>''),
        'filter'=>$seatsTable,
        'columns'=>$gridColumns
));
?>

<?php $this->endWidget(); ?>

