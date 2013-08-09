<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
  'id'=>'searchForm',
  'type'=>'search',
  'htmlOptions'=>array('class'=>'well'),
)); ?>
SEARCH BOOKING TO TRANSFER<br>
<?php
  echo $form->textFieldRow($model, 'tkt_no',
  array('class'=>'input-medium', 'prepend'=>'<i class="icon-search"></i>','id'=>'booking_no'));
?>
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Go')); ?>
 
<?php $this->endWidget(); ?>



<?php if($forTransfer):?>
    <?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => '',
    'headerIcon' => 'icon-th-list',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
    'htmlOptions' => array('class'=>'bootstrap-widget-table')
    ));?>
    <table class="table striped">
    <thead>
      <tr>
        <th>Ticket No.</th>
        <th>First name</th>
        <th>Last name</th>
        <th>Voyage</th>
        <th>Route</th>
        <th>Vessel</th>
        <th>Seat</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?=$forTransfer->tkt_no?></td>
        <td><?=$forTransfer->passenger0->first_name?></td>
        <td><?=$forTransfer->passenger0->last_name?></td>
        <td><?=$forTransfer->voyage0->name?></td>
        <td><?=$forTransfer->voyage0->route0->name?></td>
        <td><?=$forTransfer->voyage0->vessel0->name?></td>
        <td><?=isset($forTransfer->seat0->name) ? $forTransfer->seat0->name : 'NO SEAT ASSIGNED'?></td>
        <td class=tlink id=<?=$forTransfer->id?>>Transfer<td>
      </tr>
    </tbody>
    </table>
    <?php $this->endWidget();?>
<?php endif;?>
<style>
  .tlink {
    color:#00B2EE;
    font-weight:bold;
  }   
  .tlink:hover {
    color:#FF0000;
    font-weight:bold;
    cursor:pointer;
  }   
.modal-body {
    max-height:600px;
}
#transferModal {
        width:850px;
}
.modal {
        margin-left:-430px;
}

</style>


<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id' => 'transferModal')); ?>
     
    <div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Modal header</h4>
    </div>
     
    <div class="modal-body">
    <p></p>
    </div>
     
     
    <?php $this->endWidget(); ?>

<script>
  $('.tlink').click(function(){
      $.ajax({
        type: 'GET',
        url: '<?php echo Yii::app()->baseUrl;?>?r=booking/transferForm&id='+this.id,
        success: function (data){
          $('#transferModal .modal-header h4').html('Booking Transfer');
          $('#transferModal .modal-body p').html(data);
        },
        error: function (xht){
          alert(this.url);
        }

      });
   // $('#transferModal .modal-body p').html('asa');
    $('#transferModal').modal()
  });
</script>

