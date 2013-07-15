<?php
$this->breadcrumbs=array(
	'Passage Fare Rates',
);

$this->menu=array(
array('label'=>'Create PassageFareRates','url'=>array('create')),
array('label'=>'Manage PassageFareRates','url'=>array('admin')),
);
?>

<h1>Passage Fare Rates</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
