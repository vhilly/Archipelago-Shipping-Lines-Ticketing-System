  <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'searchForm',
	'type'=>'search',
	'htmlOptions'=>array('class'=>'span10'),
   )); ?>
   <?php
	echo $form->textFieldRow($model, 'lading_no',array('class'=>'input-medium span2','id'=>'ladingno', 'prepend'=>'<i class="icon-search"></i>'));
	echo $form->textFieldRow($model, 'booking_no',array('class'=>'input-medium span2','id'=>'booking'));
	echo $form->textFieldRow($model, 'shipper',array('class'=>'input-medium span2','id'=>'shipper'));
	echo $form->textFieldRow($model, 'company',array('class'=>'input-medium span2','id'=>'company'));
        echo $form->dropDownListRow($model, 'voyage',CHtml::listData(Voyage::model()->findAll(array('condition'=>'status < 3')),'id','name')); //hide all closed voyages
   ?>
   <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Go')); ?>
   <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Clear')); ?>
<br><br>
<div class='span9'>
<?php
  foreach($model->search()->getData() as $b){
    if($b->status<3)
      continue 1;
    $boarded =  $b->status ==4;
      $this->widget('bootstrap.widgets.TbDetailView', array(
        'id' => 'passenger-details',
        'data' => $model = Cargo::model()->findByPk($b->cargo),
        'attributes'=>array(
          array('name'=>'Booking#','value'=>$b->booking_no),
          array('name'=>'Lading#','value'=>$b->lading_no),
          'company',
          'destination',
          'address',
          array('name'=>'cargo_class','value'=>$model->cargoClass->name),
          'article_no',
          'article_desc',
          'weight',
          'length',
          'contact',
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
                            $.post("'.Yii::app()->controller->createUrl('bookingCargo/checkInBoardForm').'",{"id":'.$b->id.',"action" :2},
                               function(data){
                                  if(data.error){
                                    alert("error");
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
