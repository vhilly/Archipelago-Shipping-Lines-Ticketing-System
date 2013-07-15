<?php
$this->breadcrumbs=array(
	'Vessels'=>array('index'),
	'Manage',
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('vessel-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Vessels</h1>
<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'vessel-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'name',
		'description',
		'passenger_limit',
array(
'class'=>'bootstrap.widgets.TbButtonColumn',
),
),
)); 

?>
<?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'inverse','buttonType'=>'link','icon'=>'plus','url'=>Yii::app()->createUrl('vessel/create'),'label'=>'Add Vessel'));
