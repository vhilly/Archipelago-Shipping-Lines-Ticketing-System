<?php
$this->breadcrumbs=array(
	'Cargo Classes',
);

$this->menu=array(
array('label'=>'Create CargoClass','url'=>array('create')),
array('label'=>'Manage CargoClass','url'=>array('admin')),
);
?>

<h1>Cargo Classes</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
