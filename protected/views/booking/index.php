<?php
  $this->breadcrumbs=array(
    'Bookings',
  );

  $this->menu=array(
    array('label'=>'Create Booking','url'=>array('create')),
    array('label'=>'Manage Booking','url'=>array('admin')),
  );
?>

<h1>Bookings</h1>

<?php

$gridColumns = array(
		array(
			'class' => 'bootstrap.widgets.TbEditableColumn',
			'name' => 'departure_date',
			'sortable'=>true,
			'editable' => array(
                                'viewformat'  => 'dd-mm-yyyy',
				'url' => $this->createUrl('booking/editableSaver'),
				'placement' => 'right',
				'inputclass' => 'span3'
			)
		),
		array(
			'class' => 'bootstrap.widgets.TbEditableColumn',
			'name' => 'status',
			'sortable'=>true,
			'editable' => array(
                                'type'      => 'select',
				'url' => $this->createUrl('booking/editableSaver'),
                                'attribute' => 'dropDown',
                                 'source'    => CHtml::listData(BookingStatus::model()->findAll(),'id','name'),
				'placement' => 'right',
				'inputclass' => 'span3'

			),
		),
		array(
			'name' => 'passenger0.first_name',
                        'value' => '$data->passenger0->first_name',
               )
);
$this->widget('bootstrap.widgets.TbGridView', array(
	'type' => 'striped bordered',
	'dataProvider' => $model->search(),
	'template' => "{items},{pager}",
        'filter'=>$model,
	//'columns' => array(
	//	'date_booked',
        //)
        'columns'=>$gridColumns
));
?>

