<?php

    $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
      'title' => 'Seating Class',
      'headerIcon' => 'icon-th-list',
      'htmlOptions' => array('class'=>'seat_avail')
    ));

?>
<div id=seatClass >
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'seat-class-form',
	'enableAjaxValidation'=>false,
	'type'=>'inline',
)); ?>


<?php echo $form->errorSummary($seatClass); ?>
	<?php echo $form->textFieldRow($seatClass,'name',array('class'=>'span3','maxlength'=>100)); ?>
	<?php echo $form->textFieldRow($seatClass,'description',array('class'=>'span3','maxlength'=>100)); ?>

	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$seatClass->isNewRecord ? 'Create' : 'Save',
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
            
);
  $this->widget('bootstrap.widgets.TbGridView', array(
	'type' => 'striped bordered',
	'dataProvider'=> $seatClassTable->search(),
	'template' => "{items},{pager}",
        'htmlOptions'=>array('class'=>''),
        'filter'=>$seatClassTable,
        'columns'=>$gridColumns
));
?>

<?php $this->endWidget(); ?>

