<h1>Shippers</h1>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'shipper-grid',
'dataProvider'=>$shipper->search(),
'filter'=>$shipper,
'columns'=>array(
  'name',
  array(
    'class'=>'bootstrap.widgets.TbButtonColumn',
    'template'=>'{update}',
    'buttons'=>array(            
            'update' => array(
              'url'=>'Yii::app()->createUrl("customer/authorized",array("AuthorizedCustShipper[company]"=>"$data->id"))',
            ),
          ),
  )
)
)); ?>
<?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'inverse','buttonType'=>'link','icon'=>'plus','url'=>Yii::app()->createUrl('customer/createShipper',array('cid'=>$shipper->company)),'label'=>'Add Shipper'));?>
&nbsp;
<?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'info','buttonType'=>'link','icon'=>'','url'=>Yii::app()->createUrl("customer/admin"),'label'=>'Back'));?>
<h1>Vehicles</h1>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'vehicle-grid',
'dataProvider'=>$vehicle->search(),
'filter'=>$vehicle,
'columns'=>array(
  'plate_no',
  array(
    'name'=>'classification',
    'filter'=>CHtml::listData(CargoClass::model()->findAll(),'id','name'),
    'value'=>'$data->classification0->name',
  ),
  array(
    'class'=>'bootstrap.widgets.TbButtonColumn',
    'template'=>'{update}',
    'buttons'=>array(            
            'update' => array(
              'url'=>'Yii::app()->createUrl("customer/authorized",array("AuthorizedCustVehicle[company]"=>"$data->id"))',
            ),
          ),
  )
)
)); ?>
<?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'inverse','buttonType'=>'link','icon'=>'plus','url'=>Yii::app()->createUrl('customer/createVehicle',array('cid'=>$vehicle->company)),'label'=>'Add Vehicle'));?>
&nbsp;
<?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'info','buttonType'=>'link','icon'=>'','url'=>Yii::app()->createUrl("customer/admin"),'label'=>'Back'));?>
