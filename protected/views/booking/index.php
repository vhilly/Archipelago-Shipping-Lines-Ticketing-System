<?php
  $this->breadcrumbs=array(
    'Booked Tickets',
  );

?>


<?php

  $vl = CHtml::listData(Voyage::model()->findAll(),'id','name');
  $bsl = CHtml::listData(BookingStatus::model()->findAll(),'id','name');
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
    array(
      'name'=>'first_name',
      'value'=>'$data->passenger0->first_name',
    ),
    array(
      'name'=>'last_name',
      'value'=>'$data->passenger0->last_name',
    ),
    array(
      'class' => 'bootstrap.widgets.TbEditableColumn',
      'name'=>'voyage',
      'value'=>'$data->ticket0->voyage0->name',
      'filter'=>$vl,
      'sortable'=>true,
    ),
    array(
      'class' => 'bootstrap.widgets.TbEditableColumn',
      'name' => 'status',
      'filter'=>$bsl,
      'sortable'=>true,
      'editable' => array(
        'type'      => 'select',
        'url' => $this->createUrl('booking/editableSaver'),
        'attribute' => 'dropDown',
        'source'    => CHtml::listData(BookingStatus::model()->findAll(),'id','name'),
        'placement' => 'right',
        'inputclass' => 'span2'

      ),
    ),
    array(
      'name'=>'transNo',
      'sortable'=>true,
      'value'=>'str_pad($data->transaction,11,"0",STR_PAD_LEFT)'),
    array(
      'header'=>'Ticket Details',
      'class' => 'bootstrap.widgets.TbButtonColumn',
      'template'=>'{viewtkt}',
      'buttons'=>array(
        'viewtkt' => array(
          'label'=>'view',
          'icon'=>'plus',
          'url'=>'Yii::app()->controller->createUrl("ticket/view", array("id"=>$data->ticket))',
          'options'=>array(
            'ajax'=>array(
              'type'=>'POST',
              'url'=>"js:$(this).attr('href')",
              'success'=>'function(data) { $("#ticketModal .modal-body p").html(data); $("#ticketModal").modal(); }'
            ),
          ),
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
