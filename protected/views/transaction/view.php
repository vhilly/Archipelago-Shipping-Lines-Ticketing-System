<?php

 $user = Yii::app()->user->getUserByName($trans->created_by);
 $createdBy = isset($user) ? $user->profile->firstname.' '.$user->profile->lastname:'';
  
?>
    <table width=1000 border=1>
      <thead>
        <tr bgcolor=#F68938>
         <th colspan=11><center>TRANSACTION DETAILS</center></th>
        </tr>
        <tr>
         <th>TRANSACTION NO.</th>
         <th>INPUT DATE</th>
         <th>TRANSACTION DATE</th>
         <th>PAYMENT METHOD</th>
         <th>PAYMENT STATUS</th>
         <th>OVERALL AMOUNT</th>
         <th>DISCOUNT</th>
         <th>TOTAL AMOUNT</th>
         <th>REFERENCE</th>
         <th>ACCOUNT TO</th>
         <th>CREATED BY</th>
        </tr>
      </thead>
      <tbody>
        <tr class="odd">
         <td><?=$this->getTn($trans->id)?></td>
         <td><?=$trans->trans_date?></td>
         <td><?=$trans->input_date?></td>
         <td><?=$trans->paymentMethod->name?></td>
         <td><?=$trans->paymentStatus->name?></td>
         <td><?=$trans->ovamount?></td>
         <td><?=$trans->ovdiscount?></td>
         <td><?=$trans->ovamount - $trans->ovdiscount?></td>
         <td><?=$trans->reference?></td>
         <td><?=isset($trans->accountTo->company) ? $trans->accountTo->company:'' ?></td>
         <td><?=$createdBy?></td>
        </tr>
      </tbody>
  </table>
  <?php
    if(count($Tickets)):
  ?>
  <br>
  <table width=1000 border=1>
      <thead>
        <tr bgcolor=#F68938>
         <th colspan=8><center>TICKETS PURCHASED</center></th>
        </tr>
        <tr>
         <th>BOOKING NO.</th>
         <th>TICKET NO.</th>
         <th>FIRST NAME</th>
         <th>LAST NAME</th>
         <th>CLASS</th>
         <th>RATE</th>
         <th>AMOUNT</th>
        </tr>
      </thead>
      <tbody>
	 <?php foreach($Tickets as $ticket):?>
           <tr class="odd">
            <td><?=$ticket['booking_no']?></td>
            <td><?=$ticket['tkt_no']?></td>
            <td><?=$ticket['first_name']?></td>
            <td><?=$ticket['last_name']?></td>
            <td><?=$ticket['class']?></td>
            <td><?=$ticket['type']?></td>
            <td><?=$ticket['orig_price'] ? $ticket['orig_price'] : $ticket['price']?></td>
            <td>
            <?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'inverse','buttonType'=>'link','icon'=>'print','url'=>Yii::app()->createUrl('booking/tkt',array(
              'Booking[tkt_no]'=>$ticket['tkt_no'],
              'Booking[voyage]'=>$ticket['voyage'],
              'print'=>1,
              'amt'=>1,
              )), 'label'=>'Print','htmlOptions'=>array('target'=>'_blank')));
            ?>
            <?if(count($Cargos)):?>
            <?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'inverse','buttonType'=>'link','icon'=>'print','url'=>Yii::app()->createUrl('booking/tkt',array(
              'Booking[tkt_no]'=>$ticket['tkt_no'],
              'Booking[voyage]'=>$ticket['voyage'],
              'print'=>1,
              'amt'=>0,
              )), 'label'=>'W/O amount','htmlOptions'=>array('target'=>'_blank')));
            ?>
            <?php endif; ?>
            </td>
            </td>
	   </tr>
	 <?php endforeach;?>
     </tbody>
   </table>
   <br>
   <?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'inverse','buttonType'=>'link','icon'=>'print','url'=>Yii::app()->createUrl('booking/tkt',array(
     'Booking[booking_no]'=>$ticket['booking_no'],
     'Booking[voyage]'=>$ticket['voyage'],
     'print'=>1,
     'amt'=>1,
   )), 'label'=>'Print All Ticket/s','htmlOptions'=>array('target'=>'_blank','class'=>'span2' )))
   ?>
   <br>
   <?if(count($Cargos)):?>
   <br>
   <?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'inverse','buttonType'=>'link','icon'=>'print','url'=>Yii::app()->createUrl('booking/tkt',array(
     'Booking[booking_no]'=>$ticket['booking_no'],
     'Booking[voyage]'=>$ticket['voyage'],
     'print'=>1,
     'amt'=>0,
   )), 'label'=>'Print All Ticket/s W/O amount','htmlOptions'=>array('target'=>'_blank','class'=>'span2' )))
   ?>
   <br>
   <?php endif;?>
 <?php endif;?>
  <?php
    if(count($Cargos)):
  ?>
  <br>
  <table width=1000 border=1>
      <thead>
        <tr bgcolor=#F68938>
         <th colspan=10><center>CARGO</center></th>
        </tr>
        <tr>
         <th>BILL OF LADING NO.</th>
         <th>SHIPPER</th>
         <th>COMPANY</th>
         <th>CONTACT</th>
         <th>CLASS</th>
         <th>ARTICLE NO.</th>
         <th>ARTICLE DESCRIPTION</th>
         <th>WEIGHT</th>
         <th>LENGTH</th>
         <th>AMOUNT</th>
        </tr>
      </thead>
      <tbody>
	 <?php foreach($Cargos as $cargo):?>
           <tr>
	     <td><?=$cargo['wb_no']?></td>
	     <td><?=$cargo['shipper']?></td>
	     <td><?=$cargo['company']?></td>
	     <td><?=$cargo['contact']?></td>
	     <td><?=$cargo['class']?></td>
	     <td><?=$cargo['article_no']?></td>
	     <td><?=$cargo['article_desc']?></td>
	     <td><?=$cargo['weight']?></td>
	     <td><?=$cargo['length']?></td>
            <td><?=$cargo['orig_price'] ? $cargo['orig_price'] : $cargo['amount']?></td>
	   </tr>
	 <?php endforeach;?>
     </tbody>
   </table>
   <br>
   <?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'inverse','buttonType'=>'link','icon'=>'print','url'=>Yii::app()->createUrl('bookingCargo/wBill',array(
     'BookingCargo[transaction]'=>$trans->id,
     'BookingCargo[voyage]'=>$cargo['voyage'],
     'print'=>1,
   )), 'label'=>'Print Waybill','htmlOptions'=>array('target'=>'_blank','class'=>'span2' )))
   ?>
   <br>
 <?php endif;?>
