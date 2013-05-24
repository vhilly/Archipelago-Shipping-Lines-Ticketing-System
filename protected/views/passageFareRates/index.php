<?php
  $this->breadcrumbs=array(
	'Passage Fare Rates',
  );

  $this->menu=array(
	array('label'=>'Create Passage Fare Rates','url'=>array('create')),
	array('label'=>'Manage Passage Fare Rates','url'=>array('admin')),
  );

  $gridDataProvider = new CArrayDataProvider($dataProvider);

?>
<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'dataProvider'=>$gridDataProvider,
    'template'=>"{items}\n{pager}",
    'columns'=>array(
        array('name'=>'type', 'header'=>'Type'),
        array('name'=>'class', 'header'=>'Class'),
        array('name'=>'price', 'header'=>'Price'),
    ),
)); ?>
