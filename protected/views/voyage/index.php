<?php

  
    $gridColumns = array(
      'name',
      array('header'=>'From','value'=>'$data->route0->from_port'),
      array('header'=>'To','value'=>'$data->route0->to_port'),
      'departure_date',
      array('name'=>'departure_time','value'=>'date("g:i A",strtotime($data->departure_time))'),
      array('name'=>'arrival_time','value'=>'date("g:i A",strtotime($data->arrival_time))'),
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
