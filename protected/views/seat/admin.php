<?php
$this->breadcrumbs=array(
	'Seats'=>array('index'),
	'Manage',
);
/*
$this->menu=array(
	array('label'=>'List Seat','url'=>array('index')),
	array('label'=>'Create Seat','url'=>array('create')),
);
*/
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('seat-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Seats</h1>
<!--
<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>
-->
<?php #echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'seat-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
//		'id',
                array(
                        'class' => 'bootstrap.widgets.TbEditableColumn',
                        'name' => 'seating_class',
                        'filter'=>CHtml::listData(SeatingClass::model()->findAll(),'id','name'),
                        'sortable'=>true,
                        'editable' => array(
                                'type'      => 'select',
                                'url' => $this->createUrl('seatingClass/editableSaver'),
                                'attribute' => 'dropDown',
                                 'source'    => CHtml::listData(SeatingClass::model()->findAll(),'id','name'),
                                'placement' => 'right',
                                'inputclass' => 'span2'

                        ),
                ),

		'name',
//		'active',
		array(
                        'class' => 'bootstrap.widgets.TbEditableColumn',
                        'name' => 'active',
			'filter' => array('Y'=>'Yes','N'=>'No'),
                        'sortable'=>true,
                        'editable' => array(
                                'type'      => 'select',
                                 'url' => $this->createUrl('seat/editableSaver'),
                                'attribute' => 'dropDown',
                                 'source'    => array('Y'=>'Yes','N'=>'No'),
                                'placement' => 'right',
                                'inputclass' => 'span2'

                        ),
                ),


/*		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),*/
	),
)); ?>
