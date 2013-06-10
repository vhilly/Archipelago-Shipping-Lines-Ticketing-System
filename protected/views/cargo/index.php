<?php
$this->breadcrumbs=array(
	'Cargos',
);

$this->menu=array(
array('label'=>'Create Cargo','url'=>array('create')),
array('label'=>'Manage Cargo','url'=>array('admin')),
);
?>

<h1>Cargos</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
