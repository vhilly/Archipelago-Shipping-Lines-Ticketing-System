<?php
$this->breadcrumbs=array(
	'Upgrades',
);

$this->menu=array(
array('label'=>'Create Upgrades','url'=>array('create')),
array('label'=>'Manage Upgrades','url'=>array('admin')),
);
?>

<h1>Upgrades</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
