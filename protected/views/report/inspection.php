  <?php $this->renderPartial('_form2',array('model'=>$model),false,false)?>
  <style>
   tr.border_bottom th {
     border-bottom:1pt solid black;
   }
   tr.border td {
     border:1pt solid black;
   }
  </style>
  </style>
  <?php if($result):?>
    <center>
      <h4>PHILHARBOR FERRIES & REPORT SERVICES INC.</h4>

      <h6>7/F Mapfre Asian Corporate Center Acacia Ave.,<br>
        Madrigal Business Park, Ayala Alabang, Muntinlupa City<br>
        Maharlika.........
      </h6>
      <table>
        <tr>
          <th></th>
          <th>Voyage No. <u><?=$voyage->name?></u></th>
          <th>Date <u><?=date('Y-m-d')?></u></th>
        </tr>
        <tr>
          <th>Departure <u><?=$voyage->departure_date?></u></th>
          <th>From <u><?=$voyage->route0->from?></u></th>
          <th>To <u><?=$voyage->route0->to?></u></th>
        </tr>
        <tr class=border_bottom>
          <th>PASSENGERS</th>
          <th>Paying</th>
          <th>Pass</th>
          <th>Total</th>
        </tr>
        <?php foreach ($result as $r):?>
        <tr>
          <th><?=$r['name']?></th>
          <th><?=$r['count']?></th>
        </tr>
        <?php endforeach;?>
        <tr>
          <th colspan=3>Others _____________</th>
          <th colspan=3>Driver/Conductors _____________________</th>
        </tr>
        <tr class=border_bottom>
          <th colspan=6>Remarks:_____________________________</th>
        </tr>
        <tr>
          <th colspan=6>VEHICLES CARGO</th>
        </tr>
        <tr>
          <td>W bill</td>
          <td>Shipper</td>
          <td>Description</td>
          <td>Class</td>
          <td>Plate No.</td>
          <td>Freight</td>
          <td>Credit<br>(Y/N)</td>
        </tr>
        <tr class=border>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <tr class=border>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <th colspan=7>Stub Collectors On Duty: _______________</th>
        </tr>
        <tr>
          <th colspan=7>Remarks: _______________</th>
        </tr>
        <tr>
          <th colspan=5></th>
          <th colspan=2>_______________</th>
        </tr>
        <tr>
          <th colspan=5></th>
          <th colspan=2> INSPECTOR</th>
        </tr>
      </table>
    </center>
  <?php endif;?>
