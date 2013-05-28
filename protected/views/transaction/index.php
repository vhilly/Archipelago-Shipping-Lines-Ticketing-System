<?php
$this->breadcrumbs=array(
	'Transactions',
);

?>

<h1>Transactions</h1>

<?php

$gridColumns = array(
                array(
			'name' => 'input_date',
                        'filter'=>$this->widget('bootstrap.widgets.TbDatePicker', array(
                          'model'=>$model,
                          'options'=>array('format'=>'yyyy-mm-dd'),
                          'htmlOptions' => array(
                            'id' => 'Transaction_input_date'
                          ),
                         'attribute'=>'input_date'), 
                        true),
			'sortable'=>true,
                ),
                array(
			'name' => 'trans_date',
                        'filter'=>$this->widget('bootstrap.widgets.TbDatePicker', array(
                          'model'=>$model,
                          'options'=>array('format'=>'yyyy-mm-dd'),
                          'htmlOptions' => array(
                            'id' => 'Transaction_trans_date'
                          ),
                         'attribute'=>'trans_date'), 
                        true),
			'sortable'=>true,
                ),
                'ovamount',
                'ovdiscount',
                array('header'=>'Total Amount','value'=>''),
                'reference',
);
  $this->widget('bootstrap.widgets.TbGridView', array(
	'type' => 'striped bordered',
	'dataProvider' => $model->search(),
	'template' => "{items},{pager}",
        'filter'=>$model,
     //   'ajaxUpdate'=>false,
        'afterAjaxUpdate'=>"function() {
          jQuery('#Transaction_trans_date').datepicker({'format':'yyyy-mm-dd','language':'en','weekStart':0});
          jQuery('#Transaction_input_date').datepicker({'format':'yyyy-mm-dd','language':'en','weekStart':0});
        }",
	//'columns' => array(
	//	'date_booked',
        //)
        'columns'=>$gridColumns
));
?>

