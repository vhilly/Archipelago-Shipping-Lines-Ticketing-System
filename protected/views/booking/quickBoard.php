<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'searchForm',
    'type'=>'search',
    'method'=>'get',
    'htmlOptions'=>array('class'=>'well'),
  )); 
?>
<?php
  echo $form->textFieldRow($model, 'tkt_no',array('id'=>'tkt_no','class'=>'input-large', 'prepend'=>'<i class="icon-search"></i>'));
?>
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Go')); ?>
<?php $this->endWidget();?>

<script>
  $('#tkt_no').focus();
</script>
              
