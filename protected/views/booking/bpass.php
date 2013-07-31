
<style>
div.italic {font-style:italic;}
div.bl {font-style:Bold;} 
div.condensed {font-style:condensed;}
div.normal {font-style:normal;}

#ub1{
	font-family:"Ubuntu";
	font-style:"Bold";
	font-size:8pt;
	
} 
#ub2{
	font-family:"Ubuntu";
	text-align:justify;
	font-size:16pt;
}
#ub3{
	font-family:"Ubuntu";
	font-size:8pt;
	text-align:justify;

}
#ub4{
	font-family:"Ubuntu";
	
	font-size:18pt;
}
#ub5{
	font-family:"Ubuntu";
	font-style:"italic";
	font-size:26pt;
}
#ub6{
	font-family:"Times New Roman";
	font-size:26pt;
}
#ub7{
	font-family:"Arial";
	font-size:12pt;
}
</style>
  
  <?php if(isset($print)):?>
  <script>
    window.print();
    window.close();
  </script>
  <?php endif;?>
  <?php if(!isset($print)):?>
  <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'searchForm',
	'type'=>'search',
	'method'=>'get',
	'htmlOptions'=>array('class'=>'span10'),
   )); ?>
   <?php
	echo $form->textFieldRow($model, 'tkt_serial',array('class'=>'input-medium span2','id'=>'tktno', 'prepend'=>'<i class="icon-search"></i>'));
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
     'Booking[tkt_serial]'=>$model->tkt_serial,
     'Booking[booking_no]'=>$model->booking_no,
     'Booking[first_name]'=>$model->first_name,
     'Booking[last_name]'=>$model->last_name,
     'Booking[voyage]'=>$model->voyage,
   
     'print'=>1,
   )), 'label'=>'Print All','htmlOptions'=>array('target'=>'_blank','class'=>'span2' )))
   ?>
   <div style=clear:both></div>
  <?php endif;?>
   <?php foreach($model->printSearch()->getData() as $b):?>
       <br>
       <br>
       <table>
	<tr>
        <td>
	<div id="ub1"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FastCat Boarding Pass</b></div>
       
	 <div id="ub2" class="condensed"><?=$b->passenger0->first_name?> <?=$b->passenger0->last_name?></div> 
	        
       
 	<div id="ub2"><?=$b->voyage0->name?></div>
	<div id="ub3"><?=$b->voyage0->route0->name?></div>

      	 <div><?//=$Voyage->route->name ?></div>
	<?php
	$dt=$b->voyage0->departure_date;
	$dt=date("d F Y",strtotime($dt));
	
	$da=$b->voyage0->departure_time;
	$da=date("g:i a", strtotime($da));

	$aa=$b->voyage0->arrival_time;
        $aa=date("g:i a", strtotime($aa));



        $arv=$b->voyage0->departure_date." ".$b->voyage0->departure_time."-".$b->voyage0->arrival_time; 
	$ot=$dt." ".$da."-".$aa;
	?>
         <div id="ub3" class="normal"><?=$ot?></div>         
	 <?php $cl=$b->rate0->class0->name;
        //echo $cl;
        if($cl=='Business Class'){
        //echo "Yes!";
        echo '<div class="bl" id="ub4"><i>&nbsp;&nbsp;<u>'.$cl.'</u></i></div>';
        echo ' <div id="ub5" class="italic">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>'.$b->seat0->name.'</b></div>';

        }
        else{
         echo '<div class="bl" id="ub7"><b>&nbsp;&nbsp;'.$cl.'</b></div>';
        echo ' <div id="ub6">&nbsp;&nbsp;&nbsp;&nbsp;<b>'.$b->seat0->name.'</b></div>';
        }
        ?>
       

	<!--<div class="bl" id="ub4"><i>&nbsp;&nbsp;<u><?//=$b->rate0->class0->name;?></u></i></div>       
       
        <div id="ub5" class="italic">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?//=$b->seat0->name?></b></div>
      -->  


	  <div id="ub1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ticket No:<?=$b->tkt_serial?></div>
	

	  </td>
	</tr>
        <td>
  	<div id="ub1"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FastCat Boarding Pass</b></div>

         <div id="ub2" class="condensed"><?=$b->passenger0->first_name?> <?=$b->passenger0->last_name?></div>


	 <div id="ub2"><?=$b->voyage0->name?></div>
	 <div id="ub3"><?=$b->voyage0->route0->name?></div>

	 <div id="ub3" class="normal"><?=$ot?></div>
	<?php $cl=$b->rate0->class0->name;
	//echo $cl;
	if($cl=='Business Class'){
	//echo "Yes!";
	echo '<div class="bl" id="ub4"><i>&nbsp;&nbsp;<u>'.$cl.'</u></i></div>';
	echo ' <div id="ub5" class="italic">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>'.$b->seat0->name.'</b></div>';

	}
	else{
	 echo '<div class="bl" id="ub7"><b>&nbsp;&nbsp;'.$cl.'</b></div>';
        echo ' <div id="ub6">&nbsp;&nbsp;&nbsp;&nbsp;<b>'.$b->seat0->name.'</b></div>';
	}
	?>
        <!--<div class="bl" id="ub4"><i>&nbsp;&nbsp;<u><?//=$b->rate0->class0->name;?></u></i></div>-->
	
        <!--<div id="ub5" class="italic">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?//=$b->seat0->name?></b></div>-->



          <div id="ub1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ticket No:<?=$b->tkt_serial?></div>

        <br>

	  </td>
	  </tr>
       </table>
    <br>
    <?php if(!isset($print)):?>
    <?php
    $this->widget('bootstrap.widgets.TbButton', array('type'=>'info','buttonType'=>'link','icon'=>'print','url'=>Yii::app()->createUrl('booking/bpass',array(
     'Booking[tkt_serial]'=>$b->tkt_serial,
     'Booking[voyage]'=>$b->voyage,
     'print'=>1,
    )), 'label'=>'Print','htmlOptions'=>array('target'=>'_blank','class'=>'span2' )));
    ?>
    <?php endif;?>
  <?php endforeach; ?>
