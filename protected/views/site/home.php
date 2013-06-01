<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<?php $this->beginWidget('bootstrap.widgets.TbHeroUnit',array(
   # 'heading'=>'Welcome to '.CHtml::encode(Yii::app()->name),
)); ?>
<?php

  $total = array_map(function ($ar) {return $ar['count'];},$booked);
  $total = array_sum($total);
  $percentage = 0;
    $chartValues = array();
  if($total){
    $percentage = 100/$total;
  }
    foreach($booked as $book){
      $chartValues[] = array('value'=>$book['count']*$percentage,'label'=>number_format($book['count']*$percentage,2).'% '.$book['name'],'color'=>$book['color']);
     }
    $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
      'title' => 'Booking Status',
      'headerIcon' => 'icon-th-list',
      'htmlOptions' => array('class'=>'bootstrap-widget-table span12')
    ));

    $this->widget(
      'chartjs.widgets.ChDoughnut',
        array(
          'width' => 600,
          'height' => 300,
          'htmlOptions' => array(),
          'drawLabels' => true,
          'datasets' =>$chartValues,
        )
    );

    $this->endWidget(); 
?>
<div class="clearfix"></div>
<?php $this->endWidget(); ?>
