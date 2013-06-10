<?php
$this->breadcrumbs=array(
	'Tickets',
);

$this->menu=array(
array('label'=>'Create Ticket','url'=>array('create')),
array('label'=>'Manage Ticket','url'=>array('admin')),
);
?>

<h1>Tickets</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
