<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tkt_no')); ?>:</b>
	<?php echo CHtml::encode($data->tkt_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('booking_no')); ?>:</b>
	<?php echo CHtml::encode($data->booking_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('transaction')); ?>:</b>
	<?php echo CHtml::encode($data->transaction); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('passenger')); ?>:</b>
	<?php echo CHtml::encode($data->passenger); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('voyage')); ?>:</b>
	<?php echo CHtml::encode($data->voyage); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('seat')); ?>:</b>
	<?php echo CHtml::encode($data->seat); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_booked')); ?>:</b>
	<?php echo CHtml::encode($data->date_booked); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rate')); ?>:</b>
	<?php echo CHtml::encode($data->rate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	*/ ?>

</div>