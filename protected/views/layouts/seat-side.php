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
           'type'=>'inverse', // 'success', 'warning', 'important', 'info' or 'inverse'
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

        </div><!-- sidebar -->
    </div>
</div>
<?php $this->endContent(); ?>

