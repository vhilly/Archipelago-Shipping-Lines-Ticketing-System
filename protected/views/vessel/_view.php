<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('passenger_limit')); ?>:</b>
	<?php echo CHtml::encode($data->passenger_limit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('blocked_seats')); ?>:</b>
	<?php echo CHtml::encode($data->blocked_seats); ?>
	<br />


</div>