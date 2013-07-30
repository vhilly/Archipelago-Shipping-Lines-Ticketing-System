<?php
$this->breadcrumbs=array(
	'Booking Nos'=>array('index'),
	'Manage',
);

$this->menu=array(
//array('label'=>'List BookingNo','url'=>array('index')),
//array('label'=>'Create BookingNo','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('booking-no-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Manage Booking Nos</h1>

<p>
	You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
		&lt;&gt;</b>
	or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'booking-no-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		//'id',
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
		//'date_booked',
		'tkt_no',
		'booking_no',
		'transaction',
		
		
		array(
			'name'=>'last_name',
			'value'=>'$data->passenger0->last_name',
		),

		array(
			'name'=>'first_name',

			'value'=>'$data->passenger0->first_name',
		),
		array(
			'name'=>'voyage',
			'value'=>'$data->voyage0->name',
		),
		
		/*
		'seat',
		'status',
		'date_booked',
		'rate',
		'type',
		*/
		array(
		'class'=>'CButtonColumn',
		'template'=>'{update}',
		),
/*array(
'class'=>'bootstrap.widgets.TbButtonColumn',

),*/
),
)); ?>
