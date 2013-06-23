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
    <?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Sidebar',
    'headerIcon' => 'icon-th-list',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
    'htmlOptions' => array('class'=>'bootstrap-widget-table')
    ));?>
		<form class="well-small">
    <div class="input-append">
		<select name="selection" id="selection" class="span4">
			<option></option>
			<option value="ticket">Ticket Number</option>
			<option value="booking">Transaction Number</option>
		</select>
    <input class="span5" id="search" name="search" type="text">
		 <button class="btn btn-primary" id="btnSearch" type="button"><i class="icon-search"></i> Search</button>
	</div>
		</form>
    <?php $this->endWidget();?>
        </div><!-- sidebar -->
    </div>
</div>
<?php $this->endContent(); ?>

<?php echo $this->renderPartial('sidebar');?>
