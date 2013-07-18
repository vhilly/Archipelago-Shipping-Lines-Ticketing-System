  <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'searchForm',
	'type'=>'search',
	'htmlOptions'=>array('class'=>'span10'),
   )); ?>
   <?php
	echo $form->textFieldRow($model, 'tkt_no',array('class'=>'input-medium span2','id'=>'tktno', 'prepend'=>'<i class="icon-search"></i>'));
	echo $form->textFieldRow($model, 'booking_no',array('class'=>'input-medium span2','id'=>'booking'));
	echo $form->textFieldRow($model, 'first_name',array('class'=>'input-medium span2','id'=>'fname'));
	echo $form->textFieldRow($model, 'last_name',array('class'=>'input-medium span2','id'=>'lname'));
        echo $form->dropDownListRow($model, 'voyage',CHtml::listData(Voyage::model()->findAll(array('condition'=>'status < 3')),'id','name')); //hide all closed voyages
   ?>
   <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Go')); ?>
   <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Clear')); ?>
<br><br>
<div class='span9'>
<?php
  foreach($model->printSearch()->getData() as $b){
    if($b->status<3)
      continue 1;
    $boarded =  $b->status ==4;
      $this->widget('bootstrap.widgets.TbEditableDetailView', array(
        'id' => 'passenger-details',
        'data' => Passenger::model()->findByPk($b->passenger),
        'url' => $this->createUrl('passenger/editableSaver'), //common submit url for all editables
        'attributes'=>array(
          array('name'=>'Ticket#','value'=>$b->tkt_no),
          array('name'=>'Booking#','value'=>$b->booking_no),
          'first_name',
          'last_name',
          'gender',
          'address',
          'contact',
          'birth_date',
          'email',
      )
    ));
    $this->widget('bootstrap.widgets.TbButton', array(
	'label'=>$boarded ? 'Boarded' : 'Board',
	'type'=>$boarded ? 'info': 'success',
        'disabled'=>$boarded ? true : false,
	'htmlOptions'=> array(
		'class'=>'ticket_print_box btn',
                'onclick'=>$boarded ? '': 'var a = this; js:bootbox.confirm("Are you sure?",
			function(confirmed){
                          if(confirmed){
                            $.post("'.Yii::app()->controller->createUrl('booking/checkInBoardForm').'",{"id":'.$b->id.',"action" :2},
                               function(data){
                                  if(data.error){
                                     console.log(data.error);
                                     bootbox.alert("Please fix the following errors:<br>"+data.error); 
                                  } else {
                                     $(a).attr("disabled","disabled").removeAttr("onclick").addClass("btn-info").removeClass("btn-success").text("Boarded");
                                  }
                               },
                             "json");
                          }
                        })'
	),
   ));
   echo "<br><br><br><br>";
  }
?>
</div>

<?php $this->endWidget()?>
