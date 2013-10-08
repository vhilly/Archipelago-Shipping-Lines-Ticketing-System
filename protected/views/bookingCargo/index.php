<?php
$this->breadcrumbs=array(
	'Booked Cargos',
);
?>
<?php
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
                 'lading_no',
                 array(
                   'name'=>'shipper',
                   'value'=>'$data->cargo0->shipper',
                 ),
                 array(
                   'name'=>'company',
                   'sortable'=>true,
                   'value'=>'$data->cargo0->company',
                 ),
                 array(
                   'name'=>'voyage',
                   'sortable'=>true,
                   'value'=>'$data->voyage0->name',
                   'filter'=>CHtml::listData(Voyage::model()->findAll(),'id','name'),
                 ),
		array(
	          'name' => 'type',
                  'sortable'=>true,
                  'filter'=>CHtml::listData(BookingType::model()->findAll(),'id','name'),
                  'value'=>'$data->type0->name',
		),
		array(
			'name' => 'status',
                        'filter'=>CHtml::listData(BookingStatus::model()->findAll(),'id','name'),
                        'value'=>'$data->status0->name',
		),
                 array(
                   'header'=>'Vessel',
                   'sortable'=>true,
                   'value'=>'$data->voyage0->vessel0->name',
                   'filter'=>CHtml::listData(Vessel::model()->findAll(),'id','name'),
                 ),
                 array(
                   'header'=>'Cargo Details',
                   'class' => 'bootstrap.widgets.TbButtonColumn',
                   'template'=>'{viewtkt} {cancel} {refund}',
                   'buttons'=>array(
                     'viewtkt' => array(
                       'label'=>'view',
                       'icon'=>'plus',
                       'url'=>'Yii::app()->controller->createUrl("bookingCargo/view", array("id"=>$data->cargo))',
                       'options'=>array(
                            'ajax'=>array(
                                'type'=>'POST',
                                'url'=>"js:$(this).attr('href')",
                                'success'=>'function(data) { $("#ticketModal .modal-body p").html(data); $("#ticketModal").modal(); }'
                            ),
                        ),
                     ),
                     'cancel' => array(
                       'label'=>'cancel',
                       'options'=>array(
                         'onClick'=>'return confirm("Are you sure?");'
                       ),
                       'icon'=>'trash',
                       'url'=>'Yii::app()->controller->createUrl("bookingCargo/cancel", array("id"=>$data->id))',
                     ),
                     'refund' => array(
                       'label'=>'refund',
                       'options'=>array(
                         'onClick'=>'return confirm("Are you sure?");'
                       ),
                       'icon'=>'share',
                       'url'=>'Yii::app()->controller->createUrl("bookingCargo/refund", array("id"=>$data->id))',
                     ),
                    ),
                  ),
);
  $this->widget('bootstrap.widgets.TbGridView', array(
	'type' => 'striped bordered',
        'htmlOptions'=>array('class'=>'span5'),
	'dataProvider' => $model->search(),
	'template' => "{items},{pager}",
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
