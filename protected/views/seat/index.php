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
    .reserved{
      background:#F89406;
    }
    .canceled{
      background:#B94A48;
    }
    .checkedin{
      background: #468847;
    }
    .paid {
      background: #3A87AD;
    }
    .available {
      background: #f6f6f6;
    }
   
</style>

  <?php $this->renderPartial('_availabilityForm',array('model'=>$model),false,false)?>
  <?php if(!$is_empty):?>

<?php

  $this->breadcrumbs=array(
	'Seats',
  );
  $businessClass = array();
  $premiumClass  = array();
  $statusColor   = array('available','reserved','paid','checkedin','canceled');

  $booked =array();
  foreach($bookedSeats as $bs){
    $booked[$bs['id']] = array('bid'=>$bs['bookid'],'status'=>$bs['status']);
  }

  foreach($seatList as $key=>$seat){
   $link = isset($booked[$seat->id]) ?  "<td class='seatMap ".$statusColor[$booked[$seat->id]['status']]."' id=".$booked[$seat->id]['bid'].">$seat->name</td>" :"<td class='available'>$seat->name</td>";

    switch($seat->seating_class){
      case 1:
        $businessClass[$seat->id]=$link;
        break;
      case 2:
        $premiumClass[$seat->id]=$link;
        break;
      case 3:
        $economyClass[$seat->id]=$link;
        break;
    }
  }
  
?>

    <?php
      $limit = 20; $counter = 1;$btd=array();$btr='';
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
  <table border=1 id=seats>
   <?=$btr?>
  </table>

  <?php $this->endWidget();?>

  <?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Premium Class',
    'headerIcon' => 'icon-th-list',
    'htmlOptions' => array('class'=>'bootstrap-widget-table span12')
  ));?>
  <table border=1 id=seats>
   <?=$ptr?>
  </table>

  <?php $this->endWidget();?>


  <?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Economy',
    'headerIcon' => 'icon-th-list',
    'htmlOptions' => array('class'=>'bootstrap-widget-table span12')
  ));?>
  <table border=1 id=seats>
   <?=$etr?>
  </table>

  <?php $this->endWidget();?>


<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'bookingModal')); ?>
  <div class="modal-header">
  </div>
  <div class="modal-body">
    <p>;p</p>
  </div>
  <div class="modal-footer">

    <?php $this->widget('bootstrap.widgets.TbButton', array(
      'label'=>'Close',
      'url'=>'#',
      'htmlOptions'=>array('data-dismiss'=>'modal'),
    )); ?>
  </div>
<?php $this->endWidget(); ?>
<script>

 $('.seatMap').click(
   function(){
      $('#bookingForm').toggle();
      $('#Booking_id').val(this.id);
      $('#selectedSeat').html($(this).text());
   }
 );

//jQuery(function($) {
//  jQuery('body').on('click','.seatMap',function(){jQuery.ajax({'type':'POST','success':function(data){ $("#bookingModal .modal-body p").html(data); $("#bookingModal").modal();  },'url':'/arc/index.php?r=booking/view&id='+this.id,'cache':false,'data':jQuery(this).parents("form").serialize()});return false;});
//});
</script>
  <?php endif;?>
