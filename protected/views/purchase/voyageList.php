
<?php
  $this->breadcrumbs=array(
	'Passage Fare Rates',
  );

  $this->menu=array(
	array('label'=>'Create Passage Fare Rates','url'=>array('create')),
	array('label'=>'Manage Passage Fare Rates','url'=>array('admin')),
  );

  $dataProvider=Voyage::model()->findAll(array('condition'=>'status !=3','order'=>'departure_date'));
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
        array('name'=>'departure_time', 'header'=>'Departure Time','value'=>'date("H:i A",strtotime($data->departure_time))'),
        array('name'=>'arrival_time', 'header'=>'Arrival Time','value'=>'date("H:i A",strtotime($data->arrival_time))'),
    ),
    'htmlOptions'=>array('class'=>'grid-view tbcenter'),
)); ?>
