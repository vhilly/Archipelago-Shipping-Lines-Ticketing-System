<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('navigation_title')); ?>:</b>
	<?php echo CHtml::encode($data->navigation_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('passenger')); ?>:</b>
	<?php echo CHtml::encode($data->passenger); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cargo')); ?>:</b>
	<?php echo CHtml::encode($data->cargo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('discount')); ?>:</b>
	<?php echo CHtml::encode($data->discount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('discount_percent')); ?>:</b>
	<?php echo CHtml::encode($data->discount_percent); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('free_passenger')); ?>:</b>
	<?php echo CHtml::encode($data->free_passenger); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('minimum_passenger')); ?>:</b>
	<?php echo CHtml::encode($data->minimum_passenger); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('maximum_passenger')); ?>:</b>
	<?php echo CHtml::encode($data->maximum_passenger); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('free_cargo')); ?>:</b>
	<?php echo CHtml::encode($data->free_cargo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('minimum_cargo')); ?>:</b>
	<?php echo CHtml::encode($data->minimum_cargo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('active')); ?>:</b>
	<?php echo CHtml::encode($data->active); ?>
	<br />

	*/ ?>

</div>