<?php
/* @var $this CargoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cargos',
);

$this->menu=array(
	array('label'=>'Create Cargo', 'url'=>array('create')),
	array('label'=>'Manage Cargo', 'url'=>array('admin')),
);
?>

<h1>Cargos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
