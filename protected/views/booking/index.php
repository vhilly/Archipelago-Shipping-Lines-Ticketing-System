<?php
  $this->breadcrumbs=array(
    'Booked Tickets',
  );

?>


<?php

  $vl = CHtml::listData(Voyage::model()->findAll(),'id','name');
  $bsl = CHtml::listData(BookingStatus::model()->findAll(),'id','name');
  $bt = CHtml::listData(BookingType::model()->findAll(),'id','name');
  $voy = CHtml::listData(Voyage::model()->findAll(),'id','name');
  $gridColumns = array(
    array(
      'name' => 'date_booked',
      'filter'=>$this->widget('bootstrap.widgets.TbDatePicker', array(
          'model'=>$model,
          'options'=>array('format'=>'yyyy-mm-dd'),
          'htmlOptions' => array(
            'id' => 'Booking_date_booked'
          ),
          'attribute'=>'date_booked'),
        true),
      'sortable'=>true,
    ),
     'booking_no',
     'tkt_no',
     'tkt_serial',
    array(
      'name'=>'first_name',
      'value'=>'$data->passenger0->first_name',
    ),
    array(
      'name'=>'last_name',
      'value'=>'$data->passenger0->last_name',
    ),
    array('name' => 'voyage',
      'filter'=>$voy,
      'sortable'=>true,
      'value' => '$data->voyage0->name',
    ),
    array('name' => 'type',
      'sortable'=>true,
      'filter'=>$bt,
      'value' => '$data->type0->name',
    ),
    array(
 //     'class' => 'bootstrap.widgets.TbEditableColumn',
      'name' => 'status',
      'value'=>'$data->status0->name',
      'filter'=>$bsl,
      'sortable'=>true,
   /*   'editable' => array(
        'type'      => 'select',
        'url' => $this->createUrl('booking/editableSaver'),
        'attribute' => 'dropDown',
        'source'    => CHtml::listData(BookingStatus::model()->findAll(),'id','name'),
        'placement' => 'right',
        'inputclass' => 'span2'
      ),
*/
    ),
    array('header' => 'Vessel',
      'value' => '$data->voyage0->vessel0->name',
    ),
    array(
      'class' => 'bootstrap.widgets.TbButtonColumn',
      'template'=>'{viewtkt} {refund} {cancel}',
      'buttons'=>array(
        'viewtkt' => array(
          'label'=>'view',
          'icon'=>'eye-open',
          'url'=>'Yii::app()->controller->createUrl("booking/view", array("id"=>$data->id))',
          'options'=>array(
            'ajax'=>array(
              'type'=>'POST',
              'url'=>"js:$(this).attr('href')",
              'success'=>'function(data) { $("#ticketModal .modal-body p").html(data); $("#ticketModal").modal(); }'
            ),
          ),
        ),
        'refund' => array(
          'label'=>'refund',
          'options'=>array(
            'onClick'=>'return confirm("Are you sure?");'
          ),
          'icon'=>'minus',
          'url'=>'Yii::app()->controller->createUrl("booking/refund", array("id"=>$data->id))',
        ),
        'cancel' => array(
          'label'=>'cancel',
          'options'=>array(
            'onClick'=>'return confirm("Are you sure?");'
          ),
          'icon'=>'trash',
          'url'=>'Yii::app()->controller->createUrl("booking/cancel", array("id"=>$data->id))',
        ),
      ),
    ),
  );
  $this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'striped bordered',
    'dataProvider' => $model->search(),
    'template' => "{items},{pager}",
    'htmlOptions'=>array('class'=>'span5'),
    'filter'=>$model,
    //   'ajaxUpdate'=>false,
    'afterAjaxUpdate'=>"function() {
          jQuery('#Booking_departure_date').datepicker({'format':'yyyy-mm-dd','language':'en','weekStart':0});
          jQuery('#Booking_date_booked').datepicker({'format':'yyyy-mm-dd','language':'en','weekStart':0});
        }",
    //'columns' => array(
    //	'date_booked',
    //)
    'columns'=>$gridColumns
  ));

?>

<?php echo $this->renderPartial('ticketModal'); ?>
