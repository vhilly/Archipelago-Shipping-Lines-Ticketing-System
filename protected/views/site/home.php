<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<?php $this->beginWidget('bootstrap.widgets.TbHeroUnit',array(
   # 'heading'=>'Welcome to '.CHtml::encode(Yii::app()->name),
)); ?>
<?php
 $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Seats',
    'headerIcon' => 'icon-th-list',
    'htmlOptions' => array('class'=>'bootstrap-widget-table span12')
  ));

$s1=0;$s2=0;$s3=0;$s4=0;$s5=0;
foreach($booked as $book){

        if ($book->status == 1)$s1++;
        if ($book->status == 2)$s2++;
        if ($book->status == 3)$s3++;
        if ($book->status == 4)$s4++;

}
$t = $s1+$s2+$s3+$s4;
$st = 100/$t;

$this->widget(
                'chartjs.widgets.ChDoughnut',
                array(
                        'width' => 600,
                        'height' => 300,
                        'htmlOptions' => array(),
                        'drawLabels' => true,
                        'datasets' => array(
                                array(
                                        "value" => $s1,
                                        "color" => "rgba(220,30, 70,1)",
                                        "label" => number_format($s1*$st)."% Reserved"
                                     ),

                                array(
                                        "value" => $s2,
                                        "color" => "rgba(66,66,66,1)",
                                        "label" => number_format($s2*$st)."% Paid"
                                     ),
                                array(
                                        "value" => $s3,
                                        "color" => "rgba(100,100,220,1)",
                                        "label" => number_format($s3*$st)."% Checked-in"
                                     ),
                                array(
                                        "value" => $s4,
                                        "color" => "rgba(20,120,120,1)",
                                        "label" => number_format($s4*$st)."% Cancelled"
                                     )
                                ),
                                'options' => array()
                                )
                                );

                                ?>

                                <?php $this->endWidget(); ?>
                <div class="clearfix"></div>
                                <?php $this->endWidget(); ?>
