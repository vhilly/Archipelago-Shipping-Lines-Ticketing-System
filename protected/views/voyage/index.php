<?php
$this->breadcrumbs=array(
	'Voyages',
);

$this->menu=array(
	array('label'=>'Create Voyage','url'=>array('create')),
	array('label'=>'Manage Voyage','url'=>array('admin')),
);
?>

<h1>Voyages</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
