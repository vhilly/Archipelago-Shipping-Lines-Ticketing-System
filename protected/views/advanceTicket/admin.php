
<h1>Advance Tickets</h1>


<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'advance-ticket-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
//		'id',
		'tkt_no',
//		'seat',
		'class',
		'type',
		'first_name',
		'last_name',
		'age',
		'date_created',
		'validity_date',
array(
'class'=>'bootstrap.widgets.TbButtonColumn',
),
),
)); ?>
<?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'inverse','buttonType'=>'link','icon'=>'plus','url'=>Yii::app()->createUrl('advanceTicket/create'),'label'=>'Create Advance Ticket'));
