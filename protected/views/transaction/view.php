<<<<<<< HEAD
<?php
  $this->breadcrumbs=array(
	'Transactions'=>array('index'),
  );

  
?>

    <table class="table" >
      <thead>
        <tr>
         <th>TRANSACTION NO.</th>
         <th>INPUT DATE</th>
         <th>TRANSACTION DATE</th>
         <th>PAYMENT METHOD</th>
         <th>PAYMENT STATUS</th>
         <th>TOTAL AMOUNT</th>
         <th>DISCOUNT</th>
         <th>REFERENCE</th>
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
         <td><?=$trans->reference?></td>
        </tr>
      </tbody>
  </table>
  <?php
    if(count($Tickets)):
  ?>
  <table class="table">
      <thead>
        <tr>
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
            <td><?=$this->getTN($ticket['tktno'])?></td>
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
  <table class="table">
      <thead>
        <tr class="odd">
         <th>CARGO NO.</th>
         <th>SHIPPER</th>
         <th>COMPANY</th>
         <th>CONTACT</th>
         <th>ARTICLE NO.</th>
         <th>ARTICLE DESCRIPTION</th>
         <th>WEIGHT</th>
         <th>LENGTH</th>
        </tr>
      </thead>
      <tbody>
	 <?php foreach($Cargos as $cargo):?>
           <tr>
	     <td><?=$this->getTN($cargo['id'])?></td>
	     <td><?=$cargo['shipper']?></td>
	     <td><?=$cargo['company']?></td>
	     <td><?=$cargo['contact']?></td>
	     <td><?=$cargo['article_no']?></td>
	     <td><?=$cargo['article_desc']?></td>
	     <td><?=$cargo['weight']?></td>
	     <td><?=$cargo['length']?></td>
	   </tr>
	 <?php endforeach;?>
     </tbody>
   </table>
 <?php endif;?>
=======
<?php
  $this->breadcrumbs=array(
	'Transactions'=>array('index'),
  );

  
?>

    <?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
      'title' => 'Transaction Details',
      'headerIcon' => 'icon-th-list',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
      'htmlOptions' => array('class'=>'bootstrap-widget-table span2')
    ));?>
    <table class="table" >
      <thead>
        <tr>
         <th>TRANSACTION NO</th>
         <th>INPUT DATE</th>
         <th>TRANSACTION DATE</th>
         <th>PAYMENT METHOD</th>
         <th>PAYMENT STATUS</th>
         <th>TOTAL AMOUNT</th>
         <th>DISCOUNT</th>
         <th>REFERENCE</th>
        </tr>
      </thead>
      <tbody>
        <tr class="odd">
         <td><?=str_pad($trans->id,11,"0",STR_PAD_LEFT)?></td>
         <td><?=$trans->trans_date?></td>
         <td><?=$trans->input_date?></td>
         <td><?=$trans->paymentMethod->name?></td>
         <td><?=$trans->paymentStatus->name?></td>
         <td><?=$trans->ovamount?></td>
         <td><?=$trans->ovdiscount?></td>
         <td><?=$trans->reference?></td>
        </tr>
     </tbody>
  </table>
  <?php $this->endWidget();?>
  <?php
    if(count($Tickets)){
      foreach($Tickets as $ticket){
        echo $ticket['tktno'];
        echo $ticket['first_name'];
        echo $ticket['last_name'];
        echo $ticket['route'];
        echo $ticket['price'];
      }
    }

  ?>
>>>>>>> 20714e3ea83422bf559c2681e846d705aceeca38
