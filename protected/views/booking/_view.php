<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('passenger')); ?>:</b>
	<?php echo CHtml::encode($data->passenger); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ticket')); ?>:</b>
	<?php echo CHtml::encode($data->ticket); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_booked')); ?>:</b>
	<?php echo CHtml::encode($data->date_booked); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('departure_date')); ?>:</b>
	<?php echo CHtml::encode($data->departure_date); ?>
	<br />


</div>