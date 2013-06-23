
<div id=message>
<?
  $message = array( '0'=>array('type'=>'succes','label'=>'Check-In Successful!'), 
                    '1'=>array('type'=>'important','label'=>'INCOMPLETE PASSENGER DETAILS!!')  
                  );
  $message = count($error) ?  $message[1] :  $message[0];
    $this->widget('bootstrap.widgets.TbLabel', array(
     'type'=>$message['type'], // 'success', 'warning', 'important', 'info' or 'inverse'
     'label'=>$message['label'],
    ));
?>
<div>
