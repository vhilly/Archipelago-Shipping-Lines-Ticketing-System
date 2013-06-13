<?php

    $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
      'title' => 'Fare Types',
      'headerIcon' => 'icon-th-list',
      'htmlOptions' => array('class'=>' span12')
    ));

?>

<div id=fareTypeClass class=span12>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'fareType-rate-form',
	'enableAjaxValidation'=>false,
	'type'=>'inline',
      'htmlOptions' => array('class'=>' well')
)); ?>


<?php echo $form->errorSummary($fareTypes); ?>
        <?php echo $form->textFieldRow($fareTypes,'name');?>
        <?php echo $form->textFieldRow($fareTypes,'proposed');?>
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$fareTypes->isNewRecord ? 'Add' : 'Save',
		)); ?>


<?php $this->endWidget(); ?>
</div>

<div class=clearfix></div>
<?php
$gridColumns = array(
            'name',
            'proposed',
);
  $this->widget('bootstrap.widgets.TbGridView', array(
	'type' => 'striped bordered',
	'dataProvider'=> $fareTypesTable->search(),
	'template' => "{items},{pager}",
        'htmlOptions'=>array('class'=>'span12'),
        'filter'=>$fareTypesTable,
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
