
  <?php $this->renderPartial('_form',array('model'=>$model),false,false)?>
  <?php if(!$is_empty && count($vname)):?>

  <center>
    <h2>ARCHIPELAGO PHILIPPINES FERRIES CORPORATION</h2>

    <h6>7/F Mapfre Asian Corporate Center Acacia Ave.,<br>
      Madrigal Business Park, Ayala Alabang, Muntinlupa City<br>
      Tel No.:(02) 775-0441 Fax No.:807-5670
    </h6>

    <h1>DAILY REVENUE REPORT NO.:__</h1>

    <h3 >VESSEL:<u>  </u>&thinsp; &ensp; &#09; &emsp; &nbsp; DATE:<u>  </u></h3></h3>
    <h3 >ROUTE:<u>  </u></h3>
  </center>

  <table border=1 class="well" width=800px align=center>
    <tr>
      <th rowspan=2>REVENUE</th>
      <th colspan=<?=count($vname)?>><center>VOYAGE</center></th>
      <th rowspan=2>TOTAL</th>
    </tr>
    <tr>
      <th><?=implode('</th><th>',$vname)?></th>
    </tr>
    <tr>
      <td>Business Class</td>
      <?php foreach($vname as $v):?>
      <td><?=isset($dR[1][$v]) ? $dR[1][$v]: 0?></td>
      <?php endforeach;?>
      <td><?=isset($dR[1][$v]) ?array_sum($dR[1]) :0?></td>
    </tr>
    <tr>
      <td>Premium Economy</td>
      <?php foreach($vname as $v):?>
      <td><?=isset($dR[2][$v]) ? $dR[2][$v]: 0?></td>
      <?php endforeach;?>
      <td><?=isset($dR[2][$v]) ? array_sum($dR[2]):0?></td>
    </tr>
    <tr>
      <td>TOTAL REVENUE</td>
      <td><?=implode('</td><td>',$total)?></td>
      <td><?=isset($total) ? array_sum($total) : 0?></td>
    </tr>
  </table>
  <?php endif;?>
