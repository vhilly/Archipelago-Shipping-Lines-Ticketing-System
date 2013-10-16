
<div class=well>
    <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'=>'revenue-report',
        'method'=>'get',
        'type'=>'inline',
        'htmlOptions'=>array('class'=>''),
     )); ?>
        <?php echo $form->datePickerRow($data['rf'], 'departure_date', array('append'=>'<i class="icon-calendar" style="cursor:pointer"></i>','class'=>'span2','options'=>array( 'format' => 'yyyy-mm-dd')));
    $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Generate Report'));
    $this->endWidget();
    ?>
  <?php if(!$data['excel']):?>
  <?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'success','buttonType'=>'link','icon'=>'share',
  'url'=>Yii::app()->request->url.'&excel=1','label'=>'Export to Excel'));?>
  <br>
  <br>
  <?php endif;?>
<table class=table>
   <tr>
     <th>Kind of Receipt</th>
     <th colspan=3>INCLUSIVE TICKETS AND WAYBILL NUMBER</th>
     <th>Number Used</th>
     <th>Fare</th>
     <th>Total Amount</th>
   </tr>
   <?php foreach($data['output'] as $k=>$o):?>
   <tr>
     <th colspan=7 bgcolor=cyan><center> <?=$k?></center></th>
   </tr>
     <?php foreach($o as $v):?>
     <tr>
       <td><?=implode('</td><td>',$v)?></td>
     </tr>
     <?php endforeach;?>
     <th>Total per Voyage</th>
     <th colspan=5></th>
     <th><?=number_format($data['totalPerVoyage'][$k])?></th>
   <?php endforeach;?>
   <tr>
     <th>TOTAL</th>
     <th colspan=5></th>
     <th><?=number_format($data['total'])?></th>
   </tr>
</table>
</div>
  <?php if($data['excel']):?>
<?php
     $file ='TELLERS_AND_PURSERS_REPORT.xls';
      header('Pragma: public');
      header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");   
      header('Last-Modified: '.gmdate('D, d M Y H:i:s') . ' GMT');
      header('Cache-Control: no-store, no-cache, must-revalidate');
      header('Cache-Control: pre-check=0, post-check=0, max-age=0');
      header("Pragma: no-cache");
      header("Expires: 0");
      header('Content-Transfer-Encoding: none');
      header("Content-type: application/vnd.ms-excel");
      header("Content-Disposition: attachment; filename=$file");
?>
  <?php endif;?>
</div>
