<?php
$this->breadcrumbs=array(
	'Stowage Cargo Maps',
);

$this->menu=array(
array('label'=>'Create StowageCargoMap','url'=>array('create')),
array('label'=>'Manage StowageCargoMap','url'=>array('admin')),
);
?>

<h1>Stowage Cargo Maps</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
