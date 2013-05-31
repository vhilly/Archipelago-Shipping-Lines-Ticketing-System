<?php
/* @var $this CargoController */
/* @var $model Cargo */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'shipper'); ?>
		<?php echo $form->textField($model,'shipper',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'company'); ?>
		<?php echo $form->textField($model,'company',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'destination'); ?>
		<?php echo $form->textField($model,'destination',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'address'); ?>
		<?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cargo_class'); ?>
		<?php echo $form->textField($model,'cargo_class'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'article_no'); ?>
		<?php echo $form->textField($model,'article_no',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'article_desc'); ?>
		<?php echo $form->textArea($model,'article_desc',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'weight'); ?>
		<?php echo $form->textField($model,'weight'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'length'); ?>
		<?php echo $form->textField($model,'length'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'contact'); ?>
		<?php echo $form->textField($model,'contact',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'voyage'); ?>
		<?php echo $form->textField($model,'voyage'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->