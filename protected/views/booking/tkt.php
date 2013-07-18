
  <?php if(!isset($print)):?>
  <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'searchForm',
	'type'=>'search',
	'method'=>'get',
	'htmlOptions'=>array('class'=>'span10'),
   )); ?>
   <?php
	echo $form->textFieldRow($model, 'tkt_no',array('class'=>'input-medium span2','id'=>'tktno', 'prepend'=>'<i class="icon-search"></i>'));
	echo $form->textFieldRow($model, 'booking_no',array('class'=>'input-medium span2','id'=>'booking'));
	echo $form->textFieldRow($model, 'first_name',array('class'=>'input-medium span2','id'=>'fname'));
	echo $form->textFieldRow($model, 'last_name',array('class'=>'input-medium span2','id'=>'lname'));
	echo $form->dropDownListRow($model, 'voyage',CHtml::listData(Voyage::model()->findAll(),'id','name'),array('empty'=>''));
        echo "<input type=hidden name=print value=0>";
   ?>
   <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Go')); ?>
   <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Clear')); ?>
   <?php $this->endWidget()?>
   <?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'inverse','buttonType'=>'link','icon'=>'print','url'=>Yii::app()->createUrl('booking/tkt',array(
     'Booking[tkt_no]'=>$model->tkt_no,
     'Booking[booking_no]'=>$model->booking_no,
     'Booking[first_name]'=>$model->first_name,
     'Booking[last_name]'=>$model->last_name,
     'Booking[voyage]'=>$model->voyage,
     'print'=>1,
   )), 'label'=>'Print All','htmlOptions'=>array('target'=>'_blank','class'=>'span2' )))
   ?>
  <?php endif;?>
   <div style="clear:both"> </div><br>
   <?php foreach($model->printSearch()->getData() as $b):?>
   <table>
     <tr><td width=99%>
      <table>
       <tr><th class="sub-brand"></th><th class="brand"></th></tr>
       <tr>	 
	 <th><h5>PASSENGER TICKET NO.</h5></th> <th><h5><?=$b->tkt_no?></h5></th>
         <th><h5>PASSENGER TICKET NO.</h5></th> <th><h5><?=$b->tkt_no?></h5></th>
       </tr>
       <tr>
         <th>Vessel: <u><?=$b->voyage0->vessel0->name?></u></th> <th>Voyage No.: <u><?=$b->voyage0->name?></u></th>
         <th>Vessel: <u><?=$b->voyage0->vessel0->name?></u></th> <th>Voyage No.: <u><?=$b->voyage0->name?></u></th>
       </tr>
       <tr>
	 <th>Date: <u><?=date('Y-m-d');?></u></th> <th>Seat No.: <u><?=isset($b->seat0->name) ? $b->seat0->name : 'NO SEAT ASSIGNED'?></u></th>
	 <th>Date: <u><?=date('Y-m-d');?></u></th> <th>Seat No.: <u><?=isset($b->seat0->name) ? $b->seat0->name : 'NO SEAT ASSIGNED'?></u></th>
       </tr>	 
       <tr>
         <th colspan=2>Passenger's Name: <u><?=$b->passenger0->first_name?> <?=$b->passenger0->last_name?></u></th>
         <th colspan=2>Passenger's Name: <u><?=$b->passenger0->first_name?> <?=$b->passenger0->last_name?></u></th>
       </tr>
       <tr>
         <th colspan=2>Contact Nos.: <u><?=$b->passenger0->contact?></u></th>
         <th colspan=2>Contact Nos.: <u><?=$b->passenger0->contact?></u></th>
       </tr>
       <tr>
         <th colspan=2>Amount: <u><?=$b->rate0->price?></u></th>
         <th colspan=2>Amount: <u><?=$b->rate0->price?></u></th>
       </tr>
       <tr>
         <th colspan=2>Total: <u><?=$b->rate0->price?></u></th>
         <th colspan=2>Total: <u><?=$b->rate0->price?></u></th>
       </tr>
       <tr>
         <th colspan=2><center><h4>ACCOUNTING</h4></center></th>
         <th colspan=2><center><h4>PASSENGER </h4></center></th>
       </tr>
      </table>
    </td>
    <td>
     <table class="rotate">
       <tr>
        <th><h5>PASSENGER TICKET NO.</h5></th> <th><h5><?=$b->tkt_no?></h5></th>
       </tr>
       <tr>
	<th><center><h4>INSPECTOR</h4></center></th>
       </tr>
     </table>	 
    </td>
    </tr>
   </table>


    <?php if(!isset($print)):?>
    <?php
    $this->widget('bootstrap.widgets.TbButton', array('type'=>'info','buttonType'=>'link','icon'=>'print','url'=>Yii::app()->createUrl('booking/tkt',array(
     'Booking[tkt_no]'=>$b->tkt_no,
     'Booking[voyage]'=>$b->voyage,
     'print'=>1,
    )), 'label'=>'Print','htmlOptions'=>array('target'=>'_blank','class'=>'ticket_print_box' )));
    ?>
    <?php endif;?>
  <?php endforeach; ?>
