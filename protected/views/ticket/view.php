<?php
$this->breadcrumbs=array(
	'Tickets'=>array('index'),
	$ticket->id,
);

?>
<?php
  $route = Route::model()->findByPk($ticket->voyage0->route);
  $this->widget('bootstrap.widgets.TbEditableDetailView', array(
    'id' => 'ticket-details',
    'data' => Ticket::model()->findByPk($ticket->id),
    'url' => $this->createUrl('ticket/editableSaver'), //common submit url for all editables
    'attributes'=>array(
      array('label'=>'PRICE','value'=>$ticket->rate0->price),
      array('label'=>'VOYAGE','value'=>$ticket->voyage0->name),
      array('label'=>'ROUTE','value'=>$route->name),
      array('label'=>'DEPARTURE TIME','value'=>$ticket->voyage0->departure_time),
      array('label'=>'ARRIVAL TIME','value'=>$ticket->voyage0->arrival_time),
      array('label'=>'SEAT','value'=>isset($ticket->seatTicketMaps[0]->id) ? '':'NO ASSIGNED SEAT'),
    )
  ));
?>
