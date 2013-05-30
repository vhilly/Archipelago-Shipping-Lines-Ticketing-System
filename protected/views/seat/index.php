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
    .reserve, #seat_list td.reserve:hover {
      background:#f5c;
    }
    .pre_assign, #seat_list td.pre_assign:hover {
      background:#9fc;
    }

</style>



<?php
  $this->breadcrumbs=array(
	'Seats',
  );
  $businessClass = array();
  $premiumClass  = array();
  $statusColor   = array('','pre_assign','pre_assign','reserve');

  $booked =array();
  foreach($bookedSeats as $bs){
    $booked[$bs->ticket] = $bs->status;
  }


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
      $counter = 0;$limit = 20;$td='';$tr='';
      foreach($businessClass as $bc){
         $td .= 
           $bc;
         if($counter==$limit){
           $tr .= "<tr>$td</tr>";
           $counter=0;$td='';
         }

         $counter++;
      }
    ?>
  <?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Business Class',
    'headerIcon' => 'icon-th-list',
    'htmlOptions' => array('class'=>'bootstrap-widget-table span2')
  ));?>
  <table border=1>
   <?=$tr?>
  </table>

  <?php $this->endWidget();?>
