<?php if(isset($tkts) && count($tkts)):?>
  <table border=1>
  <?php foreach($tkts as $t):?>
    <tr>
      <td><?=$t->tkt_no?></td>
      <td><?=$t->class?></td>
      <td><?=$t->type?></td>
      <td><?=$t->date_created?></td>
    </tr>
  <?php endforeach;?>
  </table>
<script>
  window.print();
  window.close();
  document.location.href='<?=Yii::app()->createUrl('AdvanceTicket/create')?>';
</script>
<?php else:?>
  <h1>Create Advance Ticket</h1>
  <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php endif;?>
