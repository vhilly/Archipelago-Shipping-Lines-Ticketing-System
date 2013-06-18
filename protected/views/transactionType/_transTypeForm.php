<?php
    $yesNo = array('Y'=>'Yes','N'=>'No');
    $br = CHtml::listData(PassageFareTypes::model()->findAll(),'id','name');
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
	<?php echo $form->textFieldRow($transType,'bundled_passenger',array('class'=>'span3','maxlength'=>100)); ?>
	<?php echo $form->radioButtonListRow($transType,'bundled_passenger_rate',$br,array('class'=>'span2','maxlength'=>4)); ?>
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
       array(
         'class' => 'bootstrap.widgets.TbEditableColumn',
         'name' =>'name',
         'editable' => array(
           'type'      => 'text',
           'url' => $this->createUrl('transactionType/editableSaver'),
           'placement' => 'right',
           'inputclass' => 'span2'
        ),
       ),
       array(
         'class' => 'bootstrap.widgets.TbEditableColumn',
         'name' =>'navigation_title',
         'editable' => array(
           'type'      => 'text',
           'url' => $this->createUrl('transactionType/editableSaver'),
           'attribute' => 'dropDown',
           'placement' => 'right',
           'inputclass' => 'span2'
        ),
       ),
       array(
         'class' => 'bootstrap.widgets.TbEditableColumn',
         'name' =>'passenger',
         'filter' =>$yesNo,
         'editable' => array(
           'type'      => 'select',
           'url' => $this->createUrl('transactionType/editableSaver'),
           'attribute' => 'dropDown',
           'placement' => 'right',
           'inputclass' => 'span2',
           'source' =>$yesNo,
        ),
       ),
       array(
         'class' => 'bootstrap.widgets.TbEditableColumn',
         'name' =>'cargo',
         'filter' =>$yesNo,
         'editable' => array(
           'type'      => 'select',
           'url' => $this->createUrl('transactionType/editableSaver'),
           'attribute' => 'dropDown',
           'placement' => 'right',
           'inputclass' => 'span2',
           'source' =>$yesNo,
        ),
       ),
       array(
         'class' => 'bootstrap.widgets.TbEditableColumn',
         'name' =>'discount',
         'editable' => array(
           'type'      => 'text',
           'url' => $this->createUrl('transactionType/editableSaver'),
           'placement' => 'right',
           'inputclass' => 'span2',
        ),
       ),
       array(
         'class' => 'bootstrap.widgets.TbEditableColumn',
         'name' =>'minimum_passenger',
         'editable' => array(
           'type'      => 'text',
           'url' => $this->createUrl('transactionType/editableSaver'),
           'placement' => 'right',
           'inputclass' => 'span2',
        ),
       ),
       array(
         'class' => 'bootstrap.widgets.TbEditableColumn',
         'name' =>'maximum_passenger',
         'editable' => array(
           'type'      => 'text',
           'url' => $this->createUrl('transactionType/editableSaver'),
           'placement' => 'right',
           'inputclass' => 'span2',
        ),
       ),
       array(
         'class' => 'bootstrap.widgets.TbEditableColumn',
         'name' =>'bundled_passenger',
         'editable' => array(
           'type'      => 'text',
           'url' => $this->createUrl('transactionType/editableSaver'),
           'placement' => 'right',
           'inputclass' => 'span2',
        ),
       ),
       array(
         'class' => 'bootstrap.widgets.TbEditableColumn',
         'name' =>'bundled_passenger_rate',
         'filter' =>$br,
         'editable' => array(
           'type'      => 'select',
           'url' => $this->createUrl('transactionType/editableSaver'),
           'attribute' => 'dropDown',
           'placement' => 'right',
           'inputclass' => 'span2',
           'source' =>$br,
        ),
       ),
       array(
         'class' => 'bootstrap.widgets.TbEditableColumn',
         'name' =>'active',
         'filter' =>$yesNo,
         'editable' => array(
           'type'      => 'select',
           'url' => $this->createUrl('transactionType/editableSaver'),
           'attribute' => 'dropDown',
           'placement' => 'right',
           'inputclass' => 'span2',
           'source' =>$yesNo,
        ),
       ),
            
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

