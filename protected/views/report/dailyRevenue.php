
  <?php $this->renderPartial('_form',array('model'=>$model),false,false)?>
  <?php if(!$is_empty && count($res)):?>
  <?php $ves = Vessel::model()->findByPk($model->vessel)?>
  <?php
    $ft = CHtml::listData(PassageFareTypes::model()->findAll(),'id','name');
  ?>
  <div id=printArea>
  <?php if(!isset($graph)): ?>
  <center>
    <h2>ARCHIPELAGO PHILIPPINES FERRIES CORPORATION</h2>

    <h6>7/F Mapfre Asian Corporate Center Acacia Ave.,<br>
      Madrigal Business Park, Ayala Alabang, Muntinlupa City<br>
      Tel No.:(02) 775-0441 Fax No.:807-5670
    </h6>

    <h1>DAILY REVENUE REPORT NO.:__</h1>

    <h3 >VESSEL:<u><?=$ves->name?></u>&thinsp; &ensp; &#09; &emsp; &nbsp; DATE:<u><?=$model->departure_date ? $model->departure_date :date('Y-m-d') ?>  </u></h3>
    <h3 >ROUTE:<u>  </u></h3>
  </center>
  <?php endif;?>
  <table border=1 class="well" width=800px align=center>
    <tr>
      <th rowspan=2>REVENUE</th>
      <th colspan=<?=count($res)?>><center>VOYAGE</center></th>
      <th rowspan=2>TOTAL</th>
    </tr>
    <tr>
      <th><?=implode('</th><th>',$voyages =array_map(function($voyages){return $voyages['name'];},$res))?></th>
    </tr>
    <tr>
      <th>Business Class</td>
      <th><?=implode('</th><th>',$class[1])?></th>
      <th><?=array_sum($class[1])?></th>
    </tr>
    <?php if($bdown):?>
    <?php foreach($ft as $key=>$f):?>
    <tr>
      <td>
        <?=$f?>
      </td>
      <td>
        <?=implode('</td><td>',$perType[1][$key])?>
      </td>
      <td>
        <?=array_sum($perType[1][$key])?>
      </td>
    </tr>
    <?php endforeach;?>
    <?php endif;?>
    <tr>
     <td></td>
    </tr>
    <tr>
      <th>Premium Economy</th>
      <th><?=implode('</th><th>',$class[2])?></td>
      <th><?=array_sum($class[2])?></th>
    </tr>
    <?php if($bdown):?>
    <?php foreach($ft as $key=>$f):?>
    <tr>
      <td>
        <?=$f?>
      </td>
      <td>
        <?=implode('</td><td>',$perType[2][$key])?>
      </td>
      <td>
        <?=array_sum($perType[2][$key])?>
      </td>
    </tr>
    <?php endforeach;?>
    <?php endif;?>
    <tr>
      <th>TOTAL REVENUE</td>
      <th><?=implode('</th><th>',$all)?></td>
      <th><?=array_sum($class[1])+array_sum($class[2])?></th>
    </tr>
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
       w.print();
       w.close();
     <?php endif;?>
   }
  </script>
  <div style=clear:both></div>
  <?php  $this->widget('bootstrap.widgets.TbButton', array('type'=>'info','icon'=>'print', 
      'label'=>'Print','htmlOptions'=>array('target'=>'_blank','class'=>'ticket_print_box' ,'onclick'=>'print();')));
    ?>
  <?php endif;?>
