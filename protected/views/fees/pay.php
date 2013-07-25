  <h3>
    <?=$fee->name?> : P<?=$fee->amt?>
  </h3>
  <?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'inverse','buttonType'=>'link','icon'=>'','url'=>Yii::app()->createUrl('fees/pay',array(
     'type'=>$type,
     'record'=>true,
   )), 'label'=>'Record Payment'))
  ?>
