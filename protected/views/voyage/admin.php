<?php
$this->breadcrumbs=array(
	'Voyages'=>array('index'),
	'Manage',
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('voyage-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Manage Voyages</h1>


<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'voyage-grid',
'dataProvider'=>$model->search(),
'afterAjaxUpdate'=>"function() {
  jQuery('#Voy_departure_date').datepicker({'format':'yyyy-mm-dd','language':'en','weekStart':0});
}",
'filter'=>$model,
'columns'=>array(
		array(
                  'name'=>'vessel',
                  'filter'=>CHtml::listData(Vessel::model()->findAll(),'id','name'),
                   'value'=>'$data->vessel0->name',
                ),
		array(
                  'name'=>'route',
                  'filter'=>CHtml::listData(Route::model()->findAll(),'id','name'),
                   'value'=>'$data->route0->from." - ".$data->route0->to',
                ),
                array(
			'name' => 'departure_date',
                        'filter'=>$this->widget('bootstrap.widgets.TbDatePicker', array(
                          'model'=>$model,
                          'options'=>array('format'=>'yyyy-mm-dd'),
                          'htmlOptions' => array(
                            'id' => 'Voy_departure_date'
                          ),
                         'attribute'=>'departure_date'), 
                        true),
			'sortable'=>true,
                ),
		/*
		'departure_date',
		'status',
		*/
array(
'class'=>'bootstrap.widgets.TbButtonColumn',
'template'=>'{update} {rates}',
'buttons'=>array(            
            'rates' => array(
              'label'=>'Rates',
              'url'=>'Yii::app()->createUrl("passageFareRates/rates",array("rid"=>"$data->route"))',
            ),
          ),
),
),
)); ?>
<?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'inverse','buttonType'=>'link','icon'=>'plus','url'=>Yii::app()->createUrl('voyage/create'),'label'=>'Add Voyage'));
