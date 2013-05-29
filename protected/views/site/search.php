<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'ticketModal')); ?>
  <div class="modal-header">
    <h4>Ticket Details</h4>
  </div>         
  <div class="modal-body">
    <p>Ticket Details</p>
  </div>           
  <div class="modal-footer">
                   
    <?php $this->widget('bootstrap.widgets.TbButton', array(
      'label'=>'Close',
      'url'=>'#',      
      'htmlOptions'=>array('data-dismiss'=>'modal'),
    )); ?>             
  </div>                    
<?php $this->endWidget(); ?>    
