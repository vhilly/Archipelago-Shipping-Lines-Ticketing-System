
<?php
  $this->breadcrumbs=array(
	'Passage Fare Rates',
  );

  $this->menu=array(
	array('label'=>'Create Passage Fare Rates','url'=>array('create')),
	array('label'=>'Manage Passage Fare Rates','url'=>array('admin')),
  );

  $dataProvider=Voyage::model()->findAll();
  $gridDataProvider = new CArrayDataProvider($dataProvider);

?>
<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped condensed',
    'dataProvider'=>$gridDataProvider,
    'template'=>"{items}\n{pager}",
    'columns'=>array(
        array('name'=>'name', 'header'=>'Name'),
        array('name'=>'vessel', 'header'=>'Vessel'),
        array('name'=>'route', 'header'=>'Route'),
        array('name'=>'departure_time', 'header'=>'Departure Time'),
        array('name'=>'arrival_time', 'header'=>'Arrival Time'),
    ),
    'htmlOptions'=>array('class'=>'grid-view tbcenter'),
)); ?>
