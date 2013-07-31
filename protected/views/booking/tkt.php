
  <?php if(isset($print)):?>
  <script>
    window.print();
    window.close();
  </script>
  <?php endif;?>
  <style>
    div {
      font-size:10px;
    }
    .aright{
      text-align:right;
    }
  </style>
  <body>
  <?php if(!isset($print)):?>
  <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'searchForm',
	'type'=>'search',
	'method'=>'get',
	'htmlOptions'=>array('class'=>'span10'),
   )); ?>
   <?php
	echo $form->textFieldRow($model, 'tkt_serial',array('class'=>'input-medium span2','id'=>'tktno', 'prepend'=>'<i class="icon-search"></i>'));
	echo $form->textFieldRow($model, 'booking_no',array('class'=>'input-medium span2','id'=>'booking'));
	echo $form->textFieldRow($model, 'first_name',array('class'=>'input-medium span2','id'=>'fname'));
	echo $form->textFieldRow($model, 'last_name',array('class'=>'input-medium span2','id'=>'lname'));
	echo $form->dropDownListRow($model, 'voyage',CHtml::listData(Voyage::model()->findAll(),'id','name'),array('empty'=>''));
        echo "<input type=hidden name=print value=0>";
   ?>
   <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Go')); ?>
   <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Clear')); ?>
   <?php $this->endWidget()?>
   <?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'inverse','buttonType'=>'link','icon'=>'print','url'=>Yii::app()->createUrl('booking/tkt',array(
     'Booking[tkt_serial]'=>$model->tkt_serial,
     'Booking[booking_no]'=>$model->booking_no,
     'Booking[first_name]'=>$model->first_name,
     'Booking[last_name]'=>$model->last_name,
     'Booking[voyage]'=>$model->voyage,
     'print'=>1,
   )), 'label'=>'Print All','htmlOptions'=>array('target'=>'_blank','class'=>'span2' )))
   ?>
  <?php endif;?>
   <div style="clear:both"> </div><br>
   <?php foreach($model->printSearch()->getData() as $key=>$b):?>
   <?php if($key>0):?>
   <br><br>
   <?php endif;?>
   <?php $orig_price = PriceHistory::model()->findByAttributes(array('category'=>'1','category_id'=>"{$b->rate}"),"changed_at >= '{$b->date_booked}'");?>
   <?php $amt = isset($orig_price->price) ? $orig_price->price :$b->rate0->price?>
   <?php $NS = number_format($amt / 1.12,2)?>
   <?php $VAT = number_format($NS * 0.12 ,2)?>
   <?php
     $user = Yii::app()->user->getUserByName(Yii::app()->user->name);
     $createdBy = isset($user) ? $user->profile->firstname.' '.$user->profile->lastname:'';
   ?>
   <?php 
     $left_x = '';
     $left_x1 = '178px';
   ?>
   <table height=140px; width=980px;>
     <tr>
       <td>
   <div style="position:relative;height:150px;width:560px;">
   <div style="position:absolute;height:140px;width:280px;left:130px;top:15px">
     <div style="position:absolute;top:5px;"><?=$b->voyage0->vessel0->name?></div>
     <div style=position:absolute;top:5px;left:<?=$left_x1?>><?=$b->voyage0->name?></div>
     <div style=position:absolute;top:25px;left:<?=$left_x?>><?=$b->voyage0->departure_date.' '.date('H:i A',strtotime($b->voyage0->departure_time))?></div>
     <div style=position:absolute;top:25px;left:<?=$left_x1?>><?=isset($b->seat0->name) ? $b->seat0->name : 'NO SEAT ASSIGNED'?></div>
     <div style=position:absolute;top:50px;><?=$b->passenger0->first_name?> <?=$b->passenger0->last_name?></div>
     <div style=position:absolute;top:70px;><?=$b->passenger0->contact?></div>
     <div style=position:absolute;top:95px;left:<?=$left_x?>>Net Sales &nbsp;<?=$NS?></div>
     <div style=position:absolute;top:95px;left:<?=$left_x1?>>VAT (12%) &nbsp;<?=$VAT?></div>
     <div style=position:absolute;top:113px;left:<?=$left_x?>>Discount:0.00</div>
     <div style=position:absolute;top:133px;left:<?=$left_x?>><b><?=$amt?></b></div>
     <div style=position:absolute;top:50px;left:115px><img src='<?=Yii::app()->createUrl('barcodeGenerator/generateBarcode',array('code'=>$b->tkt_serial))?>'></div>
     <div style=position:absolute;top:128px;left:<?=$left_x1?>><b><?=$createdBy?></b></div>
   </div>
   <div style="position:absolute;height:140px;width:280px;left:455px;top:15px">
     <div style="position:absolute;top:5px;"><?=$b->voyage0->vessel0->name?></div>
     <div style=position:absolute;top:5px;left:<?=$left_x1?>><?=$b->voyage0->name?></div>
     <div style=position:absolute;top:25px;left:<?=$left_x?>><?=$b->voyage0->departure_date.' '.date('H:i A',strtotime($b->voyage0->departure_time))?></div>
     <div style=position:absolute;top:25px;left:<?=$left_x1?>><?=isset($b->seat0->name) ? $b->seat0->name : 'NO SEAT ASSIGNED'?></div>
     <div style=position:absolute;top:50px;><?=$b->passenger0->first_name?> <?=$b->passenger0->last_name?></div>
     <div style=position:absolute;top:70px;><?=$b->passenger0->contact?></div>
     <div style=position:absolute;top:95px;left:<?=$left_x?>>Net Sales &nbsp;<?=$NS?></div>
     <div style=position:absolute;top:95px;left:<?=$left_x1?>>VAT (12%) &nbsp;<?=$VAT?></div>
     <div style=position:absolute;top:113px;left:<?=$left_x?>>Discount:0.00</div>
     <div style=position:absolute;top:133px;left:<?=$left_x?>><b><?=$amt?></b></div>
     <div style=position:absolute;top:50px;left:115px><img src='<?=Yii::app()->createUrl('barcodeGenerator/generateBarcode',array('code'=>$b->tkt_serial))?>'></div>
     <div style=position:absolute;top:128px;left:<?=$left_x1?>><b><?=$createdBy?></b></div>
   <div>

       </td>
     </tr>
   </table>
    <?php if(!isset($print)):?>
    <?php
    $this->widget('bootstrap.widgets.TbButton', array('type'=>'info','icon'=>'print', 
      'label'=>'Print','htmlOptions'=>array('target'=>'_blank','class'=>'ticket_print_box' ,'onclick'=>'window.open("'.Yii::app()->createUrl('booking/tkt',array(
        'Booking[tkt_serial]'=>$b->tkt_serial,
        'Booking[voyage]'=>$b->voyage,
        'print'=>1)).'");')));
    ?>
    <?php endif;?>
  <?php endforeach; ?>
  </body>
