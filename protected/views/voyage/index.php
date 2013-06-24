<?php


    $this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'striped bordered',
    'dataProvider' => $dataProvider,
    'template' => "{items}",
    'columns' => array(
      'name',
      array('name'=>'route','value'=>'$data->route0->name'),
      array(
        'class' => 'bootstrap.widgets.TbEditableColumn',
      'header' =>'Reservation',
      'name' => 'status',
      'sortable'=>false,
      'editable' => array(
        'type'=>'select',
        'attribute'=>'dropdown',
        'url' => $this->createUrl('voyage/editableSaver'),
        'source'    => CHtml::listData(VoyageStatus::model()->findAll(),'id','name'),
        'placement' => 'right',
        'inputclass' => 'span3'
      )
    )),
    ));
?>
