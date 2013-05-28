<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('payment_method')); ?>:</b>
	<?php echo CHtml::encode($data->payment_method); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('payment_status')); ?>:</b>
	<?php echo CHtml::encode($data->payment_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('uid')); ?>:</b>
	<?php echo CHtml::encode($data->uid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('trans_date')); ?>:</b>
	<?php echo CHtml::encode($data->trans_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('input_date')); ?>:</b>
	<?php echo CHtml::encode($data->input_date); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('ovamount')); ?>:</b>
	<?php echo CHtml::encode($data->ovamount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ovdiscount')); ?>:</b>
	<?php echo CHtml::encode($data->ovdiscount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reference')); ?>:</b>
	<?php echo CHtml::encode($data->reference); ?>
	<br />

	*/ ?>

</div>