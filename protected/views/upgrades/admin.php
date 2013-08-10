
<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'upgrades-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		array('name'=>'voyage','filter'=>CHtml::listData(Voyage::model()->findAll(),'id','name'),'value'=>'$data->voyage0->name'),
		'amt',
array(
'class'=>'bootstrap.widgets.TbButtonColumn',
'template'=>'{update}',
),
),
)); ?>
<?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'inverse','buttonType'=>'link','icon'=>'plus','url'=>Yii::app()->createUrl('upgrades/create'),'label'=>'Record Seat Upgrade Payment'));
