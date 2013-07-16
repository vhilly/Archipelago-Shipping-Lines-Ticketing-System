<style>
.modal-body {
    max-height:600px;
}
#ticketModal {
	width:850px;
}
.modal {
	margin-left:-430px;
}
</style>

<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'ticketModal')); ?>
  <div class="modal-header">
    <center><h2>SEAT MAP</h2></center>
  </div>
  <div class="modal-body">
    <div>body</div>
  </div>           
  <div class="modal-footer" style="display:none">
                   
    <?php $this->widget('bootstrap.widgets.TbButton', array(
      'label'=>'Close',
      'id'=>'stowageClose',
      'url'=>'#',      
      'htmlOptions'=>array('data-dismiss'=>'modal','class'=>'modalcss'),
    )); ?>             
  </div>                    
<?php $this->endWidget(); ?>
