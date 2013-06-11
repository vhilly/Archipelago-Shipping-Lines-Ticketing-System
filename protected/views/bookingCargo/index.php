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
                   'filter'=>CHtml::listData(Voyage::model()->findAll(array('condition'=>'departure_date BETWEEN CURDATE() AND CURDATE() + INTERVAL 1 DAY')),'id','name'),
                 ),
                 array(
                   'header'=>'Voyage',
                   'sortable'=>true,
                   'value'=>'$data->voyage0->vessel0->name',
                   'filter'=>CHtml::listData(Vessel::model()->findAll(),'id','name'),
                 ),
		array(
			'class' => 'bootstrap.widgets.TbEditableColumn',
			'name' => 'status',
                        'filter'=>CHtml::listData(BookingStatus::model()->findAll(),'id','name'),
			'sortable'=>true,
			'editable' => array(
                                'type'      => 'select',
				'url' => $this->createUrl('bookingCargo/editableSaver'),
                                'attribute' => 'dropDown',
                                 'source'    => CHtml::listData(BookingStatus::model()->findAll(),'id','name'),
				'placement' => 'right',
				'inputclass' => 'span2'

			),
		),
                 array(
                   'header'=>'Cargo Details',
                   'class' => 'bootstrap.widgets.TbButtonColumn',
                   'template'=>'{viewtkt}',
                   'buttons'=>array(
                     'viewtkt' => array(
                       'label'=>'view',
                       'icon'=>'plus',
                       'url'=>'Yii::app()->controller->createUrl("cargoBooking/view", array("id"=>$data->cargo))',
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
        'htmlOptions'=>array('class'=>'span12'),
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

<?php #echo $this->renderPartial('ticketModal'); ?>
