<?php
    $clss= CHtml::listData(SeatingClass::model()->findAll(),'id','name');
    $rt= CHtml::listData(Route::model()->findAll(),'id','name');
    $tp= CHtml::listData(PassageFareTypes::model()->findAll(),'id','name');
    $yesNo = array('Y'=>'Yes','N'=>'No');
    $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
      'title' => 'Ticket Fare Rates',
      'headerIcon' => 'icon-th-list',
      'htmlOptions' => array('class'=>' span12')
    ));

?>

<div id=fareClass class=span12>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'fare-rate-form',
	'enableAjaxValidation'=>false,
	'type'=>'inline',
      'htmlOptions' => array('class'=>' well')
)); ?>


<?php echo $form->errorSummary($fare); ?>
	<?php echo $form->dropDownListRow($fare,'class',$clss,array('empty'=>'','class'=>'span2','maxlength'=>100)); ?>
	<?php echo $form->dropDownListRow($fare,'type',$tp,array('empty'=>'','class'=>'span2','maxlength'=>100)); ?>
	<?php echo $form->dropDownListRow($fare,'route',$rt,array('empty'=>'','class'=>'span2','maxlength'=>100)); ?>
        <?php echo $form->textFieldRow($fare,'price',array('class'=>'span1'));?>
	<?php echo $form->radioButtonListRow($fare,'active',$yesNo); ?>
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$fare->isNewRecord ? 'Add' : 'Save',
		)); ?>


<?php $this->endWidget(); ?>
</div>

<div class=clearfix></div>
<?php
$gridColumns = array(
            array('name'=>'class','filter'=>$clss,'value'=>'$data->class0->name'),
            array('name'=>'type','filter'=>$tp,'value'=>'$data->type0->name'),
            array('name'=>'route','filter'=>$rt,'value'=>'$data->route0->name'),
            array('name'=>'price'),
            array('name'=>'active','filter'=>$yesNo,'value'=>'$data->active=="Y" ? "Yes" : "No"'),
);
  $this->widget('bootstrap.widgets.TbGridView', array(
	'type' => 'striped bordered',
	'dataProvider'=> $faresTable->search(),
	'template' => "{items},{pager}",
        'htmlOptions'=>array('class'=>'span12'),
        'filter'=>$faresTable,
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
