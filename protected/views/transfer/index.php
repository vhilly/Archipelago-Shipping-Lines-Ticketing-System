        
          SELECT VOYAGE:
        <?php  $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'voyage',
		'type'=>'inline',
	)); ?>
          <?php echo $form->dropDownListRow($voyage, 'id',CHtml::listData(Voyage::model()->findAll(),'id','name')); ?>
          <?php #$this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Make Seat Available', 'htmlOptions'=>array('onclick'=>'return confirm("Are you sure?");'))); ?>
          <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Transfer')); ?>
          <?php $this->endWidget(); ?>
