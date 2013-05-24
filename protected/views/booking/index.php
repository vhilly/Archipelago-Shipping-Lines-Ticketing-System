<?php
  $this->breadcrumbs=array(
    'Bookings',
  );

  $this->menu=array(
    array('label'=>'Create Booking','url'=>array('create')),
    array('label'=>'Manage Booking','url'=>array('admin')),
  );
?>

<h1>Bookings</h1>
<?php 
  $dataProvider =array();
  foreach($bookings as $booking){
    $dataProvider[] =  array('id'=>$booking->id,
                             'fname'=>$booking->passenger0->first_name.' '.$booking->passenger0->last_name,
                             'dateBooked'=>$booking->date_booked
                            );
  }
  $gridDataProvider = new CArrayDataProvider($dataProvider);
  $gridDataProvider->pagination->pageSize = 20;
?>
<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'dataProvider'=>$gridDataProvider,
    'template'=>"{items}\n{pager}",
    'columns'=>array(
        array('name'=>'fname', 'header'=>'Name'),
        array('name'=>'dateBooked', 'header'=>'Date Booked'),
    ),
)); ?>
