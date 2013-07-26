<?php

  
    $gridColumns = array(
      'name',
      array('header'=>'From','value'=>'$data->route0->from'),
      array('header'=>'To','value'=>'$data->route0->to'),
      'departure_date',
      'departure_time',
      'arrival_time',
      array('name'=>'status','value'=>'$data->status0->name'),
      array(
        'class'=>'bootstrap.widgets.TbButtonColumn',
        'template'=>'{view} {update}',
        'buttons'=>array(            
          'update' => array(
          'label'=>'',
              'url'=>'Yii::app()->createUrl("voyage/status",array("id"=>"$data->id"))',
          ),
        ),
      )
     );
    $this->widget('bootstrap.widgets.TbGridView', array(
      'dataProvider'=>$dataProvider,
      'template'=>"{items}",
      'columns'=>$gridColumns,
    ));
/*

    $this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'striped bordered',
    'dataProvider' => $dataProvider,
    'template' => "{items}{pager}",
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

*/
?>
