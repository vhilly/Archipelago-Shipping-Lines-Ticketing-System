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
  <?php if($pass):?>
  <center>
    <h2>ARCHIPELAGO PHILIPPINES FERRIES CORPORATION</h2>

    <h6>7/F Mapfre Asian Corporate Center Acacia Ave.,<br>
      Madrigal Business Park, Ayala Alabang, Muntinlupa City<br>
      Tel No.:(02) 775-0441 Fax No.:807-5670
    </h6>
    <h3 > <?=$voyage->vessel0->name?> </h3>
  </center>
</pre>
      <table>
        <tr>
          <th></th>
          <th>Voyage No. <u><?=$voyage->name?></u></th>
          <th>Date <u><?=date('Y-m-d')?></u></th>
        </tr>
        <tr>
          <th>Departure <u><?=$voyage->departure_date?></u></th>
          <th>From <u><?=$voyage->route0->from_port?></u></th>
          <th>To <u><?=$voyage->route0->to_port?></u></th>
        </tr>
        <tr class=border_bottom>
          <th>PASSENGERS</th>
          <th>Paying</th>
          <th>Pass</th>
          <th>Total</th>
        </tr>
        <?php foreach ($pass as $r):?>
        <tr>
          <th><?=$r['name']?></th>
          <th><?=$r['paying']?></th>
          <th><?=$r['pass']?></th>
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
        <?php foreach($cargo as $c): ?>
        <?php $orig_price = PriceHistory::model()->findByAttributes(array('category'=>'2','category_id'=>"{$c->rate}"),"changed_at >= '{$c->date_booked}'");?>
        <tr class=border>
          <td><?=$c->lading_no?></td>
          <td><?=$c->cargo0->shipper?></td>
          <td><?=$c->cargo0->article_desc?></td>
          <td><?=$c->cargo0->cargoClass->name?></td>
          <td><?=$c->cargo0->plate_num?></td>
          <td><?=isset($orig_price->price) ? $orig_price->price :$c->rate0->proposed_tariff?></td>
          <td></td>
        </tr>
       <?php endforeach;?>
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
