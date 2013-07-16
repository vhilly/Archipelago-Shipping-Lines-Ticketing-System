<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('cargo-class-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Cargo Classes</h1>
<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'cargo-class-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'name',
		'description',
		'lane_meter',
		'bundled_passenger',
array(
'class'=>'bootstrap.widgets.TbButtonColumn',
'template'=>'{update}',
),
),
)); ?>
<?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'inverse','buttonType'=>'link','icon'=>'plus','url'=>Yii::app()->createUrl('cargoClass/create'),'label'=>'Add Cargo Class'));
