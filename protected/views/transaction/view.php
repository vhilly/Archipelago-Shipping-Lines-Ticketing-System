<?php
  $this->breadcrumbs=array(
	'Transactions'=>array('index'),
  );

  
?>
    <table width=1000 border=1>
      <thead>
        <tr bgcolor=#F68938>
         <th colspan=10><center>TRANSACTION DETAILS</center></th>
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
         <td><?=$trans->uid?></td>
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
            <td><?=$ticket['price']?></td>
	   </tr>
	 <?php endforeach;?>
     </tbody>
   </table>
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
	     <td><?=$cargo['amount']?></td>
	   </tr>
	 <?php endforeach;?>
     </tbody>
   </table>
 <?php endif;?>
