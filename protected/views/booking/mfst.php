<style>
#Booking_voyage.enteng {
  width:350px;
}
</style>
  <?php $cs = Passenger::model()->getCSOptions();?>

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
	echo "<br><br>";
	echo $form->dropDownListRow($model, 'voyage',CHtml::listData(Voyage::model()->findAll(),'id','name'),array('class'=>'enteng') );
        echo "<input type=hidden name=print value=0>";
   ?>
   <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Go')); ?>
   <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Clear')); ?>
   <?php $this->endWidget()?>
  <?php endif;?>

<?php 
$vessel = isset($model->voyage0->vessel0->name) ? $model->voyage0->vessel0->name : '________';
$from = isset($model->voyage0->route0->from) ? $model->voyage0->route0->from : '________';
$dept_date = isset($model->voyage0->departure_date) ? $model->voyage0->departure_date : '';
$day = date("jS",strtotime($dept_date));
$month = date("F",strtotime($dept_date));
$year = date("Y",strtotime($dept_date));
$date = date("Y/m/d");
$today = date("jS",strtotime($date));
$tomonth = date("F",strtotime($date));
$toyear = date("Y",strtotime($date));
$to = isset($model->voyage0->route0->to) ? $model->voyage0->route0->to : '________';
?>
   <?php $ctr=1?>
   <?php foreach($model->printSearch()->getData() as $key=>$b): ?>
       <?php if($ctr==36){$ctr=1;}?>
       <?php if($ctr==1):?>

	<center style="font-size:19px;text-align:center ">Republic of the Philippines<br>
	<b style="font-size:19px">Department of Finance<br>BUREAU OF CUSTOMS<b><br><br>
        <b><span style="border-bottom:1px solid; font-size:22px;">PASSENGERS COASTING MANIFEST</span></b></center><br><br>
	<div style="text-indent:30px">Complete list of all passengers taken on board the <u><?=$vessel?></u> sailing from the port of <u><?=$from?></u> on the <u><?=$day?></u> day of <u><?=$month?></u>, <u><?=$year?></u> for the port of <u><?=$to?></u><br><br></div>

      <table class='table' border=1px >
       <tr>
         <th></th>
         <th><h5>NAME OF PASSENGERS</h5></th>
         <th><h5>SEX</h5></th>
         <th><h5>AGE</h5></th>
         <th><h5>CIVIL STATUS</h5></th>
         <th><h5>NATIONALITY</h5></th>
         <th><h5>HOME ADDRESS</h5></th>
         <th><h5>DESTINATION</h5></th>
       </tr>

       <?php endif;?>
       <?php $birthDate = explode("-", $b->passenger0->birth_date); $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[1], $birthDate[2], $birthDate[0]))) > date("md") ? ((date("Y")-$birthDate[0])-1):(date("Y")-$birthDate[0]));
?>
       <tr>
         <td><?=$key+1?>.</td>
         <th> <h6><?=$b->passenger0->first_name?> <?=$b->passenger0->last_name?> </h6></th>
         <th> <h6><?=$b->passenger0->gender?></h6></th>
         <th> <h6><?=$age?></h6></th>
         <th> <h6></h6><?=$cs[$b->passenger0->civil_status]?></th>
         <th> <h6><?=$b->passenger0->nationality?></h6></th>
         <th> <h6><?=$b->passenger0->address?> </h6></th>
         <th> <h6><?=$b->voyage0->route0->to?> </h6></th>
       </tr>

       <?php if($ctr==35):?><tr><td colspan='8' style="border:1px solid white;border-top:1px">
	District of <u><?=$from?></u>, Port of <u><?=$from?></u> to <u><?=$to?></u> Master/Patron of ________________________________ 
	Hereby solemnly swear (or affirm) that the foregoing is a full and complete manifest of all passengers on board the said vessel and
	that all statement contained herein is true to be the best of my knowledge and belief.<br><br>
	<table style=";width:800px">
          <tr>
            <td width=75% style='border-top:1px solid white'>&nbsp;</td>
	    <td width=200px style='border-top:1px solid black;text-align:center;padding:1px'><span style="font-size:16px;">MASTER  PATRON</span></td>
          </tr>
	</table>
	<table>
	    <tr>
	    <td  style='border-top:1px solid white;'>SUBSCRIBED AND SWORN TO before me this <u><?=$today?></u> day of <u><?=$tomonth?></u>, <u><?=$toyear?></u> in the city of <u><?=$from?></u>, Philippines.</td>
	  </tr>
        </table><br>
	<table style=";width:800px">
          <tr>
            <td width=75% style='border-top:1px solid white'>&nbsp;</td>
            <td width=200px style='border-top:1px solid black;text-align:center;padding:1px'><span style="font-size:16px;">ADMINISTERING OFFICER</span></td>
          </tr>
        </table>

	</td></tr>
       </table>

	<?php if(!isset($print)):?>
	<?php
	$this->widget('bootstrap.widgets.TbButton', array('type'=>'info','buttonType'=>'link','icon'=>'print','url'=>Yii::app()->createUrl('booking/manifest',array(
	'Booking[voyage]'=>$model->voyage,
	'print'=>1,
	)), 'label'=>'Print','htmlOptions'=>array('target'=>'_blank','class'=>'ticket_print_box' )));
	?><br><br>
    	<?php endif;?>
 
       <?php endif;?>
       <?php $ctr++;?>
  <?php endforeach; ?>

<tr><td colspan='8' style="border:1px solid white;border-top:1px">
        District of <u><?=$from?></u>, Port of <u><?=$from?></u> to <u><?=$to?></u> Master/Patron of ________________________________
        Hereby solemnly swear (or affirm) that the foregoing is a full and complete manifest of all passengers on board the said vessel and
        that all statement contained herein is true to be the best of my knowledge and belief.<br><br>
        <table style=";width:800px">
          <tr>
            <td width=75% style='border-top:1px solid white'>&nbsp;</td>
            <td width=200px style='border-top:1px solid black;text-align:center;padding:1px'><span style="font-size:16px;">MASTER  PATRON</span></td>
          </tr>
        </table>
        <table>
            <tr>
            <td  style='border-top:1px solid white;'>SUBSCRIBED AND SWORN TO before me this <u><?=$today?></u> day of <u><?=$tomonth?></u>, <u><?=$toyear?></u> in the city of <u><?=$from?></u>, Philippines.</td>
          </tr>
        </table><br>
        <table style=";width:800px">
          <tr>
            <td width=75% style='border-top:1px solid white'>&nbsp;</td>
            <td width=200px style='border-top:1px solid black;text-align:center;padding:1px'><span style="font-size:16px;">ADMINISTERING OFFICER</span></td>
          </tr>
        </table>
        
        </td></tr>
       </table>

        <?php if(!isset($print)):?>
        <?php
        $this->widget('bootstrap.widgets.TbButton', array('type'=>'info','buttonType'=>'link','icon'=>'print','url'=>Yii::app()->createUrl('booking/manifest',array(
        'Booking[voyage]'=>$model->voyage,
        'print'=>1,
        )), 'label'=>'Print','htmlOptions'=>array('target'=>'_blank','class'=>'ticket_print_box' )));
        ?>
        <?php endif;?>

