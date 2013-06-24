<?php  
if(count($voyages)){
 $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
	  'title' => 'Booked Passenger/Cargo Per Voyage',
	  'headerIcon' => 'icon-th-list',
	  'htmlOptions' => array('class'=>' span6')
        ));
  echo "<div class='span6'>";
  foreach($voyages as $voyage){
    echo "<h3>$voyage->name</h3>";
    $model=new CActiveDataProvider('Booking', array(
      'criteria'=>array(
        'condition'=>"voyage={$voyage->id}",
      ),
      'pagination'=>array(
        'pageSize'=>20,
      ),
    ));
    $gridColumns = array(
      'status0.name',
      'status',
    );
    echo '<h5>Passenger</h5>';
    $this->widget('bootstrap.widgets.TbExtendedGridView', array(
      'type'=>'striped bordered',
      'dataProvider' => $model,
      'template' => "{items}\n{extendedSummary}",
      'columns' => $gridColumns,
      'chartOptions' => array(
        'data' => array(
          'series' => array(
            array(
              'name' => 'Total',
              'attribute' => 'status',
            ),
        )),
        'config' => array(
          'title'=>array('text'=>''),
          'chart'=>array(
            'type'=>'pie',
             'width'=>600
           ),
        )
      ),
    ));
    $cmodel=new CActiveDataProvider('BookingCargo', array(
      'criteria'=>array(
        'select'=>'SUM(IF(status IN(1,2), 1, 0)) as r_cnt,SUM(IF(status=3, 1, 0)) as c_cnt,SUM(IF(status=4, 1, 0)) as b_cnt, voyage',
        'condition'=>"voyage={$voyage->id}",
        'group'=>'t.voyage',
      ),
      'pagination'=>array(
        'pageSize'=>20,
      ),
    ));
    $gridColumns = array(
      'r_cnt',
      'c_cnt',
      'b_cnt',
    );
    echo '<h5>Cargo</h5>';
    $this->widget('bootstrap.widgets.TbExtendedGridView', array(
      'type'=>'striped bordered',
      'dataProvider' => $cmodel,
      'template' => "{items}\n{extendedSummary}",
      'columns' => $gridColumns,
      'chartOptions' => array(
        'data' => array(
          'series' => array(
            array(
              'name'=>'Reserved',
              'attribute' => 'r_cnt',
            ),
            array(
              'name'=>'Checked In',
              'attribute' => 'c_cnt',
            ),
            array(
              'name'=>'Boarded',
              'attribute' => 'b_cnt',
            ),
        )),
        'config' => array(
          'title'=>'test',
          'chart'=>array(
            'type'=>'pie',
             'width'=>800
           ),
        )
      ),
    ));
  }
  echo "</div>";
  $this->endWidget();
}
?>
<div style=clear:both></div>
