<style>

		table {
      border:0px solid #555;
		  border-collapse:collapse;
		  width:100%;
		}
    #seat_list {
      text-align:center;
    }
    #seat_list td {
      border:1px solid #555;
      /*padding:10px;*/
      font-weight:bold;

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
    $booked[$bs['id']] = array('bid'=>$bs['bookid'],'statusColor'=>$bs['color']);
  }

  foreach($seatList as $key=>$seat){
   $link = isset($booked[$seat->id]) ?  "<td  class='seatMap' bgcolor= ".$booked[$seat->id]['statusColor']." id=".$booked[$seat->id]['bid'].">$seat->name</td>" :"<td>$seat->name</td>";

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
    'htmlOptions' => array('class'=>'bootstrap-widget-table seat_avail')
  ));?>
  <table id=seat_list>
   <?=$btr?>
  </table>

  <?php $this->endWidget();?>

  <?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Premium Class',
    'headerIcon' => 'icon-th-list',
    'htmlOptions' => array('class'=>'bootstrap-widget-table seat_avail')
  ));?>
  <table border=1 id=seat_list>
   <?=$ptr?>
  </table>

  <?php $this->endWidget();?>


  <?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Economy',
    'headerIcon' => 'icon-th-list',
    'htmlOptions' => array('class'=>'bootstrap-widget-table seat_avail')
  ));?>
  <table border=1 id=seat_list>
   <?=$etr?>
  </table>

  <?php $this->endWidget();?>


<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'bookingModal')); ?>
  <div class="modal-header">
  </div>
  <div class="modal-body" align=center>
    <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
      'id'=>'inlineForm',
      'type'=>'inline',
      'htmlOptions'=>array('class'=>'well'),
     )); ?>
    <?php echo $form->hiddenField($booking,'id')?>
    <p style="font-family:arial;color:red;font-size:40px;"></p>
    <?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'info','buttonType'=>'submit', 'label'=>'Make Seat Available','htmlOptions'=>array('onclick'=>'return confirm("Are you sure?");'))); ?>
 
   <?php $this->endWidget(); ?>
  
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
      $('#bookingModal .modal-body p').html($(this).text());
      $('#bookingModal').modal();
    //  $('#bookingForm').toggle();
      $('#Booking_id').val(this.id);
      $('#selectedSeat').html($(this).text());
   }
 );

//jQuery(function($) {
//  jQuery('body').on('click','.seatMap',function(){jQuery.ajax({'type':'POST','success':function(data){ $("#bookingModal .modal-body p").html(data); $("#bookingModal").modal();  },'url':'/arc/index.php?r=booking/view&id='+this.id,'cache':false,'data':jQuery(this).parents("form").serialize()});return false;});
//});
</script>
  <?php endif;?>
