<?php
$this->breadcrumbs=array(
	'Seating Classes',
);

$this->menu=array(
	array('label'=>'Create SeatingClass','url'=>array('create')),
	array('label'=>'Manage SeatingClass','url'=>array('admin')),
);
?>

<h1>Seating Classes</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
