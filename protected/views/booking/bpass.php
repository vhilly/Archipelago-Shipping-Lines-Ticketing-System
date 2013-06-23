<?php
  $this->breadcrumbs=array(
    'Tickets',
  );
?>


<?php $this->renderPartial('_searchform',array('model'=>$model),false,false)?>
<?php if(!$is_empty):?>


   <?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'inverse','buttonType'=>'submit','icon'=>'print', 'label'=>'Print All','htmlOptions'=>array('class'=>'ticket_print_box span10')));?>
  <div style="clear:both"> </div><br>
  <?php foreach($boardingPassView as $bpassView):

    $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    //  'title' => 'Ticket No. '.str_pad($bpassView['tktno'],11,'0',STR_PAD_LEFT),
      'headerIcon' => 'icon-th-list',
      'htmlOptions' => array('class'=>'bootstrap-widget-table span10 ticket_print_box')
    ));
    ?>
      <table class='span8 table'>
       <tr>
         <th colspan=2><center>BOARDING PASS</center></th>
       </tr>
       <tr>
         <th colspan=2>Official Receipt No.:</th>
       </tr>
       <tr>
         <th colspan=2>Name: <?=$bpassView['name']?></th>
       </tr>
       <tr>
         <th colspan=2>Booking Reference: <?=$bpassView['booking_no']?></th>
       </tr colspan=2>
       <tr>
         <th>Date: <?=$bpassView['departure_date']?></th>
         <th>Voyage No.: <?=$bpassView['voy']?></th>
       </tr>
      </table>
   <?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'info','buttonType'=>'submit','icon'=>'print', 'label'=>'Print','htmlOptions'=>array('class'=>'ticket_print_box')));?>
    <?php $this->endWidget();?>
  <?php endforeach; ?>
   <?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'inverse','buttonType'=>'submit','icon'=>'print', 'label'=>'Print All','htmlOptions'=>array('class'=>'ticket_print_box span10')));?>

<?php endif;?>
