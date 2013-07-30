  <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'searchForm',
	'type'=>'search',
	'htmlOptions'=>array('class'=>'span10'),
   )); ?>
   <?php
	echo $form->textFieldRow($model, 'tkt_serial',array('class'=>'input-medium span2','id'=>'tktno', 'prepend'=>'<i class="icon-search"></i>'));
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
    $checkedIn = $b->status ==3 || $b->status ==4;
      $this->widget('bootstrap.widgets.TbEditableDetailView', array(
        'id' => 'passenger-details',
        'data' => Passenger::model()->findByPk($b->passenger),
        'url' => $this->createUrl('passenger/editableSaver'), //common submit url for all editables
        'attributes'=>array(
          array('name'=>'Ticket#','value'=>$b->tkt_serial),
          array('name'=>'Booking#','value'=>$b->booking_no),
          'first_name',
          'last_name',
          'gender',
          'address',
          'contact',
          'birth_date',
          'civil_status',
          'email',
          array('name'=>'seat','value'=>$b->seat0->name),
      )
    ));
    $this->widget('bootstrap.widgets.TbButton', array('type'=>'warning','label'=>"Change Seat",'htmlOptions'=>array('id'=>$b->id,'class'=>'tlink ticket_print_box')));
    $this->widget('bootstrap.widgets.TbButton', array(
	'label'=>$checkedIn ? 'Checked-in' : 'Check-In and Print Boarding Pass',
	'type'=>$checkedIn ? 'info': 'success',
        'disabled'=>$checkedIn ? true : false,
	'htmlOptions'=> array(
		'class'=>'ticket_print_box btn',
                'onclick'=>$checkedIn ? '': 'var a = this; js:bootbox.confirm("Are you sure?",
			function(confirmed){
                          if(confirmed){
                            $.post("'.Yii::app()->controller->createUrl('booking/checkInBoardForm').'",{"id":'.$b->id.',"action" :1},
                               function(data){
                                  if(data.error){
                                     console.log(data.error);
                                     bootbox.alert("Please fix the following errors:<br>"+data.error); 
                                  } else {
                                     $(a).attr("disabled","disabled").removeAttr("onclick").addClass("btn-info").removeClass("btn-success").text("Checked-in");
                                     window.open("'.Yii::app()->controller->createUrl('booking/bpass',array('Booking[tkt_serial]'=>$b->tkt_serial,'Booking[voyage]'=>$b->voyage,'print'=>'1')).'","")
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

<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'transferModal')); ?>
     
    <div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Modal header</h4>
    </div>
     
    <div class="modal-body">
    <p></p>
    </div>
     
     
    <?php $this->endWidget(); ?>

<script>
  $('.tlink').click(function(){
      $.ajax({
        type: 'GET',
        url: '<?php echo Yii::app()->baseUrl;?>?r=booking/transferForm&id='+this.id+'&ref=cIN',
        success: function (data){
          $('#transferModal .modal-header h4').html('Change Seat');
          $('#transferModal .modal-body p').html(data);
        },
        error: function (xht){
          alert(this.url);
        }

      });
   // $('#transferModal .modal-body p').html('asa');
    $('#transferModal').modal()
  });
</script>

