<h4>Booking</h4>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'booking-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'tkt_no',
		'tkt_serial',
		'booking_no',
		array(
                  'name'=>'voyage','value'=>'$data->voyage0->name',
                  'filter'=>CHtml::listData(Voyage::model()->findAll(),'id','name'),
                ),
		array(
                  'name'=>'seat','value'=>'isset($data->seat0->name) ? $data->seat0->name : "NO SEAT ASSIGNED"',
                  'filter'=>CHtml::listData(Seat::model()->findAll(),'id','name'),
                ),
		array(
                  'name'=>'status','value'=>'$data->status0->name',
                  'filter'=>CHtml::listData(BookingStatus::model()->findAll(),'id','name'),
                ),
array(
'class'=>'bootstrap.widgets.TbButtonColumn',
'template'=>'{update}',
),
),
)); ?>
