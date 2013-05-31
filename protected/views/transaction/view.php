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
