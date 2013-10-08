
<?php
  $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'verticalForm',
    'htmlOptions'=>array('class'=>'well-small'),
  ));
?>
<div>
  <fieldset>
    <?php echo $form->dropDownListRow($bk, 'voyage',CHtml::listData(Voyage::model()->findAll(array('condition'=>'status !=3','order'=>'id DESC')),'id','name')); ?>
    <?php $_SESSION['nonce'] = $nonce = md5('salt'.microtime()); ?>
    <input type="hidden" name="nonce" value="<?php echo $nonce; ?>" />
      <label>Freight Cost</label>
      <input type='text' readonly  id='cargo_cost' name='cargo_cost'/> 
      <?php echo $form->textFieldRow($cargo,'company',array('class'=>'span3','maxlength'=>100)); ?>
      <?php echo $form->textFieldRow($cargo,'plate_num',array('class'=>'span2','maxlength'=>100)); ?>
      <?php echo $form->dropDownListRow($cargo,'cargo_class',CHtml::listData(CargoClass::model()->findAll(),'id','description'),array('empty'=>'')); ?>
      <?php echo $form->textFieldRow($cargo,'shipper',array('class'=>'span2','maxlength'=>100)); ?>
      <?php echo $form->textFieldRow($cargo,'address',array('class'=>'span2','maxlength'=>255)); ?>
      <?php echo $form->textFieldRow($cargo,'article_no',array('class'=>'span2','maxlength'=>100)); ?>
      <?php echo $form->textAreaRow($cargo,'article_desc',array('class'=>'span2','maxlength'=>100)); ?>
      <?php echo $form->textFieldRow($cargo,'weight',array('class'=>'span2','maxlength'=>100)); ?>
      <?php echo $form->textFieldRow($cargo,'length',array('class'=>'span2','maxlength'=>100)); ?>
      <div class=hidden>
      <?php echo $form->textFieldRow($bk,'stowage',array('class'=>'span2 stmodal','maxlength'=>100,'readonly'=>true)); ?>
      </div>
  </fieldset>
</div>
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Go','htmlOptions'=>array('name'=>'Go'))); ?>
<?php $this->endWidget(); ?>
<?php
  Yii::app()->clientScript->registerScript('show', "
    $('#Cargo_cargo_class').change(function(){
      loadData($(this).val(),$('#BookingCargo_voyage').val());
    });
    $('#BookingCargo_voyage').change(function(){
      loadData($('#Cargo_cargo_class').val(),$(this).val());
    });
    loadData($('#Cargo_cargo_class').val(),$('#BookingCargo_voyage').val());
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
<?php if($tn):?>
<div id="transDetails" class=pull-left></div>
<script>
  $.ajax({
  type: 'GET',
    url: '<?php echo Yii::app()->baseUrl;?>?r=transaction/view&id='+'<?=$tn?>',
    success: function (data){
    $('#transDetails').html(data);
  },
  error: function (xht){
    alert(this.url);
  }

  });
</script>
<?php endif;?>
