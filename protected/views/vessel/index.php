<?php
$this->breadcrumbs=array(
	'Vessels',
);

$this->menu=array(
	array('label'=>'Create Vessel','url'=>array('create')),
	array('label'=>'Manage Vessel','url'=>array('admin')),
);
?>

<h1>Vessels</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
