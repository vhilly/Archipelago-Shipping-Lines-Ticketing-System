  <?php if(isset($print)):?>
  <style>
    .table {
      margin-left:1.2cm;
    }
    table{
      vertical-align:top;
      font-size:12px;
    }
    .table2{
    }
    td{
      padding:1px;
      margin-left:-1cm;
    }
    .spacer {
      height:30px;
    }
  </style>
  <script>
    window.print();
   // window.close();
  </script>
  <?php endif;?>
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
   <div class="spacer"></div>
   <table class="table">
      <tr>
        <td colspan=3><?=$model->voyage0->name?></td>
      </tr>
      <tr>
        <td colspan=2><?=$model->voyage0->vessel0->name?></td>
        <td colspan=4><?=$model->voyage0->departure_date?> <?=$model->voyage0->departure_time?></td>
      </tr>
      <tr>
        <td width=120px><?=$b->cargo0->shipper ? $b->cargo0->shipper : 'N/A'?></td>
        <td width="140px">&nbsp;</td>
        <td width=120px><?=$b->cargo0->address ? $b->cargo0->address : 'N/A'?></td>
      </tr>
      <tr>
        <td width=120px><?=$model->voyage0->route0->from_port?></td>
        <td width="140px">&nbsp;</td>
        <td width=120px><?=$model->voyage0->route0->to_port?></td>
      </tr>
   </table>
   <br><br>
   <table class=table2>
      <tr>
        <td width=120px valign=top>&nbsp;</td>
        <td width=122px height="50px">
          <?=$b->cargo0->cargoClass->name?><br>
          <?=$b->cargo0->cargoClass->description?> meters<br>
          <?=$b->cargo0->plate_num?>
        </td>
        <td width=50px>1</td>
        <td width=50px></td>
        <td width=50px><?=$b->cargo0->weight?></td>
        <td width=50px><?=$b->rate0->lane_meter_rate?>1</td>
        <td width=50px><?=$b->rate0->proposed_tariff?></td>
      </tr>
   </table>
   <table>
     <tr>
       <td width="442px" height="135px">&nbsp;</td>
       <td width="50px" valign=bottom><?=$b->rate0->proposed_tariff?></td>
     </tr>
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
