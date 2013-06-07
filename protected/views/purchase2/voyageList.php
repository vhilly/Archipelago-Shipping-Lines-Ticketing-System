
<?php
  $this->breadcrumbs=array(
	'Passage Fare Rates',
  );

  $this->menu=array(
	array('label'=>'Create Passage Fare Rates','url'=>array('create')),
	array('label'=>'Manage Passage Fare Rates','url'=>array('admin')),
  );

  $dataProvider=Voyage::model()->findAll(array('condition'=>'departure_date BETWEEN CURDATE() AND CURDATE() + INTERVAL 1 DAY','order'=>'departure_date'));
  $gridDataProvider = new CArrayDataProvider($dataProvider);

?>
<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped condensed',
    'dataProvider'=>$gridDataProvider,
    'template'=>"{items}\n{pager}",
    'columns'=>array(
        array('name'=>'name', 'header'=>'Name'),
        array('value'=>'$data->vessel0->name', 'header'=>'Vessel'),
        array('value'=>'$data->route0->name', 'header'=>'Route'),
        array('name'=>'departure_date', 'header'=>'Departure Date'),
        array('name'=>'departure_time', 'header'=>'Departure Time'),
        array('name'=>'arrival_time', 'header'=>'Arrival Time'),
    ),
    'htmlOptions'=>array('class'=>'grid-view tbcenter'),
)); ?>
