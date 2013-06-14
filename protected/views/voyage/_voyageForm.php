<?php
    $ves = Vessel::model()->findAll();
    $rt = Route::model()->findAll();
    $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
      'title' => 'Voyage',
      'headerIcon' => 'icon-th-list',
      'htmlOptions' => array('class'=>'seat_avail')
    ));

?>
<div id=voyageClass class=span12>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'voyage-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
)); ?>


        <?php echo $form->errorSummary($voyage); ?>
	<?php echo $form->textFieldRow($voyage,'name',array('class'=>'span2','maxlength'=>100)); ?>
	<?php echo $form->dropDownListRow($voyage,'vessel',CHtml::listData($ves,'id','name'),array('class'=>'span2','maxlength'=>100)); ?>
	<?php echo $form->dropDownListRow($voyage,'route',CHtml::listData($rt,'id','name'),array('class'=>'span2','maxlength'=>100)); ?>
        <?php echo $form->datePickerRow($voyage, 'departure_date', array('append'=>'<i class="icon-calendar" style="cursor:pointer"></i>','class'=>'span2','options'=>array( 'format' => 'yyyy-mm-dd')));?>
        <?php echo $form->timepickerRow($voyage, 'departure_time', array('append'=>'<i class="icon-time" style="cursor:pointer"></i>','class'=>'span2'));?>
        <?php echo $form->timepickerRow($voyage, 'arrival_time', array('append'=>'<i class="icon-time" style="cursor:pointer"></i>','class'=>'span2'));?>

	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$voyage->isNewRecord ? 'Create' : 'Save',
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
             'name'=>'vessel',
           ),
           array(
             'name'=>'route',
           ),
           array(
             'name'=>'departure_date',
           ),
           array(
             'name'=>'departure_time',
           ),
           array(
             'name'=>'arrival_time',
           ),
            
);
  $this->widget('bootstrap.widgets.TbGridView', array(
	'type' => 'striped bordered',
	'dataProvider'=> $voyagesTable->search(),
	'template' => "{items},{pager}",
        'htmlOptions'=>array('class'=>'span10 fields'),
        'filter'=>$voyagesTable,
        'columns'=>$gridColumns
));
?>

<?php $this->endWidget(); ?>

