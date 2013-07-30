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
        'select'=>'status,count(id) as cnt',
        'condition'=>"voyage={$voyage->id} AND status < 5",
        'group'=>'t.status',
      ),
      'pagination'=>array(
        'pageSize'=>20,
      ),
    ));
    $gridColumns = array(
      'status0.name',
      'cnt',
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
              'name'=>'Total',
              'attribute' => 'cnt',
            ),
        )),
        'config' => array(
          'title'=>'test',
          'chart'=>array(
            'type'=>'pie',
             'width'=>600
           ),
        )
      ),
    ));
    $cmodel=new CActiveDataProvider('BookingCargo', array(
      'criteria'=>array(
        'select'=>'status,count(id) as cnt',
        'condition'=>"voyage={$voyage->id} AND status < 5",
        'group'=>'t.status',
      ),
      'pagination'=>array(
        'pageSize'=>20,
      ),
    ));
    $gridColumns = array(
      'status0.name',
      'cnt',
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
              'name'=>'Total',
              'attribute' => 'cnt',
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
