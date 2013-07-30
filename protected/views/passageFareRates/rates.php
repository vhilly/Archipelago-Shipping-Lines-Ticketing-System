<?php if(count($sc) && $route):?>
    <?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
      'title' => 'Rates',
      'headerIcon' => 'icon-th-list',
      'htmlOptions' => array('class'=>'bootstrap-widget-table')
    ));?>
    <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array('id'=>'verticalForm')); ?>
    <table class=span6>
      <tr>
        <th colspan=4><center><?=$route->from_port.'-'.$route->to_port?><center></th>
      </tr>
      <tr>
         <td></td>
      <?php foreach($sc as $s):?>
        <th><?=$s->name?> </th>
      <?php endforeach;?>
      </tr>
      <?php foreach($ft as $f):?>
       <tr>
         <td>
           <?=$f->name?>
         </td>
         <?php foreach($sc as $s):?>
         <td>
           <? $i=  $f->id.$s->id;?>
           <?php $rate = PassageFareRates::model()->findByAttributes(array('type'=>$f->id,'class'=>$s->id,'route'=>$rid))?>
           <?php if(!$rate): ?>
            <?php 
              $rate = new PassageFareRates;
              $rate->route = $rid;
              $rate->class = $s->id;
              $rate->type = $f->id;
            ?>
           <?php endif;?>
            <?php echo $form->hiddenField($rate, "[$i]id", array('class'=>'span1')); ?>
            <?php echo $form->textField($rate, "[$i]price", array('class'=>'span1')); ?>
            <?php echo $form->hiddenField($rate, "[$i]class", array('class'=>'span1')); ?>
            <?php echo $form->hiddenField($rate, "[$i]route", array('class'=>'span1')); ?>
            <?php echo $form->hiddenField($rate, "[$i]type", array('class'=>'span1')); ?>
               
         </td>
         <?php endforeach;?>
       </tr>
      <?php endforeach;?>
    </table>
    <div class="clearfix"></div>
    <div class="form-actions">
      <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit','type'=>'primary', 'label'=>'Save')); ?>
    </div>
    <?php $this->endWidget();?>
    <?php $this->endWidget();?>
<?php else: ?>
    <?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
      'title' => 'Routes',
      'headerIcon' => 'icon-th-list',
      'htmlOptions' => array('class'=>'bootstrap-widget-table')
    ));?>
    <?php 
      $dataProvider=new CActiveDataProvider('Route');
      $gridColumns = array(
        'name',
        'from_port',
        'to_port',
        array(
          'class'=>'bootstrap.widgets.TbButtonColumn',
          'template'=>'{rates}',
          'buttons'=>array(            
            'rates' => array(
              'label'=>'Rates',
              'url'=>'Yii::app()->createUrl("passageFareRates/rates",array("rid"=>"$data->id"))',
            ),
          ),
        ),
      );
      $this->widget('bootstrap.widgets.TbGridView', array(
        'type'=>'bordered',
        'dataProvider'=>$dataProvider,
        'template'=>"{items}{pager}",
        'columns'=>$gridColumns,
      ));
    ?>
    <?php $this->endWidget();?>
<?php endif; ?>
