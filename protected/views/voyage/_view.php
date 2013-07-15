<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vessel')); ?>:</b>
	<?php echo CHtml::encode($data->vessel); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('route')); ?>:</b>
	<?php echo CHtml::encode($data->route); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('departure_time')); ?>:</b>
	<?php echo CHtml::encode($data->departure_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('arrival_time')); ?>:</b>
	<?php echo CHtml::encode($data->arrival_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('departure_date')); ?>:</b>
	<?php echo CHtml::encode($data->departure_date); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	*/ ?>

</div>