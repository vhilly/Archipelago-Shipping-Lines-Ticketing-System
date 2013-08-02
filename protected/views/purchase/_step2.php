<?php $passCount = 0;?>
      <?php
      $seatList = Seat::model()->findAll(array(
        'condition'=>'seating_class=:cl',
        'params'=>array(':cl'=>$purchase->class),
      ));
      ?>
<div>
  <fieldset>
    <h3>PASSENGER DETAILS</h3>
    <table class="table table-bordered">
      <?php foreach($passengers as $key=>$passenger):?>
        <?php $passCount++;?>
        <?php $alter = ($key%2) ? "alter" : ""; ?>
        <tr class="<?=$alter?>">
          <td rowspan=2 >
	    <b><?=$key+1?></b>
          </td>
  
            <?#php echo $form->datepickerRow($passenger, "[$key]birth_date",
             # array('prepend'=>'<i class="icon-calendar"></i>',
             #   'class'=>'reduce',
            #    'options'=>array('format'=>'yyyy-mm-dd'),
             # )
           # );?>
          <td>
            <?php echo $form->textFieldRow($passenger, "[$key]first_name", array('class'=>'span2')); ?>
          </td>
          <td>
            <?php echo $form->textFieldRow($passenger, "[$key]last_name", array('class'=>'span2')); ?>
          </td>
          <td>
            <?php echo $form->textFieldRow($passenger, "[$key]age", array('class'=>'span1')); ?>
          </td>
         <?php $display = $transaction_type->cargo=='Y' ? 'display:none' : '' ?>         
         <td style=<?=$display?>>
           <?php echo $form->dropDownListRow($fares[$key],"[$key]id",CHtml::listData($purchase->fares,'id','type0.name'),array('class'=>'reduce fare','empty'=>'')); ?>
         </td>
         <td style='display:none'>
           <?php echo $form->dropDownListRow($fares[$key],"[$key]id",CHtml::listData($purchase->fares,'id','price'),array('id'=>'PassageFareRates_'.$key.'_id2price','class'=>'span2 fare-2price','readonly'=>true,'empty'=>'')); ?>
         </td>
         <td style=<?=$display?>>
              <?php echo $form->textFieldRow($fares[$key],"[$key]price",array('class'=>'span1 price', 'id'=>'PassageFareRates_'.$key.'_id2pricetext','readonly'=>true,'empty'=>'')); ?>
         </td> 
         <td>
           <?php echo $form->labelEx($seats[$key],'id'); ?>
           <?php echo $form->textField($seats[$key],"[$key]name",array('class'=>'span1 seat smodal', 'id'=>'_'.$key.'_id','readonly'=>true)); ?>
         </td>
        <td>
          <?php echo $form->dropDownListRow($passenger, "[$key]civil_status",$passenger->getCSOptions(), array('class'=>'span2')); ?>
        </td>
      </tr>
      <tr class="<?=$alter?>">
          <td>
            <?php echo $form->textFieldRow($passenger, "[$key]middle_name", array('class'=>'span2')); ?>
          </td>
        <td>
          <?php echo $form->radioButtonListRow($passenger, "[$key]gender", array('M'=>'M','F'=>'F')); ?>
        </td>
        <td>
          <?php echo $form->textFieldRow($passenger, "[$key]address", array('class'=>'span2')); ?>
        </td>
        <td>
          <?php echo $form->textFieldRow($passenger, "[$key]contact", array('class'=>'span2')); ?>
        </td>
        <td>
          <?php echo $form->textFieldRow($passenger, "[$key]email", array('class'=>'span2')); ?>
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
                'Filipino','Chinese','American','Japanese'
              ),
              'items'=>4,
              'matcher'=>"js:function(item) {
                  return ~item.toLowerCase().indexOf(this.query.toLowerCase());
                }",
              ),'htmlOptions'=>array('class'=>'span2'),));
           ?>
         </td>
         <td style="display:none">
           <?php echo $form->dropDownListRow($seats[$key],"[$key]id",CHtml::listData($seatList,'id','name'),array('class'=>'span2','empty'=>'')); ?>
         </td>
         <td>
           <?php echo $form->textFieldRow($serials[$key],"[$key]tkt_serial",array('class'=>'span2')); ?>
         </td>
       </tr>
       <?php endforeach;?>
     </table>
  </fieldset>
</div>

<script>

  $('#Booking_0_tkt_serial').bind('change', function (Event){
    function strpad(i,l,s) {
      var o = i.toString();
      if(!s) { s = '0'; }
      while(o.length < l) {
        o = s + o;
      }
      return o;
    }
    var passCount = <?php echo $passCount;?>;
    var tikNum = this.value;
    //alert(tikNum.lenght);
      for(var i=1;i<passCount;i++){
        tikNum++;
        //strpad(tikNum,5,'0');
        $('#Booking_'+i+'_tkt_serial').val(strpad(tikNum,5,'0'));
      }
    });

</script>

