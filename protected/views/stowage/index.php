<?php
$this->breadcrumbs=array(
	'Stowages',
);

$this->menu=array(
array('label'=>'Create Stowage','url'=>array('create')),
array('label'=>'Manage Stowage','url'=>array('admin')),
);
?>

<h1>Stowages</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
