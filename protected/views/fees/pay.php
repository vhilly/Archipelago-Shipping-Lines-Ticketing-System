  <h3>
    <?=$fee->name?> : P<?=$fee->amt?>
  </h3>
  <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'fee',
	'htmlOptions'=>array('class'=>'span10'),
   )); ?>
   <?php echo $form->dropDownListRow($model, 'voyage',CHtml::listData(Voyage::model()->findAll(array('condition'=>'status != 3 ')),'id','name')); ?>
   <br>
   <?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'inverse','buttonType'=>'submit', 'label'=>'Record Payment','htmlOptions'=>array('name'=>'type','value'=>$type))); ?>
   <?php $this->endWidget()?>
