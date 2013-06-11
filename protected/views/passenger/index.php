<?php
  $this->breadcrumbs=array(
    'Booked Tickets',
  );

?>


<?php

  $voy = CHtml::listData(Voyage::model()->findAll(array('condition'=>'departure_date BETWEEN CURDATE() AND CURDATE() + INTERVAL 1 DAY')),'id','name');
  $gridColumns = array(
    array(
      'name' => 'birth_date',
      'filter'=>$this->widget('bootstrap.widgets.TbDatePicker', array(
          'model'=>$model,
          'options'=>array('format'=>'yyyy-mm-dd'),
          'htmlOptions' => array(
            'id' => 'Passenger_birth_date'
          ),
          'attribute'=>'birth_date'),
        true),
      'sortable'=>true,
    ),
    array(
      'header'=>'Voyage',
       'value'=>'$data->bookings[\'tkt_no\']',
    ),
    array(
      'class' => 'bootstrap.widgets.TbEditableColumn',
      'sortable'=>true,
      'name'=>'first_name',
      'editable' => array(
        'type'      => 'text',
        'url' => $this->createUrl('passenger/editableSaver'),
        'inputclass' => 'span2'
      ),
    ),
    array(
      'class' => 'bootstrap.widgets.TbEditableColumn',
      'sortable'=>true,
      'name'=>'last_name',
      'editable' => array(
        'type'      => 'text',
        'url' => $this->createUrl('passenger/editableSaver'),
        'inputclass' => 'span2'
      ),
    ),
    array(
      'class' => 'bootstrap.widgets.TbEditableColumn',
      'name' => 'middle_name',
      'sortable'=>true,
      'editable' => array(
        'type'      => 'text',
        'url' => $this->createUrl('passenger/editableSaver'),
        'inputclass' => 'span2'
      ),
    ),
  );
  $this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'striped bordered',
    'dataProvider' => $model->search(),
    'template' => "{items},{pager}",
    'htmlOptions'=>array('class'=>'span5'),
    'filter'=>$model,
    //   'ajaxUpdate'=>false,
    'afterAjaxUpdate'=>"function() {
          jQuery('#Passenger_birth_date').datepicker({'format':'yyyy-mm-dd','language':'en','weekStart':0});
        }",
    //'columns' => array(
    //	'date_booked',
    //)
    'columns'=>$gridColumns
  ));

?>

