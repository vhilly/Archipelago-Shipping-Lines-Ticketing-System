
    <?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => '',
    'headerIcon' => 'icon-th-list',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
    'htmlOptions' => array('class'=>'bootstrap-widget-table')
    ));?>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
  'id'=>'booking-transfer-form',
  'enableAjaxValidation'=>false,
)); ?>
  <?php echo $form->hiddenField($model,'transaction') ?>
  <?php echo $form->hiddenField($model,'booking_no') ?>
  <?php echo $form->hiddenField($model,'tkt_no') ?>
  <?php echo $form->hiddenField($model,'passenger') ?>
  <?php echo $form->textFieldRow($model,'seat') ?>
  <?php echo $form->hiddenField($model,'status') ?>
  <?php echo $form->hiddenField($model,'date_booked') ?>
  <?php echo $form->hiddenField($model,'rate') ?>
<table>
  <tr>
    <th>SELECT VOYAGE</th>
    <td><?php echo $form->dropDownListRow($model,'voyage',CHtml::listData(Voyage::model()->findAll(array('condition'=>'departure_date BETWEEN CURDATE() AND CURDATE() + INTERVAL 1 DAY AND id !=:id','params'=>array(':id'=>$model->voyage))),'id','name'))?></td>
  </tr>
</table>
  <div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
      'buttonType'=>'submit',
      'type'=>'primary',
      'label'=>'Transfer'
    )); ?>
  </div>
<?php $this->endWidget(); ?>
<?php $this->endWidget(); ?>
