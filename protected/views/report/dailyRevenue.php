  <?php $this->renderPartial('_form',array('model'=>$model),false,false)?>
  <?php if(!$is_empty && count($res)):?>
  <?php $ves = Vessel::model()->findByPk($model->vessel)?>
  <?php
    $ft = CHtml::listData(PassageFareTypes::model()->findAll(),'id','name');
  ?>
  <body>
  <div id=printArea>
  <?php if(!isset($graph)): ?>
  <style>
   .drr {
     border-collapse:collapse;
   }
   .drr th, .drr td {
     font-size:10px;
     padding:2px;
   }
   h1,h2,h3,h4,h5,h6 {
     margin:0;
   }
   .drr th, td{
     text-align:right;
   }
  </style>
  <center>
    <h5>ARCHIPELAGO PHILIPPINES FERRIES CORPORATION</h5>

    <h6>7/F Mapfre Asian Corporate Center Acacia Ave.,<br>
      Madrigal Business Park, Ayala Alabang, Muntinlupa City<br>
      Tel No.:(02) 775-0441 Fax No.:807-5670
    </h6>
<br>
    <h4>DAILY REVENUE REPORT NO.:__</h4>

    <h5 >VESSEL:<u><?=$ves->name?></u>&thinsp; &ensp; &#09; &emsp; &nbsp; DATE:<u><?=$model->departure_date ? $model->departure_date :date('Y-m-d') ?>  </u></h5>
    <h5 >ROUTE:<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></h5>
  </center>
  <?php endif;?>
  <table border=1 class="drr" width=600px align=center>
    <tr>
      <th rowspan=2>REVENUE</th>
      <th colspan=<?=count($res)?>><center>VOYAGE</center></th>
      <th rowspan=2 colspan=3>TOTAL</th>
    </tr>
    <tr>
      <th><?=implode('</th><th>',$voyages =array_map(function($voyages){return $voyages['name'];},$res))?></th>
    </tr>
    <tr bgcolor=orange>
      <th>Business Class</td>
      <th><?=implode('</th><th>',$class[1])?></th>
      <th colspan=3><?=number_format(array_sum($class[1]),2)?></th>
    </tr>
    <?php if($bdown):?>
    <?php foreach($ft as $key=>$f):?>
    <tr>
      <td rowspan=2>
        <?=$f?><br><br>No. of passenger
      </td>
      <td>
        <?=implode('</td><td>',$perType[1][$key])?>
      </td>
      <td colspan=3>
        <?=number_format(array_sum($perType[1][$key]),2)?>
      </td>
    </tr>
    <tr bgcolor=gray>
      <td>
        <?=implode('</td><td>',$cntPerType[1][$key])?>
      </td>
      <td colspan=3>
        <?=array_sum($cntPerType[1][$key])?>
      </td>
    </tr>
    <?php endforeach;?>
    <?php endif;?>
    <tr>
     <td></td>
    </tr>
    <tr bgcolor=cyan>
      <th>Premium Economy</th>
      <th><?=implode('</th><th>',$class[2])?></td>
      <th colspan=3><?=number_format(array_sum($class[2]),2)?></th>
    </tr>
    <?php if($bdown):?>
    <?php foreach($ft as $key=>$f):?>
    <tr>
      <td rowspan=2>
        <?=$f?><br><br>No. of passenger
      </td>
      <td>
        <?=implode('</td><td>',$perType[2][$key])?>
      </td>
      <td colspan=3>
        <?=number_format(array_sum($perType[2][$key]),2)?>
      </td>
    </tr>
    <tr bgcolor=gray>
      <td>
        <?=implode('</td><td>',$cntPerType[2][$key])?>
      </td>
      <td colspan=3>
        <?=array_sum($cntPerType[2][$key])?>
      </td>
    </tr>
    <?php endforeach;?>
    <?php endif;?>
    <?php if(isset($class[3])):?>
    <tr bgcolor=pink>
      <th>Cargo</th>
      <th><?=implode('</th><th>',$class[3])?></td>
      <th colspan=3><?=number_format(array_sum($class[3]),2)?></th>
    </tr>
    <?php endif;?>
    <tr>
      <th>UPGRADES</th>
      <th><?=implode('</th><th>',$ups =array_map(function($ups){return number_format($ups['ups'],2);},$res))?></th>
      <th colspan=3><?=number_format(array_sum($ups),2)?></th>
    </tr>
    <tr>
      <th>TOTAL REVENUE</td>
      <th><?=implode('</th><th>',$all)?></td>
      <th colspan=3><?=@number_format(array_sum($class[1])+array_sum($class[2])+array_sum($ups)+array_sum($class[3]))?></th>
    </tr>
    <?php if($bdown):?>
    <tr>
      <td colspan=<?=count($res)+4?>>Less: Collections</td>
    </tr>
    <tr>
      <td colspan=<?=count($res)+4?>>PSEI</td>
    </tr>
    <tr>
      <td colspan=<?=count($res)+4?>>Phil. Phos</td>
    </tr>
    <tr>
      <td  colspan=<?=count($res)+4?>>lla Express(Seña)</td>
    </tr>
    <tr>
      <td colspan=<?=count($res)+4?>>SKMTI</td>
    </tr>
    <tr>
      <td colspan=<?=count($res)+4?>>Others</td>
    </tr>
    <tr>
      <td colspan=<?=count($res)+4?>>&nbsp;</td>
    </tr>
    <tr>
      <td colspan=<?=count($res)+4?>>&nbsp;</td>
    </tr>
    <tr>
      <th>NET CASH COLLECTION:</th>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td></td>
      <td>OR#</td>
      <td>PAYOR</td>
      <td>REMARKS</td>
      <td>AMOUNT</td>
      <td width="100px">&nbsp;</td>
    </tr>
    <?php for($counter=1;$counter<13;$counter++):?>
    <tr>
      <td><?=$counter?></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <?php endfor;?>
    <tr>
      <th>Add:Cash Beginning</th>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <th>Total Cash on Hand</th>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <th>Less:Deposits</th>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <th>ENDING CASH BALANCE</th>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <?php endif;?>
  </table>
  <?php if(isset($graph)):?>
    <?php 
     foreach($voyages as $key=>$v){
        $data[] = "['$v',{$class[2][$key]},{$class[1][$key]}]";
     }
    ?>
    <script type="text/javascript" src="http://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load('visualization', '1', {packages: ['corechart']});
    </script>
    <script type="text/javascript">
      function drawVisualization() {
        // Create and populate the data table.
        var data = google.visualization.arrayToDataTable([
          ['Voyage', 'Premium Economy', 'Business'],
          <?php echo implode(',',$data)?>
        ]);
      
        // Create and draw the visualization.
        new google.visualization.ColumnChart(document.getElementById('visualization')).
            draw(data,
                 {title:"Daily Revenue Report <?=$model->departure_date ? $model->departure_date :date('Y-m-d') ?>",
                  width:800, height:600,
                  hAxis: {title: "Voyage"},
                  isStacked: true
                 }
            );
      }
      

      google.setOnLoadCallback(drawVisualization);
    </script>
   <center> <div id="visualization" style="width: 800px; height: 600px;"></div></center>

  <?php endif;?>
  </div>
  <script>
   function print(){
     var w = window.open('','dr');
     w.document.write($('#printArea').html());
     <?php  if(!isset($graph)):?>
       //w.print();
       //w.close();
     <?php endif;?>
   }
  </script>
  <div style=clear:both></div>
  <?php  $this->widget('bootstrap.widgets.TbButton', array('type'=>'info','icon'=>'print', 
      'label'=>'Print','htmlOptions'=>array('target'=>'_blank','class'=>'ticket_print_box' ,'onclick'=>'print();')));
    ?>
  <?php endif;?>
 </body>
