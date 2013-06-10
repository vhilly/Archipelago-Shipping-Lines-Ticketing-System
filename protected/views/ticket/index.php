<?php
  $this->breadcrumbs=array(
    'Tickets',
  );
?>

<h1>All Tickets</h1>

<?php $this->renderPartial('_searchform',array('model'=>$model),false,false)?>
<?php if(!$is_empty):?>


  <?php foreach($ticketView as $tktView):

    $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    //  'title' => 'Ticket No. '.str_pad($tktView['tktno'],11,'0',STR_PAD_LEFT),
      'headerIcon' => 'icon-th-list',
      'htmlOptions' => array('class'=>'bootstrap-widget-table','style'=>'background:#1d7cbf')
    ));
    ?>

    <table class="table">
      <tr style="background:#eeeeff"><th width=15%>First Name :</th><td></td><td></td><td></td><td width=25%><?=$tktView['first_name']?></td>
        <th>Voyage :</th><td></td><td></td><td></td><td><?=$tktView['voy']?></td></tr>
      <tr><th>Last Name :</th><td></td><td></td><td></td><td><?=$tktView['last_name']?></td>
        <th>Route :</th><td></td><td></td><td></td><td><?=$tktView['rou']?></td></tr>
      <tr style="background:#eeeeff"><th>Class :</th><td></td><td></td><td></td><td><?=$tktView['class']?></td>
        <th>Seat :</th><td></td><td></td><td></td><td><?=$tktView['sea']?></td></tr>
      <tr><th>Type :</th><td></td><td></td><td></td><td><?=$tktView['type']?></td>
        <th>Departure Time :</th><td></td><td></td><td></td><td><?=$tktView['vdt']?></td></tr>
      <tr style="background:#eeeeff"><th>Price :</th><td></td><td></td><td></td><td><?=$tktView['price']?></td>
        <th>Arrival Time :</th><td></td><td></td><td></td><td><?=$tktView['vat']?></td></tr>
    </table>

    <br><br>

    <?php
    $this->endWidget();

    $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Print','htmlOptions'=>array('class'=>'pull-right')));

    echo "<br><br><br>";

  endforeach; ?>

<?php endif;?>
