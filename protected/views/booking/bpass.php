  
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
   <?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'inverse','buttonType'=>'link','icon'=>'print','url'=>Yii::app()->createUrl('booking/bpass',array(
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
   <?php foreach($model->search()->getData() as $b):?>
      <table class='table'>
       <tr>
         <th colspan=2><center><?=$b->rate0->class0->name?></center></th>
         <th colspan=2><center><?=$b->rate0->class0->name?></center></th>
       </tr>
       <tr>
         <th colspan=2><center>BOARDING PASS</center></th>
         <th colspan=2><center>BOARDING PASS</center></th>
       </tr>
       <tr>
         <th colspan=2>Official Receipt No.:</th>
         <th colspan=2>Official Receipt No.:</th>
       </tr>
       <tr>
         <th colspan=2>Name: <?=$b->passenger0->first_name?> <?=$b->passenger0->last_name?></th>
         <th colspan=2>Name: <?=$b->passenger0->first_name?> <?=$b->passenger0->last_name?></th>
       </tr>
       <tr>
         <th colspan=2>Booking Reference: <?=$b->booking_no?></th>
         <th colspan=2>Booking Reference: <?=$b->booking_no?></th>
       </tr colspan=2>
       <tr>
         <th>Date: <?=$b->voyage0->departure_date?></th>
         <th>Voyage No.: <?=$b->voyage0->name?></th>
         <th>Date: <?=$b->voyage0->departure_date?></th>
         <th>Voyage No.: <?=$b->voyage0->name?></th>
       </tr>
       <tr>
         <th colspan=2> ACCOUNTING'S COPY</th>
         <th colspan=2> PASSENGER'S COPY</th>
       </tr>
      </table>
    <?php if(!isset($print)):?>
    <?php
    $this->widget('bootstrap.widgets.TbButton', array('type'=>'info','buttonType'=>'link','icon'=>'print','url'=>Yii::app()->createUrl('booking/bpass',array(
     'Booking[tkt_no]'=>$b->tkt_no,
     'Booking[voyage]'=>$b->voyage,
     'print'=>1,
    )), 'label'=>'Print','htmlOptions'=>array('target'=>'_blank','class'=>'ticket_print_box' )));
    ?>
    <?php endif;?>
  <?php endforeach; ?>
