

<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'verticalForm',
     'type'=>'vertical',
)); ?>


 
  <?php echo $form->errorSummary($purchase); ?>
  <?php echo $form->errorSummary($cargo); ?>
  <?php echo $form->hiddenField($purchase, 'step'); ?>
  <?php echo $form->hiddenField($purchase, 'hash'); ?>
  <?php echo $form->hiddenField($purchase, 'ticketList'); ?>
  <?php echo $form->hiddenField($purchase, 'passengerList'); ?>
  <?php echo $form->textField($purchase, 'cargoList'); ?>



  <div style="<?=$purchase->step==1? '':'display:none'?>">
    <fieldset>
      <legend>STEP</legend>
      <?php echo $form->dropDownListRow($purchase, 'voyage',CHtml::listData(Voyage::model()->findAll(),'id','name')); ?>
      <?php echo $form->datepickerRow($purchase, 'departureDate',
        array(
          'prepend'=>'<i class="icon-calendar"></i>',
          'options'=>array( 'format' => 'yyyy-mm-dd')
        )); 
      ?>

      <?php echo $form->dropDownListRow($purchase, 'class',CHtml::listData(SeatingClass::model()->findAll(),'id','name')); ?>
      <?php 
        if($purchase->passenger)
        echo $form->textFieldRow($purchase, 'passengerTotal', array('class'=>'span1'));
       ?>
    </fieldset>
  </div>


  <div style="<?=$purchase->step==2? '':'display:none'?>">
    <fieldset>
      <legend>STEP 2</legend>
      <?php if($purchase->passenger):?>
        <h3>PASSENGER DETAILS</h3>
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
            <?php echo $form->labelEx($passenger, 'nationality', array('M'=>'M','F'=>'F')); ?>
            <?php
              $this->widget('bootstrap.widgets.TbTypeahead', array(
                'model'=>$passenger,
                'attribute'=>"[$key]nationality",
                'options'=>array(
	          'name'=>"[$key]nationality",
	        'source'=>array(
		  'Filipino','Chinese','American'
                ),
	        'items'=>4,
	        'matcher'=>"js:function(item) {
                  return ~item.toLowerCase().indexOf(this.query.toLowerCase());
               }",
              )));
            ?>
            </td>
            <td>
              <?php echo $form->textFieldRow($passenger, "[$key]address", array('class'=>'span2')); ?>
            </td>
            <td>
              <?php echo $form->dropDownListRow($tickets[$key],"[$key]rate",CHtml::listData($fares,'id','type'),array('class'=>'span2')); ?>
            </td>
          </tr>
          <?php endforeach;?>
        </table>
      <?php endif;?>
      <?php if($purchase->cargo):?>

        <h3>CARGO DETAILS</h3>
	<?php echo $form->textFieldRow($cargo,'shipper',array('class'=>'span3','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($cargo,'company',array('class'=>'span3','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($cargo,'destination',array('class'=>'span3','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($cargo,'address',array('class'=>'span3','maxlength'=>255)); ?>

        <?php echo $form->dropDownListRow($cargo,'cargo_class',CHtml::listData(CargoClass::model()->findAll(),'id','class'),array('class'=>'span2')); ?>

	<?php echo $form->textFieldRow($cargo,'arcticle_no',array('class'=>'span2','maxlength'=>100)); ?>
	<?php echo $form->textAreaRow($cargo,'article_desc',array('class'=>'span3','maxlength'=>100)); ?>
	<?php echo $form->textFieldRow($cargo,'weight',array('class'=>'span2','maxlength'=>100)); ?>
	<?php echo $form->textFieldRow($cargo,'length',array('class'=>'span2','maxlength'=>100)); ?>

      <?php endif;?>
    </fieldset>
  </div>

  <div style="<?=$purchase->step==3? '':'display:none'?>">
    <fieldset>
      <legend>STEP 3</legend>
    </fieldset>
  </div>
 
    <div class="form-actions"> 
  <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Next')); ?>
 </div>
<?php $this->endWidget(); ?>
