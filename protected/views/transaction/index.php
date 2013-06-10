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
                array(
			'name' => 'payment_method',
                        'filter'=>CHtml::listData(PaymentMethod::model()->findAll(),'id','name'),
                        'value'=>'$data->paymentMethod->name',
			'sortable'=>true,
                ),
                array(
			'name' => 'payment_status',
                        'filter'=>CHtml::listData(PaymentStatus::model()->findAll(),'id','name'),
                        'value'=>'$data->paymentStatus->name',
			'sortable'=>true,
                ),
                array(
			'name' => 'id',
			'sortable'=>true,
			'value'=>' str_pad($data->id,11,"0",STR_PAD_LEFT)',
                ),
                'ovamount',
                'ovdiscount',
                array('header'=>'Total Amount','value'=>'$data->ovamount-$data->ovdiscount'),
                 array(
                   'header'=>'Transaction Details',
                   'class' => 'bootstrap.widgets.TbButtonColumn',
                   'template'=>'{viewtkt}',
                   'buttons'=>array(
                     'viewtkt' => array(
                       'label'=>'view',
                       'icon'=>'plus',
                       'url'=>'Yii::app()->controller->createUrl("transaction/view", array("id"=>$data->id))',
                       'options'=>array(
                            'ajax'=>array(
                                'type'=>'POST',
                                'url'=>"js:$(this).attr('href')",
                                'success'=>'function(data) { $("#transModal .modal-body p").html(data); $("#transModal").modal(); }'
                            ),
                        ),
                     ),
                    ),
                  ),
);
  $this->widget('bootstrap.widgets.TbGridView', array(
	'type' => 'striped bordered',
	'dataProvider' => $model->search(),
	'template' => "{items},{pager}",
        'htmlOptions'=>array('class'=>'span'),
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
<?php $this->renderPartial('transModal')?>
