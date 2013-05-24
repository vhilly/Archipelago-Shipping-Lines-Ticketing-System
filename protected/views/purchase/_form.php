<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'verticalForm',
    'htmlOptions'=>array('class'=>'well'),
)); ?>
 
  <?php echo $form->errorSummary($purchase); ?>
  <?php echo $form->hiddenField($purchase, 'hash'); ?>
  <?php echo $form->hiddenField($purchase, 'step'); ?>
  <?php echo $form->hiddenField($purchase, 'departureDate'); ?>




  <div style="<?=$purchase->step==1? '':'display:none'?>">
  <?php echo $form->dropDownListRow($purchase, 'voyage',CHtml::listData(Voyage::model()->findAll(),'id','name')); ?>
  <?php echo $form->labelEx($purchase, 'departureDate'); ?>
  <?php
    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'name'=>'departureDate',
                            'model'=>$purchase,
                            'attribute'=>'departureDate',
                            'value'=>$purchase->departureDate,
                            // additional javascript options for the date picker plugin
                            'options'=>array(
                                'showAnim'=>'fold',
                                'dateFormat'=>'yy-mm-dd'
                            ),
                            'htmlOptions'=>array(
                                'style'=>'height:20px;',
                            ),
                        ));
   ?>





  <?php echo $form->dropDownListRow($purchase, 'class',CHtml::listData(SeatingClass::model()->findAll(),'id','name')); ?>
  <?php echo $form->textFieldRow($purchase, 'passengerTotal', array('class'=>'span1')); ?>
  <br>
  </div>


  <div style="<?=$purchase->step==2? '':'display:none'?>">
    <?php if(count($passengers) && count($fares)):?>
      <table>
      <?php foreach($passengers as $key=>$passenger):?>
        <tr>
          <td>
            <?php echo $form->textFieldRow($passenger, "[$key]first_name", array('class'=>'span2')); ?>
          </td>
          <td>
            <?php echo $form->textFieldRow($passenger, "[$key]last_name", array('class'=>'span2')); ?>
          </td>
          <td>
            <?php echo $form->textFieldRow($passenger, "[$key]middle_name", array('class'=>'span2')); ?>
          </td>
          <td>
            <?php echo $form->textFieldRow($passenger, "[$key]prefix", array('class'=>'span1')); ?>
          </td>
          <td>
            <?php echo $form->radioButtonListRow($passenger, "[$key]gender", array('M'=>'M','F'=>'F')); ?>
          </td>
          <td>
            <?php echo $form->textFieldRow($passenger, "[$key]nationality", array('class'=>'span2')); ?>
          </td>
          <td>
            <?php echo $form->textFieldRow($passenger, "[$key]address", array('class'=>'span2')); ?>
          </td>
          <td>
            <?php echo $form->dropDownListRow($tickets[$key],"[$key]price",CHtml::listData($fares,'price','type'),array('class'=>'span2')); ?>
          </td>
        </tr>
      <?php endforeach;?>
      </table>
    <?php endif;?>
  </div>

  <div style="<?=$purchase->step==3? '':'display:none'?>">
    <input type=text name=forTransact value='<?=$JSONforTransact?>'>
  </div>
  
  <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Next')); ?>
 
<?php $this->endWidget(); ?>
