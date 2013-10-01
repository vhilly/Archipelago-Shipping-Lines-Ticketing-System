
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'daily-cashflow-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php echo $form->dropDownListRow($model,'vessel',CHtml::listData(Vessel::model()->findAll(),'id','name'),array('class'=>'span3')); ?>
<?php echo $form->datePickerRow($model, 'date', array('append'=>'<i class="icon-calendar" style="cursor:pointer"></i>','class'=>'span2','options'=>array( 'format' => 'yyyy-mm-dd')));?>


<?php
  $fields=array();
  foreach($dfFields as $v){
    if($v->parent)
      $fields['child'][$v->parent][]=$v;
    else
      $fields['parent'][$v->id]=$v->name;
  }
?>
<table class=table>
   <?php foreach($fields['parent'] as $k=>$v):?>
     <?php if(!isset($fields['child'][$k])){continue;}?>
     <tr>
       <th><?=$v?></th>
     </tr>
     <?php foreach($fields['child'][$k] as $c):?>
      <tr>
        <td><?=$c->name?></td><td><input type=number name='values[<?=$c->id?>]' value=0></td>
      </tr>
     <?php endforeach;?>
     <tr><td>&nbsp;</td><tr>
   <?php endforeach;?>
</table>

<div class="form-actions">
  <?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Add' : 'Save',
  )); ?>
</div>


<?php $this->endWidget(); ?>
