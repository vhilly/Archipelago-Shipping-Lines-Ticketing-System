
<pre>
  <center>
    <h2>ARCHIPELAGO PHILIPPINES FERRIES CORPORATION</h2>

    <h6>7/F Mapfre Asian Corporate Center Acacia Ave.,<br>
      Madrigal Business Park, Ayala Alabang, Muntinlupa City<br>
      Tel No.:(02) 775-0441 Fax No.:807-5670
    </h6>

    <h1>DAILY REVENUE REPORT NO.:__</h1>

    <h3 >VESSEL:_____________ &thinsp; &ensp; &#09; &emsp; &nbsp; DATE:______________</h3></h3>
    <h3 >ROUTE:_____________</h3>
  </center>
</pre>
<?php

?>

<?
  $perVoyage=array();
  if($dR){
    foreach($dR as $r){
      $perVoyage[$r['sclassid']][$r['voyeid']] = array($r['classname'],$r['count']);
    }
  }
  print_r($perVoyage);

?>
