
  <table class=span>
    <th><?=$fee->name ?></th>
    <th><?=$fee->amt ?></th>
  </table>
  <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'searchForm',
	'type'=>'search',
	'method'=>'get',
	'htmlOptions'=>array('class'=>'span10'),
   )); ?>
   <?php
	echo $form->textFieldRow($model, 'tkt_no',array('class'=>'input-medium span2','id'=>'tktno', 'prepend'=>'<i class="icon-search"></i>'));
	echo $form->textFieldRow($model, 'booking_no',array('class'=>'input-medium span2','id'=>'booking'));
	echo $form->textFieldRow($model, 'first_name',array('class'=>'input-medium span2','id'=>'fname'));
	echo $form->textFieldRow($model, 'last_name',array('class'=>'input-medium span2','id'=>'lname'));
	echo $form->dropDownListRow($model, 'voyage',CHtml::listData(Voyage::model()->findAll(),'id','name'),array('empty'=>'','class'=>'span2'));
   ?>
   <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Go')); ?>
   <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Clear')); ?>
   <?php $this->endWidget()?>
   <div style="clear:both"> </div><br>
   <table class=span>
       <th>Ticket No</th>
       <th>Booking No</th>
       <th>First Name</th>
       <th>Last Name</th>
   <?php foreach($model->search()->getData() as $b):?>
     <tr>
       <td><?=$b->tkt_no?></td>
       <td><?=$b->booking_no?></td>
       <td><?=$b->passenger0->first_name?></td>
       <td><?=$b->passenger0->last_name?></td>
     </tr>
   <?php endforeach;?>
   </table>
   </div>
