<?php
    $yesNo = array('Y'=>'Yes','N'=>'No');
    $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
      'title' => 'Transaction Type',
      'headerIcon' => 'icon-th-list',
      'htmlOptions' => array('class'=>'seat_avail')
    ));

?>
<div id=transTypeClass>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'transType-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
)); ?>


        <?php echo $form->errorSummary($transType); ?>
	<?php echo $form->textFieldRow($transType,'name',array('class'=>'Transac_name','maxlength'=>100)); ?>
	<?php echo $form->textFieldRow($transType,'navigation_title',array('class'=>'Transac_name','maxlength'=>100)); ?>
	<?php echo $form->radioButtonListRow($transType,'passenger',$yesNo,array('class'=>'span2','maxlength'=>4)); ?>
	<?php echo $form->radioButtonListRow($transType,'cargo',$yesNo,array('class'=>'span2','maxlength'=>4)); ?>
	<?php echo $form->textFieldRow($transType,'discount',array('class'=>'span3','maxlength'=>100)); ?>
	<?php echo $form->textFieldRow($transType,'discount_percent',array('class'=>'span3','maxlength'=>100)); ?>
	<?php echo $form->textFieldRow($transType,'free_passenger',array('class'=>'span3','maxlength'=>100)); ?>
	<?php echo $form->textFieldRow($transType,'minimum_passenger',array('class'=>'span3','maxlength'=>100)); ?>
	<?php echo $form->textFieldRow($transType,'maximum_passenger',array('class'=>'span3','maxlength'=>100)); ?>
	<?php echo $form->hiddenField($transType,'free_cargo',array('class'=>'span3','maxlength'=>100)); ?>
	<?php echo $form->hiddenField($transType,'minimum_cargo',array('class'=>'span3','maxlength'=>100)); ?>
	<?php echo $form->radioButtonListRow($transType,'active',$yesNo,array('class'=>'span2','maxlength'=>4)); ?>

	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$transType->isNewRecord ? 'Create' : 'Save',
		)); ?>

<?php $this->endWidget(); ?>
</div>

<div class=clearfix></div>
<?php
$gridColumns = array(
       'name',
       'navigation_title',
       array('name'=>'passenger','filter'=>$yesNo,'value'=>'$data->passenger =="Y" ? "Yes":"No"'),
       array('name'=>'cargo','filter'=>$yesNo,'value'=>'$data->cargo =="Y" ? "Yes":"No"'),
       'discount',
       'discount_percent',
       'free_passenger',
       'minimum_passenger',
       'maximum_passenger',
       array('name'=>'active','filter'=>$yesNo,'value'=>'$data->passenger =="Y" ? "Yes":"No"'),
            
);
  $this->widget('bootstrap.widgets.TbGridView', array(
	'type' => 'striped bordered',
	'dataProvider'=> $transTypesTable->search(),
	'template' => "{items},{pager}",
        'htmlOptions'=>array('class'=>''),
        'filter'=>$transTypesTable,
        'columns'=>$gridColumns
));
?>

<?php $this->endWidget(); ?>

