  <?php $this->renderPartial('_form',array('model'=>$model),false,false)?>
  <?php if(!$is_empty):?>

<?
  $perVoyage=array();
  $perVoyageRev=array();
  $totalRev=0;
  $vname='';
  $date='';
  $route='';
  if($dR){
    foreach($dR as $r){
      $perVoyage[$r['sclassid']][$r['voyeid']] = $r['amount'];
      $vname = $r['vessel'];
      $date = $r['departure_date'];
      $route = $r['routname'];
    }
  }


?>
  <center>
    <h2>ARCHIPELAGO PHILIPPINES FERRIES CORPORATION</h2>

    <h6>7/F Mapfre Asian Corporate Center Acacia Ave.,<br>
      Madrigal Business Park, Ayala Alabang, Muntinlupa City<br>
      Tel No.:(02) 775-0441 Fax No.:807-5670
    </h6>

    <h1>DAILY REVENUE REPORT NO.:__</h1>

    <h3 >VESSEL:<u> <?=$vname?> </u>&thinsp; &ensp; &#09; &emsp; &nbsp; DATE:<u> <?=$date?> </u></h3></h3>
    <h3 >ROUTE:<u> <?=$route?> </u></h3>
  </center>
</pre>
<table border=1 class="well" width=800px align=center>
  <tr>
    <th rowspan=2>REVENUE</th>
    <th colspan=<?=count($voy)?>><center>VOYAGE</center></th>
    <th rowspan=2>TOTAL</th>
  </tr>
  <tr>
  <?php foreach($voy as $v):?>
    <th><?=$v->name?></th>
  <?php endforeach;?>
  </tr>
  <?php foreach($sc as $s):?>
  <?php $total = 0;?>
  <tr>
    <td><?=$s->name?></td>
    <?php foreach($voy as $v):?>
    <td>
      <?php if(isset($perVoyage[$s->id][$v->id])):?>
      <?php 
        $amnt = $perVoyage[$s->id][$v->id];
        echo $amnt;
        $total += $amnt;
        if(!isset($perVoyageRev[$v->id]))
          $perVoyageRev[$v->id] = 0;
        $perVoyageRev[$v->id] += $amnt;
        $totalRev +=$total
      ?>
    <?php endif;?>
    </td>
    <?php endforeach;?>
    <td><?=$total?></td>
  </tr>
<?php endforeach;?>
  <td>TOTAL REVENUE</td>
  <td><?=implode('</td><td>',$perVoyageRev)?></td><td colspan="<?=count($voy)-count($perVoyageRev)?>"></td><td><?=array_sum($perVoyageRev)?></td>
</table>
  <?php endif;?>
