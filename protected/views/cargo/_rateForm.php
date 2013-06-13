<?php

    $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
      'title' => 'Cargo Fare Rates',
      'headerIcon' => 'icon-th-list',
      'htmlOptions' => array('class'=>' span12')
    ));

?>

<div id=cargoClass class=span12>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'cargo-rate-form',
	'enableAjaxValidation'=>false,
	'type'=>'inline',
      'htmlOptions' => array('class'=>' well')
)); ?>


<?php echo $form->errorSummary($rates); ?>
	<?php echo $form->dropDownListRow($rates,'route',CHtml::listData(Route::model()->findAll(),'id','name'),array('empty'=>'','class'=>'span2','maxlength'=>100)); ?>
	<?php echo $form->dropDownListRow($rates,'class',CHtml::listData(CargoClass::model()->findAll(),'id','name'),array('empty'=>'','class'=>'span2','maxlength'=>100)); ?>
	<?php echo $form->textFieldRow($rates,'lane_meter_rate',array('class'=>'span2','maxlength'=>11)); ?>
	<?php echo $form->textFieldRow($rates,'proposed_tariff',array('class'=>'span2','maxlength'=>20)); ?>
	<?php echo $form->radioButtonListRow($rates,'active',array('Y'=>'Yes','N'=>'No')); ?>
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$rates->isNewRecord ? 'Add' : 'Save',
		)); ?>


<?php $this->endWidget(); ?>
</div>

<div class=clearfix></div>
<?php
$gridColumns = array(
           array(
             'name'=>'route',
             'value'=>'$data->route0->name',
           ),
           array(
             'name'=>'class',
             'value'=>'$data->class0->name',
           ),
           array(
             'name'=>'lane_meter_rate',
             'value'=>'$data->lane_meter_rate',
           ),
           array(
	    'name' => 'proposed_tariff',
            'class' => 'bootstrap.widgets.TbEditableColumn',
            'headerHtmlOptions' => array('style' => 'width:80px'),
            'editable' => array(
                'type' => 'text',
                'placement' => 'right',
            )),
            
);
  $this->widget('bootstrap.widgets.TbGridView', array(
	'type' => 'striped bordered',
	'dataProvider'=> $ratesTable->search(),
	'template' => "{items},{pager}",
        'htmlOptions'=>array('class'=>'span12'),
        'filter'=>$ratesTable,
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
