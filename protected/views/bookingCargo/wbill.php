
  <?php if(!isset($print)):?>
  <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'searchForm',
	'type'=>'search',
	'method'=>'get',
	'htmlOptions'=>array('class'=>'span10'),
   )); ?>
   <?php
	echo $form->textFieldRow($model, 'lading_no',array('class'=>'input-medium span2','id'=>'tktno', 'prepend'=>'<i class="icon-search"></i>'));
	echo $form->textFieldRow($model, 'booking_no',array('class'=>'input-medium span2','id'=>'booking'));
	echo $form->textFieldRow($model, 'shipper',array('class'=>'input-medium span2','id'=>'fname'));
	echo $form->textFieldRow($model, 'company',array('class'=>'input-medium span2','id'=>'lname'));
	echo $form->dropDownListRow($model, 'voyage',CHtml::listData(Voyage::model()->findAll(),'id','name'),array('empty'=>''));
        echo "<input type=hidden name=print value=0>";
   ?>
   <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Go')); ?>
   <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Clear')); ?>
   <?php $this->endWidget()?>
   <?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'inverse','buttonType'=>'link','icon'=>'print','url'=>Yii::app()->createUrl('bookingCargo/wBill',array(
     'BookingCargo[lading_no]'=>$model->lading_no,
     'BookingCargo[booking_no]'=>$model->booking_no,
     'BookingCargo[shipper]'=>$model->shipper,
     'BookingCargo[company]'=>$model->company,
     'BookingCargo[voyage]'=>$model->voyage,
     'print'=>1,
   )), 'label'=>'Print All','htmlOptions'=>array('target'=>'_blank','class'=>'span2' )))
   ?>
  <?php endif;?>
   <div style="clear:both"> </div><br>
   <?php foreach($model->search()->getData() as $b):?>
   <?php $orig_price = PriceHistory::model()->findByAttributes(array('category'=>'2','category_id'=>"{$b->rate}"),"changed_at >= '{$b->date_booked}'"); ?>
    <table class="table">
      <tr class="odd">
        <td colspan=4>BILL OF LADING NO : <?=$b->lading_no?></td>
        <td colspan=4>BOOKING NO : <?=$b->booking_no?></td>
      </tr>
      <tr class="even">
        <td colspan=4>Shipper/Consignee : <?=$b->cargo0->shipper?></td>
        <td colspan=4>Carrier/Vessel/Ferry Name : <?=$b->voyage0->vessel0->name?></td>
      </tr>
      <tr>
        <td rowspan=2 colspan=4>Address : <?=$b->cargo0->address?></td>
        <td colspan=4>Port of Loading : <?=$b->voyage0->route0->from?></td>
      </tr>
      <tr>
        <td>Port of Discharge: <?=$b->voyage0->route0->to?></td>
      </tr>
    </table>
   <table class="table">
      <tr>
        <td>Class :</td>
        <td>No. Article :</td>
        <td>Article Description:</td>
        <td>Weight :</td>
        <td>Measurement :</td>
        <td>Rate :</td>
        <td>Freight Charges :</td>
        <td>Total : </td>
      </tr>
      <tr>
        <td><?=$b->cargo0->cargoClass->name?> </td>
        <td><?=$b->cargo0->article_no?> </td>
        <td><?=$b->cargo0->article_desc?> </td>
        <td><?=$b->cargo0->weight?> </td>
        <td><?=$b->cargo0->length?> </td>
        <td><?=$b->rate0->lane_meter_rate?> </td>
        <td><?=isset($orig_price->price) ? $orig_price->price : $b->rate0->proposed_tariff ?> </td>
      </tr>
   </table>

   </table>
    <?php if(!isset($print)):?>
    <?php
    $this->widget('bootstrap.widgets.TbButton', array('type'=>'info','buttonType'=>'link','icon'=>'print','url'=>Yii::app()->createUrl('bookingCargo/wBill',array(
     'BookingCargo[lading_no]'=>$b->lading_no,
     'BookingCargo[voyage]'=>$b->voyage,
     'print'=>1,
    )), 'label'=>'Print','htmlOptions'=>array('target'=>'_blank','class'=>'ticket_print_box' )));
    ?>
    <br><br>
    <?php endif;?>
  <?php endforeach; ?>
