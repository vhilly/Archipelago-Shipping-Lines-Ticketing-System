<style>
  * {
      font-size:12px;
			font-family:"Lucida Grande","Lucida Sans Unicode",Verdana,Arial,Helvetica,sans-serif;
		}
		table {
      border:0px solid #555;
		  border-collapse:collapse;
		}
    #seat_list {
      text-align:center;
    }
    #seat_list td {
      border:1px solid #555;
      padding:15px;
    }
		#seat_list td:hover {
      background:#f68938;
    }
    #seatBox {
    }
    .reserved, #seat_list td.pre_assign:hover {
      background:#F89406;
    }
    .canceled, #seat_list td.pre_assign:hover {
      background:#B94A48;
    }
    .checkedin, #seat_list td.pre_assign:hover {
      background: #468847;
    }
    .paid, #seat_list td.pre_assign:hover {
      background: #3A87AD;
    }
    .available, #seat_list td.pre_assign:hover {
      background: #f6f6f6;
    }

</style>


<?php

  $this->breadcrumbs=array(
	'Seats',
  );
  $businessClass = array();
  $premiumClass  = array();
  $statusColor   = array('available','reserved','paid','checkedin','canceled');

  $booked =array();
  foreach($bookedSeats as $bs){
    $booked[$bs['id']] = $bs['status'];
  }

echo CHtml::ajaxLink('All',
    array(
        'url'=>array('/user/delete'),
        'type'=>'POST',
        'success'=>'function(data) { $("#ticketModal .modal-body p").html(data); $("#ticketModal").modal(); '
    )
);



  foreach($seatList as $key=>$seat){
    $class = isset($booked[$seat->id]) ? $booked[$seat->id]:0;
    switch($seat->seating_class){
      case 1:
        $businessClass[$seat->id]="<td class=$statusColor[$class]>$seat->name</td>";
        break;
      case 2:
        $premiumClass[$seat->id]="<td class=$statusColor[$class]>$seat->name</td>";
        break;
      case 3:
        $economyClass[$seat->id]="<td class=$statusColor[$class]>$seat->name</td>";
        break;
    }
  }
  
?>

    <?php
      
      $limit = 30;


      $counter = 1;$btd=array();$btr='';
      foreach($businessClass as $bc){
        $btd[]=$bc;     
        if($counter % $limit ==0){
          $btr .= '<tr>'.implode('',$btd).'</tr>';
          unset($btd);
        }
        $counter ++;
      }
      $btr .= '<tr>'.implode('',$btd).'</tr>';

      $counter = 1;$ptd=array();$ptr='';
      foreach($premiumClass as $pc){
        $ptd[]=$pc;     
        if($counter % $limit ==0){
          $ptr .= '<tr>'.implode('',$ptd).'</tr>';
          unset($ptd);
        }
        $counter ++;
      }
      $ptr .= '<tr>'.implode('',$ptd).'</tr>';

      $counter = 1;$etd=array();$etr='';
      foreach($economyClass as $ec){
        $etd[]=$ec;     
        if($counter % $limit ==0){
          $etr .= '<tr>'.implode('',$etd).'</tr>';
          unset($etd);
        }
        $counter ++;
      }
      $etr .= '<tr>'.implode('',$etd).'</tr>';

    ?>
  <?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Business Class',
    'headerIcon' => 'icon-th-list',
    'htmlOptions' => array('class'=>'bootstrap-widget-table span12')
  ));?>
  <table border=1>
   <?=$btr?>
  </table>

  <?php $this->endWidget();?>

  <?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Premium Class',
    'headerIcon' => 'icon-th-list',
    'htmlOptions' => array('class'=>'bootstrap-widget-table span12')
  ));?>
  <table border=1>
   <?=$ptr?>
  </table>

  <?php $this->endWidget();?>


  <?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Economy',
    'headerIcon' => 'icon-th-list',
    'htmlOptions' => array('class'=>'bootstrap-widget-table span12')
  ));?>
  <table border=1>
   <?=$etr?>
  </table>

  <?php $this->endWidget();?>


<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'ticketModal')); ?>
  <div class="modal-header">
    <h4>Ticket Details</h4>
  </div>
  <div class="modal-body">
    <p>Ticket Details</p>
  </div>
  <div class="modal-footer">

    <?php $this->widget('bootstrap.widgets.TbButton', array(
      'label'=>'Close',
      'url'=>'#',
      'htmlOptions'=>array('data-dismiss'=>'modal'),
    )); ?>
  </div>
<?php $this->endWidget(); ?>

