Select Shipper:<br>
<?php
 echo   CHtml::dropDownList('shippers','',CHtml::listData(AuthorizedCustShipper::model()->findAllByAttributes(array('company'=>$model->id)),'name','name'),array('id'=>'shipper'));
?><br>
Select Plate No:<br>
<?php
 echo   CHtml::dropDownList('plate_no','',CHtml::listData(AuthorizedCustVehicle::model()->findAllByAttributes(array('company'=>$model->id)),'classification','plate_no'),array('id'=>'plate_no'));
?><br>
<div style='display:none'>
<?php echo   CHtml::textField('address',$model->address,array('id'=>'address','disabled'=>true));?>
<?php echo   CHtml::textField('company',$model->company,array('id'=>'company','disabled'=>true));?>
</div>
