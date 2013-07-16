<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('customer-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Customers</h1>


<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'customer-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'company',
		'contact_person',
		'contact_no',
		'address',
array(
'class'=>'bootstrap.widgets.TbButtonColumn',
'template'=>'{update} {authorized}',
'buttons'=>array(            
            'authorized' => array(
              'label'=>'Authorized Shipper/Vehicle',
              'url'=>'Yii::app()->createUrl("customer/authorized",array("AuthorizedCustShipper[company]"=>"$data->id","AuthorizedCustVehicle[company]"=>"$data->id"))',
            ),
          ),
),
),
)); ?>
<?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'inverse','buttonType'=>'link','icon'=>'plus','url'=>Yii::app()->createUrl('customer/create'),'label'=>'Add Customer'));
