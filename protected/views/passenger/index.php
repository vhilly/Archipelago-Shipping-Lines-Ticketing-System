<?php
$this->breadcrumbs=array(
	'Passengers',
);

$this->menu=array(
array('label'=>'Create Passenger','url'=>array('create')),
array('label'=>'Manage Passenger','url'=>array('admin')),
);
?>

<h1>Passengers</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
