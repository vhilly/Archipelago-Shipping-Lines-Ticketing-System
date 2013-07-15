<?php if(count($cc) && $route):?>
    <?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
      'title' => 'Rates',
      'headerIcon' => 'icon-th-list',
      'htmlOptions' => array('class'=>'bootstrap-widget-table')
    ));?>
    <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array('id'=>'verticalForm')); ?>
    <table class=span6>
      <tr>
        <th colspan=2><center><?=$route->from.'-'.$route->to?><center></th>
      </tr>
      <?php foreach($cc as $c):?>
      <tr>
        <th><?=$c->name?> </th>
           <?php $i= $c->id;?>
           <?php $rate = CargoFareRates::model()->findByAttributes(array('class'=>$c->id,'route'=>$rid))?>
           <?php if(!$rate): ?>
            <?php 
              $rate = new CargoFareRates;
              $rate->route = $rid;
              $rate->class = $c->id;
            ?>
           <?php endif;?>
            <?php echo $form->hiddenField($rate, "[$i]id", array('class'=>'span1')); ?>
          <td><?php echo $form->textField($rate, "[$i]proposed_tariff", array('class'=>'span1')); ?></td>
            <?php echo $form->hiddenField($rate, "[$i]class", array('class'=>'span1')); ?>
            <?php echo $form->hiddenField($rate, "[$i]route", array('class'=>'span1')); ?>
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
        'from',
        'to',
        array(
          'class'=>'bootstrap.widgets.TbButtonColumn',
          'template'=>'{rates}',
          'buttons'=>array(            
            'rates' => array(
              'label'=>'Rates',
              'url'=>'Yii::app()->createUrl("cargoFareRates/rates",array("rid"=>"$data->id"))',
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
