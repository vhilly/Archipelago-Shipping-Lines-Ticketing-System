<?php
  $this->breadcrumbs=array(
    'Waybills',
  );
?>


<?php $this->renderPartial('_searchform',array('model'=>$model),false,false)?>
<?php if(!$is_empty):?>


  <?php foreach($wayBillView as $wbView):

    $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    //  'title' => 'Waybill No. '.str_pad($wbView['wbno'],11,'0',STR_PAD_LEFT),
      'headerIcon' => 'icon-th-list',
      'htmlOptions' => array('class'=>'bootstrap-widget-table span10')
    ));
    ?>

    <table class="table span10">
      <tr class="odd">
        <td colspan=4>BILL OF LADING NO : <?=$wbView['wbNo'] ? $wbView['wbNo'] : 'N/A'?></td>
        <td colspan=4>BOOKING NO : <?=$wbView['bkNo'] ? $wbView['bkNo'] : 'N/A'?></td>
      </tr>
      <tr class="even">
        <td colspan=4>Shipper/Consignee : <?=$wbView['shipper'] ? $wbView['shipper'] : 'N/A'?></td>
        <td colspan=4>Carrier/Vessel/Ferry Name : <?=$wbView['vname'] ? $wbView['vname'] : 'N/A'?></td>
      </tr>
      <tr>
        <td rowspan=2 colspan=4>Adress : <?=$wbView['address'] ? $wbView['address'] : 'N/A'?></td>
        <td colspan=4>Port of Loading : <?=$wbView['loading'] ? $wbView['loading'] : 'N/A'?></td>
      </tr>
      <tr>
        <td>Port of Discharge: <?=$wbView['discharge'] ? $wbView['discharge'] : 'N/A'?></td>
      </tr>
    </table>
   <table class="table span10">
      <tr>
        <td>Class :</td>
        <td>No. Article :</td>
        <td>Article Description:</td>
        <td>Weight :</td>
        <td>Measurement :</td>
        <td>Rate :</td>
        <td>Freight Charges :</td>
        <td>Total : </td>
      </tr>
      <tr>
        <td><?=$wbView['class'] ? $wbView['class'] : 'N/A'?></td>
        <td><?=$wbView['article_no'] ? $wbView['article_no'] : 'N/A'?></td>
        <td><?=$wbView['article_desc'] ? $wbView['article_desc'] : 'N/A'?></td>
        <td><?=$wbView['weight'] ? $wbView['weight'] : 'N/A'?></td>
        <td><?=$wbView['length'] ? $wbView['length'] : 'N/A'?></td>
        <td><?=$wbView['rate'] ? $wbView['rate'] : 'N/A'?></td>
        <td><?=$wbView['fcharge'] ? $wbView['fcharge'] : 'N/A'?></td>
        <td> </td>
      </tr>
   </table>

   </table>

    <br><br>

    <?php
    $this->endWidget();

    $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Print','htmlOptions'=>array('class'=>'pull-right')));

    echo "<br><br><br>";

  endforeach; ?>

<?php endif;?>
