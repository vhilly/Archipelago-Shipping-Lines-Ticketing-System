<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<?php $this->beginWidget('bootstrap.widgets.TbHeroUnit',array(
   # 'heading'=>'Welcome to '.CHtml::encode(Yii::app()->name),
)); ?>
<?php
 $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Booking Status',
    'headerIcon' => 'icon-th-list',
    'htmlOptions' => array('class'=>'bootstrap-widget-table span12')
  ));

  $total = array_map(function ($ar) {return $ar['count'];},$booked);
  $total = array_sum($total);
  $chartValues = array();
  $percentage = 100/$total;
  foreach($booked as $book){
     $chartValues[] = array('value'=>$book['count']*$percentage,'label'=>number_format($book['count']*$percentage,2).'% '.$book['name'],'color'=>$book['color']);
  }

  $this->widget(
                'chartjs.widgets.ChDoughnut',
                array(
                        'width' => 600,
                        'height' => 300,
                        'htmlOptions' => array(),
                        'drawLabels' => true,
                        'datasets' => 
                                  $chartValues,
                               
                                'options' => array()
                                )
                                );

                                ?>

                                <?php $this->endWidget(); ?>
                <div class="clearfix"></div>
                                <?php $this->endWidget(); ?>
