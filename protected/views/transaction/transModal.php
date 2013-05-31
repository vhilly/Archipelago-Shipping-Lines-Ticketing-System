<style>

  #transModal{
    width:1000px;
    
  }
</style>


<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'transModal')); ?>
  <div class="modal-header">
    <h4>Transaction Details</h4>
  </div>
  <div class="modal-body">
    <p>Transaction Details</p>
  </div>
  <div class="modal-footer">

    <?php $this->widget('bootstrap.widgets.TbButton', array(
      'label'=>'Close',
      'url'=>'#',
      'htmlOptions'=>array('data-dismiss'=>'modal'),
    )); ?>
  </div>
<?php $this->endWidget(); ?>
