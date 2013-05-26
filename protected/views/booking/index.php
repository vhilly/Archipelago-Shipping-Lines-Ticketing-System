<?php
  $this->breadcrumbs=array(
    'Bookings',
  );

?>

<h1>Bookings</h1>

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
			'name' => 'departure_date',
                        'filter'=>$this->widget('bootstrap.widgets.TbDatePicker', array(
                          'model'=>$model,
                          'options'=>array('format'=>'yyyy-mm-dd'),
                          'htmlOptions' => array(
                            'id' => 'Booking_departure_date'
                          ),
                         'attribute'=>'departure_date'), 
                        true),
			'sortable'=>true,
			'editable' => array(
                                'viewformat'  => 'MM  d, yyyy',
				'url' => $this->createUrl('booking/editableSaver'),
				'placement' => 'right',
				'inputclass' => 'span3'
			)
		),
		array(
			'class' => 'bootstrap.widgets.TbEditableColumn',
			'name' => 'status',
                        'filter'=>CHtml::listData(BookingStatus::model()->findAll(),'id','name'),
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
                   'header'=>'Ticket Details',
                   'class' => 'bootstrap.widgets.TbButtonColumn',
                   'template'=>'{viewtkt}',
                   'buttons'=>array(
                     'viewtkt' => array(
                       'label'=>'view',
                       'icon'=>'plus',
                       'url'=>'Yii::app()->controller->createUrl("events/create", array("id"=>$data->id))', // Problem here on $data->id
                     ),
                    ),
                  )
);
$this->widget('bootstrap.widgets.TbGridView', array(
	'type' => 'striped bordered',
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

