<?php
$this->breadcrumbs=array(
	'Tickets',
);
?>

<h1>All Tickets</h1>

<?php foreach($ticketView as $tktView):

 $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
      'title' => 'Ticket No.&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp'.str_pad($tktView['tktno'],11,'0',STR_PAD_LEFT),
      'headerIcon' => 'icon-th-list',
      'htmlOptions' => array('class'=>'bootstrap-widget-table')
    ));
?>

<table class="table">
<tr><th>First Name :</th><td></td><td></td><td></td><td><?=$tktView['first_name']?></td>
    <th>Voyage :</th><td></td><td></td><td></td><td><?=$tktView['voy']?></td></tr>
<tr><th>Last Name :</th><td></td><td></td><td></td><td><?=$tktView['last_name']?></td>
    <th>Route :</th><td></td><td></td><td></td><td><?=$tktView['rou']?></td></tr>
<tr><th>Class :</th><td></td><td></td><td></td><td><?=$tktView['class']?></td>
    <th>Departure Time :</th><td></td><td></td><td></td><td><?=$tktView['vdt']?></td></tr>
<tr><th>Type :</th><td></td><td></td><td></td><td><?=$tktView['type']?></td>
    <th>Arrival Time :</th><td></td><td></td><td></td><td><?=$tktView['vat']?></td></tr>
<tr><th>Price :</th><td></td><td></td><td></td><td><?=$tktView['price']?></td></tr>
</table>

<?php
$this->endWidget();
endforeach; ?>
