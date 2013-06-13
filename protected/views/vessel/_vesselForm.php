<?php

    $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
      'title' => 'Vessel',
      'headerIcon' => 'icon-th-list',
      'htmlOptions' => array('class'=>'span12')
    ));

?>
<div id=vesselClass class=span12>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'vessel-form',
	'enableAjaxValidation'=>false,
	'type'=>'inline',
)); ?>


        <?php echo $form->errorSummary($vessel); ?>
	<?php echo $form->textFieldRow($vessel,'name',array('class'=>'span3','maxlength'=>100)); ?>
	<?php echo $form->textAreaRow($vessel,'description',array('class'=>'span3','maxlength'=>100)); ?>
	<?php echo $form->textFieldRow($vessel,'passenger_limit',array('class'=>'span2','maxlength'=>4)); ?>
        <?php echo $form->dropDownListRow($vessel, 'blocked_seats',CHtml::listData(Seat::model()->findAll(),'id','name'), array('multiple'=>true)); ?>

	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$vessel->isNewRecord ? 'Create' : 'Save',
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
             'name'=>'passenger_limit',
           ),
           array(
             'name'=>'description',
           ),
           array(
             'filter'=>false,
             'sortable'=>false,
             'type'=>'raw',
             'name'=>'blocked_seats',
             'value'=>'$data->blocked_seats',
           ),
            
);
  $this->widget('bootstrap.widgets.TbGridView', array(
	'type' => 'striped bordered',
	'dataProvider'=> $vesselsTable->search(),
	'template' => "{items},{pager}",
        'htmlOptions'=>array('class'=>'span12'),
        'filter'=>$vesselsTable,
        'columns'=>$gridColumns
));
?>

<?php $this->endWidget(); ?>

