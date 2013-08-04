
  <?php $this->renderPartial('_form',array('model'=>$model),false,false)?>
  <?php if(!$is_empty && count($res)):?>
  <?php $ves = Vessel::model()->findByPk($model->vessel)?>
  <div id=printArea>
  <center>
    <h2>ARCHIPELAGO PHILIPPINES FERRIES CORPORATION</h2>

    <h6>7/F Mapfre Asian Corporate Center Acacia Ave.,<br>
      Madrigal Business Park, Ayala Alabang, Muntinlupa City<br>
      Tel No.:(02) 775-0441 Fax No.:807-5670
    </h6>

    <h1>DAILY REVENUE REPORT NO.:__</h1>

    <h3 >VESSEL:<u><?=$ves->name?></u>&thinsp; &ensp; &#09; &emsp; &nbsp; DATE:<u><?=$model->departure_date?>  </u></h3>
    <h3 >ROUTE:<u>  </u></h3>
  </center>

  <table border=1 class="well" width=800px align=center>
    <tr>
      <th rowspan=2>REVENUE</th>
      <th colspan=<?=count($res)?>><center>VOYAGE</center></th>
      <th rowspan=2>TOTAL</th>
    </tr>
    <tr>
      <th><?=implode('</th><th>',array_map(function($voyages){return $voyages['name'];},$res))?></th>
    </tr>
    <tr>
      <td>Business Class</td>
      <td><?=implode('</td><td>',$class[1])?></td>
      <td><?=array_sum($class[1])?></td>
    </tr>
    <tr>
      <td>Premium Economy</td>
      <td><?=implode('</td><td>',$class[2])?></td>
      <td><?=array_sum($class[2])?></td>
    </tr>
    <tr>
      <td>TOTAL REVENUE</td>
      <td><?=implode('</td><td>',$all)?></td>
      <td><?=array_sum($class[1])+array_sum($class[2])?></td>
    </tr>
  </table>
  </div>
  <script>
   function print(){
     var w = window.open('','dr');
     w.document.write($('#printArea').html());
     w.print();
     w.close();
   }
  </script>
  <?php  $this->widget('bootstrap.widgets.TbButton', array('type'=>'info','icon'=>'print', 
      'label'=>'Print','htmlOptions'=>array('target'=>'_blank','class'=>'ticket_print_box' ,'onclick'=>'print();')));
    ?>
  <?php endif;?>
