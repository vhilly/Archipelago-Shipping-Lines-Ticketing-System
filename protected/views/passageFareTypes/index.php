<?php
$this->breadcrumbs=array(
	'Passage Fare Types',
);

$this->menu=array(
array('label'=>'Create PassageFareTypes','url'=>array('create')),
array('label'=>'Manage PassageFareTypes','url'=>array('admin')),
);
?>

<h1>Passage Fare Types</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
