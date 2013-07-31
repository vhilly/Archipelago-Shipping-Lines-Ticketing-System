<?php if(!isset($print)):?>

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
'id'=>'searchForm',
'type'=>'search',
'method'=>'get',
'htmlOptions'=>array('class'=>'well'),
)); ?>
<?php
echo $form->textFieldRow($model, 'tkt_serial',
array('id'=>'TicketSearch','class'=>'input-large', 'prepend'=>'<i class="icon-search"></i>'));
?>
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Go')); ?>
<br>
<br>
    <?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Passenger List',
    'headerIcon' => 'icon-th-list',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
    'htmlOptions' => array('class'=>'bootstrap-widget-table')
    ));?>
    

      <?php if($passenger){?>
	<?Yii::app()->user->setFlash('success', "Boarded!");?>
    
   
    <?php }
	else
	  //Yii::app()->user->setFlash('error', "Unable to Board,check-in first");

?>

    <?php $this->endWidget(); ?>
    <?php $this->endWidget();?>
<?php else:


?>
      <script>
        //window.print();
      </script>
      <?php if($passenger):?>

        <?php foreach($passenger as $key=>$pass):?>
        <?php for($i=1;$i<=2;$i++){?>
        <?php
        $dt=$pass['departure_date'];
        $dt=date("d F Y",strtotime($dt));

        $da=$pass['departure_time'];
        $da=date("g:i a", strtotime($da));

        $aa=$pass['arrival_time'];
        $aa=date("g:i a", strtotime($aa));



        $arv=$pass['departure_date']." ".$pass['departure_time']."-".$pass['arrival_time'];
        $ot=$dt." ".$da."-".$aa;
        ?>

        <div id="ub1"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FastCat Boarding Pass</b></div>
        <div id="ub2" class="condensed"><?=$pass['first_name']?> <?=$pass['last_name']?></div>
        <div id="ub2"><?=$pass['voyage']?></div>
        <div id="ub3" style="margin-top:-5px"><?=$pass['route']?></div>
        <div id="ub3" class="normal" style="margin-top:-10px"><?=$ot?></div>
         <?php $cl=$pass['class'];
        //echo $cl;
        if($cl=='Business Class'){
        //echo "Yes!";
        echo '<div class="bl" id="ub4" style="margin-top:-2px"><i>&nbsp;&nbsp;<u>'.$cl.'</u></i></div>';
        echo ' <div id="ub5" class="italic seats">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>'.$pass['seat'].'</b></div>';

        }
        else{
         echo '<div class="bl" id="ub7"><b>&nbsp;&nbsp;'.$cl.'</b></div>';
        echo ' <div id="ub6">&nbsp;&nbsp;&nbsp;&nbsp;<b>'.$pass['seat'].'</b></div>';
        }
        ?>

          <div id="ub1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ticket No:<?=$pass['tkt_serial']?></div>

        <!-- end -->
        <?php }?>
        <div style="height:30px"></div>
        <?php endforeach?>
    <?php endif;?>
<?php endif;?>
<script>
  $('#Booking_tkt_serial').focus();
</script>
              
