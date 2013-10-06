<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'VOYAGE LIST',
    'headerIcon' => 'icon-th-list',
    'htmlOptions' => array('class'=>'bootstrap-widget-table '.$hidden.' midBox well-small pull-right')
  ));
?>


<?php $this->renderPartial('voyageList'); ?>
<?php $this->endWidget();?>
<div>
  <fieldset>
    <?php echo $form->dropDownListRow($purchase, 'voyage',CHtml::listData(Voyage::model()->findAll(array('condition'=>'status !=3','order'=>'id DESC')),'id','name')); ?>

    <div class="<?= $transaction_type->cargo =='Y' ?  'hidden':'' ?> ">
      <?php echo $form->dropDownListRow($purchase, 'class',CHtml::listData(SeatingClass::model()->findAll(array('condition'=>'active="Y"')),'id','name')); ?>
      <?php echo $form->textFieldRow($purchase, 'passenger_total', array('class'=>'span1'));?>

    </div>

    <div class="<?= $transaction_type->cargo !='Y' ?  'hidden':'' ?> ">
      <label>Freight Cost</label>
      <input type='text' readonly  id='cargo_cost' name='cargo_cost'/> 
      <?php if($transaction_type->account_to =='Y') :?>
        <?php echo $form->dropDownListRow($purchase,'account_to',CHtml::listData(Customer::model()->findAll(),'id','company' ),array('empty'=>''),array('class'=>'span2','maxlength'=>100)); ?>
        <?php echo $form->hiddenField($cargo,'company',array('class'=>'span2','maxlength'=>100,'readonly'=>true)); ?>
        <?php echo $form->textFieldRow($cargo,'plate_num',array('class'=>'span2','maxlength'=>100,'readonly'=>true)); ?>
        <div class=hidden>
        <?php echo $form->dropDownListRow($cargo,'cargo_class',CHtml::listData(CargoClass::model()->findAll(),'id','name'),array('empty'=>'','readonly'=>true)); ?>
        </div>
        <?php echo $form->textFieldRow($cargo,'shipper',array('class'=>'span2','maxlength'=>100,'readonly'=>true)); ?>
        <?php #echo $form->textFieldRow($cargo,'destination',array('class'=>'span3','maxlength'=>100)); ?>
        <?php echo $form->textFieldRow($cargo,'address',array('class'=>'span2','maxlength'=>255,'readonly'=>true)); ?>
      <?php else:?>
        <?php echo $form->textFieldRow($cargo,'company',array('class'=>'span2','maxlength'=>100)); ?>
        <?php echo $form->textFieldRow($cargo,'plate_num',array('class'=>'span2','maxlength'=>100)); ?>
        <?php echo $form->dropDownListRow($cargo,'cargo_class',CHtml::listData(CargoClass::model()->findAll(),'id','description'),array('empty'=>'')); ?>
        <?php echo $form->textFieldRow($cargo,'shipper',array('class'=>'span2','maxlength'=>100)); ?>
        <?php #echo $form->textFieldRow($cargo,'destination',array('class'=>'span3','maxlength'=>100)); ?>
        <?php echo $form->textFieldRow($cargo,'address',array('class'=>'span2','maxlength'=>255)); ?>
      <?php endif;?>
      <?php echo $form->textFieldRow($cargo,'article_no',array('class'=>'span2','maxlength'=>100)); ?>
      <?php echo $form->textAreaRow($cargo,'article_desc',array('class'=>'span2','maxlength'=>100)); ?>
      <?php echo $form->textFieldRow($cargo,'weight',array('class'=>'span2','maxlength'=>100)); ?>
      <?php echo $form->textFieldRow($cargo,'length',array('class'=>'span2','maxlength'=>100)); ?>
      <div class=hidden>
      <?php echo $form->textFieldRow($stowage,'id',array('class'=>'span2 stmodal','maxlength'=>100,'readonly'=>true)); ?>
      </div>
    </div>
  </fieldset>
</div>


<?php
  Yii::app()->clientScript->registerScript('show', "
    $('#Cargo_cargo_class').change(function(){
      loadData($(this).val(),$('#Purchase_voyage').val());
    });
    $('#Purchase_voyage').change(function(){
      loadData($('#Cargo_cargo_class').val(),$(this).val());
    });
    loadData($('#Cargo_cargo_class').val(),$('#Purchase_voyage').val());
    function loadData(class_id,voyage_id){
      $.ajax({
        type: 'POST',
        url: '".$this->createUrl('purchase/getCargoRate')."&id='+class_id+'&voyage='+voyage_id,
        success:
          function (data){
            $('#cargo_cost').val(data);
          },
        error:
          function (data){
          }
    });
    
    }
");
?>
