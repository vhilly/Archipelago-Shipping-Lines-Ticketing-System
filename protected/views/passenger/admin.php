<?php
$this->breadcrumbs=array(
	'Passengers'=>array('index'),
	'Manage',
);

$this->menu=array(
array('label'=>'List Passenger','url'=>array('index')),
array('label'=>'Create Passenger','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('passenger-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Manage Passengers</h1>

<p>
	You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
		&lt;&gt;</b>
	or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'passenger-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'id',
		'first_name',
		'last_name',
		'email',
		'contact',
		'middle_name',
		/*
		'prefix',
		'gender',
		'civil_status',
		'nationality',
		'address',
		'birth_date',
		*/
array(
'class'=>'bootstrap.widgets.TbButtonColumn',
),
),
)); ?>
