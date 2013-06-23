<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="row-fluid">
    <div class="span9">
        <div id="content">
            <?php echo $content; ?>
        </div><!-- content -->
    </div>
    <div class="span3">
        <div id="sidebar">
	 <?php $this->widget('bootstrap.widgets.TbLabel', array(
           'type'=>'default', // 'success', 'warning', 'important', 'info' or 'inverse'
           'label'=>'Available',
         )); ?>          
	 <?php $this->widget('bootstrap.widgets.TbLabel', array(
           'type'=>'warning', // 'success', 'warning', 'important', 'info' or 'inverse'
           'label'=>'Reserved',
         )); ?>          
	 <?php $this->widget('bootstrap.widgets.TbLabel', array(
           'type'=>'info', // 'success', 'warning', 'important', 'info' or 'inverse'
           'label'=>'Paid',
         )); ?>          
	 <?php $this->widget('bootstrap.widgets.TbLabel', array(
           'type'=>'success', // 'success', 'warning', 'important', 'info' or 'inverse'
           'label'=>'Checked-In',
         )); ?>          
	 <?php $this->widget('bootstrap.widgets.TbLabel', array(
           'type'=>'important', // 'success', 'warning', 'important', 'info' or 'inverse'
           'label'=>'Canceled',
         )); ?>          


         <div id=bookingForm style=display:none>
        <h1 id=selectedSeat></h1>
        <?php $model = new Booking?>
        <?php  $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'booking',
	        'action'=>Yii::app()->createUrl('seat/index'),
	        'method'=>'get',
		'type'=>'vertical',
	)); ?>
         <?php echo $form->hiddenField($model, 'id'); ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Make Seat Available', 'htmlOptions'=>array('onclick'=>'return confirm("Are you sure?");'))); ?>
        <?php $this->endWidget(); ?>
 
         </div>
        </div><!-- sidebar -->
    </div>
</div>


<?php $this->endContent(); ?>
