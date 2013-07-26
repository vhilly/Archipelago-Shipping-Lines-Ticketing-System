
<?php if($model->status!=3):?>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'voyage-form',
	'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->dropDownListRow($model,'status',CHtml::listData(VoyageStatus::model()->findAll(array('condition'=>"id > {$model->status}")),'id','name'),array('class'=>'span5')); ?>
<?php $warn = $model->status == 1 ? "This will free up reserved seats.": "This will free up reserved seats and close the voyage."?>
<div class="form-actions">
  <?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'primary','buttonType'=>'submit', 'label'=>'Save','htmlOptions'=>array('onclick'=>'return confirm("Are you sure? '.$warn.'");'))); ?>
  <?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'danger','buttonType'=>'link','icon'=>'','url'=>Yii::app()->createUrl('voyage/index'),'label'=>'Cancel'));?>

</div>

<?php $this->endWidget(); ?>
<?php else:?>
<h4>Voyage is already closed!</h4>
  <?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'danger','buttonType'=>'link','icon'=>'','url'=>Yii::app()->createUrl('voyage/index'),'label'=>'Cancel'));?>
<?php endif;?>
