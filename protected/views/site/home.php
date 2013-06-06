
<?php if($booked):?>
<?php
  $labels = array();
  $datasets = array();
  $data = array();
  $data2 = array();
  $perStatus = array();
  $perVoyage = array();
  $capacity = array();
  foreach($booked as $b){
    $perVoyage[$b['voyid']][$b['status']] =$b['count'];
  }
  foreach($voy as $v){
    $labels[]= $v->name;
    $capacity[]=264;
    foreach($bs as $s){
     if(!isset($perVoyage[$v->id][$s->id]))
      $data[$s->id][] = 0;
    else
      $data[$s->id][] = $perVoyage[$v->id][$s->id];
    }
  }
  
   $dataSets[] =   array(
                        "fillColor" => "#699",
                        "strokeColor" => "rgba(220,220,220,1)",
                        "data" => $capacity,
                    );
  $legend = '';
  foreach($bs as $s){
   $legend .= "<b style=\"color:$s->color\">$s->name</b><br>";
   $dataSets[] =   array(
                        "fillColor" => $s->color,
                        "strokeColor" => "rgba(220,220,220,1)",
                        "data" => $data[$s->id],
                    );
  }
  
    $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
      'title' => 'Capacity/Actual',
      'headerIcon' => 'icon-th-list',
      'htmlOptions' => array('class'=>'bootstrap-widget-table span12')
    ));
  echo "<div style='background:#444;width:110px;padding:5px;margin:5px 0 5px 20px'><b style='color:#699'>Actual</b><br>$legend</div>";
  $this->widget(
            'chartjs.widgets.ChBars', 
            array(
                'width' => 800,
                'height' => 400,
                'htmlOptions' => array(),
                'labels' => $labels,
                'datasets' => $dataSets,
                'options' => array()
            )
        ); 



?>
<?php $this->endWidget(); ?>
<?php else:?>
<?php
    $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
      'title' => 'Capacity/Actual',
      'headerIcon' => 'icon-th-list',
      'htmlOptions' => array('class'=>'bootstrap-widget-table span12')
    ));
?>
<?php $this->endWidget(); ?>
<?php endif;?>
<div class="clearfix"></div>
