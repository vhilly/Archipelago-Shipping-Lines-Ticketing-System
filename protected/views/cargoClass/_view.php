<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('class')); ?>:</b>
	<?php echo CHtml::encode($data->class); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('desc')); ?>:</b>
	<?php echo CHtml::encode($data->desc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lane_meter')); ?>:</b>
	<?php echo CHtml::encode($data->lane_meter); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lane_meter_rate')); ?>:</b>
	<?php echo CHtml::encode($data->lane_meter_rate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('proposed_tariff')); ?>:</b>
	<?php echo CHtml::encode($data->proposed_tariff); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('as_of')); ?>:</b>
	<?php echo CHtml::encode($data->as_of); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('active')); ?>:</b>
	<?php echo CHtml::encode($data->active); ?>
	<br />

	*/ ?>

</div>