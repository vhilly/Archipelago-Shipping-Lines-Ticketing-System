<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
  'id'=>'searchForm',
  'type'=>'search',
  'htmlOptions'=>array('class'=>'well'),
)); ?>
ENTER TICKET NO.<br>
<?php
  echo $form->textFieldRow($model, 'tkt_no',
  array('class'=>'input-medium', 'prepend'=>'<i class="icon-search"></i>','id'=>'tkt_no'));
?>
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Go')); ?>

<?php if($passenger):?>
  <div class=clearfix></div>
   <br>
   <?php
      $this->widget('bootstrap.widgets.TbEditableDetailView', array(
        'id' => 'region-details',
        'data' => $passenger,
        'url' => $this->createUrl('passenger/editableSaver'), //common submit url for all editables
        'attributes'=>array(
        'first_name',
        'last_name',
        'gender',
        'address',
        'contact',
        'birth_date',
        'email',
      )
    ));
   ?>
   <?php 
     if($error)
        $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit','type'=>'inverse','htmlOptions'=>array('name'=>'validate'), 'label'=>'Validate')); 
     else
        $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit','type'=>'success', 'htmlOptions'=>array('name'=>'check'), 'label'=>'Check In')); 
       
   ?>
<?php endif;?>

<?php $this->endWidget(); ?>
