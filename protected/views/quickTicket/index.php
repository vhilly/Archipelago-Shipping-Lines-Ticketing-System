<?php if($data['voyages']) :?>

  <?php foreach($data['voyages'] as $v):?>
    <center>
    <?php
      $this->widget('bootstrap.widgets.TbButton',array(
        'label' => $v->name.' '.$v->route0->from_port.' - '.$v->route0->to_port.' DEPARTURE:'.$v->departure_date.' '.date('g:i:A',strtotime($v->departure_time)),
        'type' => 'primary',
        'buttonType' => 'link',
        'url'=>Yii::app()->createUrl('QuickTicket',array('id'=>$v->id)),
        'size' => 'large'
       ));
     ?>
    </center>
    <br>
  <?php endforeach;?>
<?php endif;?>
<?php if($data['voyage']) :?>
     <h4>Series Number Begins At:</h4><input type=text id=series value=<?=isset($_SESSION['series'])?$_SESSION['series']:''?>><input class='btn btn-primary' type=button id=setSeries value=Save>
     <h4>Seats Remaining:<br>
    <?php
      $bc = "Business Class = 159 ";
      $pe = "Premium / Economy = 105 ";
      foreach($data['bs_pc'] as $b){
        if($b['seating_class']  == 1){
          $remaining = 159 - $b['cnt'];
          $bc = "Business Class = $remaining ";
        }else{
          $remaining = 105 - $b['cnt'];
          $pe = "Premium / Economy = $remaining ";
        }
      }
      echo $bc.' '.$pe;
    ?>
    </h4>
    <?php
      $seating_class = CHtml::listData(SeatingClass::model()->findAll(array('order'=>'id DESC')),'id','name');
      $fare_types = CHtml::listData(PassageFareTypes::model()->findAll(),'id','name');
      $this->widget('bootstrap.widgets.TbButton',array(
        'label' => 'SELECT VOYAGE',
        'type' => 'inverse',
        'buttonType' => 'link',
        'url'=>Yii::app()->createUrl('QuickTicket',array('reset'=>true)),
        'size' => 'mini'
       ));
    ?>
   <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
     'htmlOptions'=>array('class'=>'well'),
     'type'=>'inline'
   )); ?>
   <table>
     <tr>
       <th>VOYAGE: <?= $data['voyage']->name?></th>
       <th>ROUTE: <?= $data['voyage']->route0->from_port?> <?= $data['voyage']->route0->to_port?></th>
       <th>DEPARTURE DATE: <?= $data['voyage']->departure_date?> <?=date('g:i:A',strtotime($data['voyage']->departure_time))?></th>
     </tr>
   </table>
   F1 = Premium Economy F2 = Business Class<br>
   Use left and right arrow to switch between fare types <br>
   Use +/- sign to add/remove passenger<br><br>
   <br><br>
   <?php echo $form->hiddenField($data['booking'],'voyage',array('value'=>$data['voyage']->id));?>
   <?php echo $form->dropDownListRow($data['booking'],'class',$seating_class,array('id'=>'class'));?><br><br>
   <?php echo $form->hiddenField($data['booking'],'route',array('value'=>$data['voyage']->route));?>
   <div id=passengers>
     <div id=container1>
   1. <?php echo $form->dropDownList($data['booking'],'ptype[]',$fare_types,array('id'=>'ptype_1'));?> 
     First Name <input class=span2 id=fname_1 type=text name='Booking[first_name][]'> 
     Last Name <input class=span2 id=lname_1 type=text name='Booking[last_name][]'> 
     Series# <input class=span2 id=series_1 type=text name='Booking[tkt_serial][]' value=<?=isset($_SESSION['series'])?$_SESSION['series']:'-'?>> <br><br>
     </div>
   </div>
   <br>
  <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Submit','id'=>'buy')); ?>
  <?php $this->endWidget();?>
<?php endif;?>
<script>
  $('#buy').attr('disabled','disabled');
  var current = 1;
  $(document).keypress(function (evt) {
    var charCode = evt.charCode || evt.keyCode;
    switch(charCode){
     case 112: $('#class').val(2); //f1
     break;
     case 113: $('#class').val(1); //f2
     break;
     case 39: $('#ptype_'+current+' option:selected').next().attr('selected', 'selected'); //right arrow
     break;
     case 37: $('#ptype_'+current+' option:selected').prev().attr('selected', 'selected'); //left arrow
     break;
     case 43: addSelect(); // + sign
     break;
     case 45: removeSelect(); // - sign
     break;
     case 13: confirmSubmit(); // - sign
     break;
    }
  });
  var current = 1;
  function confirmSubmit(){
    if(confirm('Are You Sure?')){
      $('#buy').removeAttr('disabled');
      $('#buy').click();
    }
  }
  function addSelect(){
    current++;
    if($('#series').val()){
      var newSeries = parseInt(current)+parseInt($('#series').val())-1;
    }else{
      var newSeries = '-';
    }
    var newSelect= $('<div id=container'+current+'><label>'+current+
     '.</label><select id=ptype_'+current+' name=Booking[ptype][]><option></option></select>'+
     ' First Name <input class=span2 id=fname_'+current+' type=text name="Booking[first_name][]">'+
     ' Last Name <input class=span2 id=lname_'+current+' type=text  name="Booking[last_name][]">'+
     ' Series# <input class=span2 id=series_'+current+' type=text value='+newSeries+'  name="Booking[tkt_serial][]">'+
     '<br><br></div>');
    newSelect.appendTo("#passengers");
    var options = $('#ptype_1 option').clone();
    $('#ptype_'+current).empty().append(options);
  }
  function removeSelect(){
    if(current >1){
     $('#container'+current).remove();
      current--;
    }
  }
  <?php if($data['bn']):?>
  var bn = <?=$data['bn']?>;
    url = '<?=Yii::app()->createUrl('booking/tkt',array(
     'Booking[booking_no]'=>$data['bn'],
     'Booking[voyage]'=>isset($data['voyage']->id) ? $data['voyage']->id:'',
     'print'=>1));?>';
    window.open(url);
  <?php endif;?>
  $('#setSeries').click(function(){
    if(!parseInt($('#series').val())){
      alert('Invalid Number');
      $('#series').val('');
      return false;
    }
    $.post('<?=Yii::app()->controller->createUrl('quickTicket/seriesNumber')?>',{'value':$('#series').val()},
      function(data){
        if(data.value){
           alert("Series number begins at "+data.value);
           $('#series').val(data.value);
           $('#series_1').val(data.value);
        }
      },
    "json");
     $("input").blur();
  });
</script>
