<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('voyage')); ?>:</b>
	<?php echo CHtml::encode($data->voyage); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('amt')); ?>:</b>
	<?php echo CHtml::encode($data->amt); ?>
	<br />


</div>