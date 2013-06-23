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
	echo $form->dropDownListRow($model, 'voyage',CHtml::listData(Voyage::model()->findAll(),'id','name'));
   ?>
   <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Go')); ?>
   <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Clear')); ?>
<?php $this->endWidget()?>
<div class='span10'>
<?php
  foreach($model->search()->getData() as $b){
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
    if($b->status < 3){
    $this->widget('bootstrap.widgets.TbButton', array(
	'label'=>'Check-In',
	'type'=>'success',
	'htmlOptions'=>array(
		'style'=>'margin-left:3px;margin-bottom:5px;',
                'onclick'=>'js:bootbox.confirm("Are you sure?",
			function(confirmed){
                          var posting = $.post("'.Yii::app()->controller->createUrl('booking/checkInForm', array('id'=>$b->id)).'");
                          posting.done(function( data ) {
                            var content = $( data ).find("#message");
                            bootbox.alert(data);
                          });
                        })'
	),
   ));
   }else{
    $this->widget('bootstrap.widgets.TbButton', array(
	'label'=>'Check-In',
	'type'=>'inverse',
	'htmlOptions'=>array(
		'style'=>'margin-left:3px;margin-bottom:5px;',
                'disable'=>true,
        ))
     );

   }
  }
?>
</div>

