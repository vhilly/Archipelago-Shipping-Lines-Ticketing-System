<?php
  $active = 'btn-primary';
  $ac = array('btn-inverse','btn-inverse','btn-inverse','btn-inverse');
  $hidden = 'hidden';
  switch($purchase->current_step){
    case 1: $hidden='';$ac = array('btn-success','btn-inverse','btn-inverse','btn-inverse');break;
    case 2: $ac = array('btn-primary','btn-success','btn-inverse','btn-inverse');break;
    case 3: $ac = array('btn-primary','btn-primary','btn-success','btn-inverse');break;
    case 4: $ac = array('btn-primary','btn-primary','btn-primary','btn-success');break;
    default: break;

  }




  $this->widget('bootstrap.widgets.TbButtonGroup', array(
    'buttons'=>array(
      array('label'=>'1. Ticket Details', 'url'=>'#', 'htmlOptions'=>array('disabled'=>true, 'class'=>$ac[0])),
      array('label'=>'2.  Details', 'url'=>'#','htmlOptions'=>array('disabled'=>true, 'class'=>$ac[1])),
      array('label'=>'3. Payment Details', 'url'=>'#', 'htmlOptions'=>array('disabled'=>true, 'class'=>$ac[2])),
      array('label'=>'4. Transaction Details', 'url'=>'#', 'htmlOptions'=>array('disabled'=>true, 'class'=>$ac[3]))
    ),
    'htmlOptions'=>array('class'=>'steps'),'size'=>'large'
  ));


?>

<?php


  $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'verticalForm',
    'htmlOptions'=>array('class'=>'well-small'),
  ));
?>
<?php echo $form->errorSummary($purchase); ?>
<?php if(isset($passenger)):?>
  <?php echo $form->errorSummary($passenger); ?>
<?php endif;?>
<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
  'title' => 'VOYAGE LIST',
  'headerIcon' => 'icon-th-list',
  // when displaying a table, if we include bootstra-widget-table class
  // the table will be 0-padding to the box
  'htmlOptions' => array('class'=>'bootstrap-widget-table '.$hidden.' midBox well-small pull-right')
));?>
<?php $_SESSION['nonce'] = $nonce = md5('salt'.microtime()); ?>
<input type="hidden" name="nonce" value="<?php echo $nonce; ?>" />
<?php $this->renderPartial('voyageList'); ?>

<?php $this->endWidget();?>

<div style="<?=$purchase->current_step==1? '':'display:none'?>">
  <fieldset>
    <?php echo $form->dropDownListRow($purchase, 'voyage',CHtml::listData(Voyage::model()->findAll(array('condition'=>'departure_date BETWEEN CURDATE() AND CURDATE() + INTERVAL 1 DAY')),'id','name')); ?>
    <?php if($purchase->cargo):?>
      <?php echo $form->hiddenField($purchase, 'class'); ?>
    <?php else:?>
      <?php echo $form->dropDownListRow($purchase, 'class',CHtml::listData(SeatingClass::model()->findAll(),'id','name')); ?>
    <?php endif;?>
    <?php
      if($purchase->passenger)
        echo $form->textFieldRow($purchase, 'passengerTotal', array('class'=>'span1'));
    ?>
  </fieldset>
</div>

<div style="<?=$purchase->current_step==2? '':'display:none'?>">
  <fieldset>
    <?php if($purchase->passenger):?>
      <?php
      $seats = Seat::model()->findAll(array(
        'condition'=>'seating_class=:cl',
        'params'=>array(':cl'=>$purchase->class),
      ));
      ?>
      <h3>PASSENGER DETAILS</h3>
      <table class="table table-bordered">
        <?php foreach($purchase->passengerModels as $key=>$passenger):?>
		  <?php $alter = ($key%2) ? "alter" : ""; ?>
          <tr class="<?=$alter?>">
			<td rowspan=2 >
				<b><?=$key+1?></b>
			</td>
            <td>
              <?php echo $form->textFieldRow($passenger, "[$key]first_name", array('class'=>'span2')); ?>
            </td>
            <td>
              <?php echo $form->textFieldRow($passenger, "[$key]last_name", array('class'=>'span2')); ?>
            </td>
            <td>
              <?php echo $form->textFieldRow($passenger, "[$key]middle_name", array('class'=>'span2')); ?>
            </td>
            <td>
              <?php echo $form->datepickerRow($passenger, "[$key]birth_date",
                array('prepend'=>'<i class="icon-calendar"></i>',
					  'class'=>'reduce',
                      'options'=>array('format'=>'yyyy-mm-dd'),
                )
              );
              ?>
            </td>
            <td>
              <?php echo $form->textFieldRow($passenger, "[$key]prefix", array('class'=>'span1')); ?>
            </td>
            <td>
              <?php echo $form->radioButtonListRow($passenger, "[$key]gender", array('M'=>'M','F'=>'F')); ?>
            </td>
		</tr>
		<tr class="<?=$alter?>">
            <td>
              <?php echo $form->labelEx($passenger, 'nationality', array('M'=>'M','F'=>'F')); ?>
              <?php
                $this->widget('bootstrap.widgets.TbTypeahead', array(
                  'model'=>$passenger,
                  'attribute'=>"[$key]nationality",
                  'options'=>array(
                    'name'=>"[$key]nationality",
                    'source'=>array(
                      'Filipino','Chinese','American'
                    ),
                    'items'=>4,
                    'matcher'=>"js:function(item) {
                  return ~item.toLowerCase().indexOf(this.query.toLowerCase());
               }",
                  ),'htmlOptions'=>array('class'=>'span2'),));
              ?>
            </td>
            <td colspan=2  <?php if($purchase->bundledPassenger && $key < $purchase->bundledPassenger){echo "style=display:none"; }?>>
              <?php echo $form->textFieldRow($passenger, "[$key]address", array('class'=>'span4')); ?>
            </td>
            <td <?php if($purchase->bundledPassenger && $key < $purchase->bundledPassenger){echo "style=display:none"; }?>>
              <?php echo $form->dropDownListRow($purchase->fareModels[$key],"[$key]id",CHtml::listData($purchase->fares,'id','type0.name'),array('class'=>'reduce fare','empty'=>'')); ?>
            </td>
            <td style="display:none">
              <?php echo $form->dropDownListRow($purchase->fareModels[$key],"[$key]id",CHtml::listData($purchase->fares,'id','price'),array('id'=>'PassageFareRates_'.$key.'_id2price','class'=>'span2 fare-2price','readonly'=>true,'empty'=>'')); ?>
            </td>
            <td <?php if($purchase->bundledPassenger && $key < $purchase->bundledPassenger){echo "style=display:none"; }?>>
              <?php echo $form->textFieldRow($purchase->fareModels[$key],"[$key]price",array('class'=>'span1 price', 'id'=>'PassageFareRates_'.$key.'_id2pricetext','readonly'=>true,'empty'=>'')); ?>
            </td>
            <td>
              <?php echo $form->textFieldRow($purchase->seatModels[$key],"[$key]id",array('class'=>'span1 seat smodal', 'id'=>'_'.$key.'_id','readonly'=>true)); ?>
            </td>
            <td style="display:none">
              <?php echo $form->dropDownListRow($purchase->seatModels[$key],"[$key]id",CHtml::listData($seats,'id','name'),array('class'=>'span2','empty'=>'')); ?>
            </td>
          </tr>
        <?php endforeach;?>
      </table>
    <?php endif;?>
    <?php if($purchase->cargo):?>

    <?php foreach($purchase->cargoModel as $key=>$cargo):?>

    <?php echo $form->textFieldRow($cargo,"[$key]shipper",array('class'=>'span3','maxlength'=>100)); ?>

    <?php echo $form->textFieldRow($cargo,"[$key]company",array('class'=>'span3','maxlength'=>100)); ?>

    <?php #echo $form->textFieldRow($cargo,'destination',array('class'=>'span3','maxlength'=>100)); ?>

    <?php echo $form->textFieldRow($cargo,"[$key]address",array('class'=>'span3','maxlength'=>255)); ?>

    <?php echo $form->dropDownListRow($purchase->cargoFareModels[$key],"[$key]id",$purchase->cargoFares,array('class'=>'span2 cargoFare','empty'=>'')); ?>
    <div style="display:none">
    <?php echo $form->dropDownListRow($purchase->cargoFareModels[$key],"[$key]id",CHtml::listData(CargoFareRates::model()->findAll(array('condition'=>'route=:rt','params'=>array(':rt'=>$purchase->route))),'id','proposed_tariff'),array('id'=>'CargoFareRates_'.$key.'_id2price','class'=>'span2 cargoFare','empty'=>'','readonly'=>true)); ?>
    </div>
    <?php echo $form->textFieldRow($purchase->cargoFareModels[$key],"[$key]proposed_tariff",array('id'=>'CargoFareRates_'.$key.'_id2pricetext','class'=>'span2 cargoFare','empty'=>'','readonly'=>true)); ?>
    <?php echo $form->textFieldRow($cargo,"[$key]article_no",array('class'=>'span2','maxlength'=>100)); ?>
    <?php echo $form->textAreaRow($cargo,"[$key]article_desc",array('class'=>'span3','maxlength'=>100)); ?>
    <?php echo $form->textFieldRow($cargo,"[$key]weight",array('class'=>'span2','maxlength'=>100)); ?>
    <?php echo $form->textFieldRow($cargo,"[$key]length",array('class'=>'span2','maxlength'=>100)); ?>
    <div style="display:none">
    <?php echo $form->dropDownListRow($cargo,"[$key]cargo_class",CHtml::listData(CargoFareRates::model()->findAll(array('condition'=>'route=:rt','params'=>array(':rt'=>$purchase->route))),'id','class'),array('id'=>'CargoFareRates_'.$key.'_id2class','readonly'=>true,'empty'=>'')); ?>
    </div>

    <?php endforeach;?>

    <?php endif;?>

  </fieldset>
</div>
<div style="<?=$purchase->current_step==3? '':'display:none'?>">
  <?php echo 'TOTAL AMOUNT: P'.$purchase->payment_total?><br><br>
  <fieldset>
    <?php echo $form->radioButtonListRow($purchase, 'payment_method',CHtml::listData(PaymentMethod::model()->findAll(),'id','name')); ?>
    <?php echo $form->dropDownListRow($purchase, 'payment_status',CHtml::listData(PaymentStatus::model()->findAll(),'id','name')); ?>
  </fieldset>
</div>
<?php if($purchase->current_step==4):?>
<div id="transDetails">
  <div>
    <script>
      $.ajax({
        type: 'GET',
        url: '<?php echo Yii::app()->baseUrl;?>?r=transaction/view&id='+'<?=$purchase->transaction_no?>',
        success: function (data){
          $('#transDetails').html(data);
        },
        error: function (xht){
          alert(this.url);
        }

      });
    </script>
    <?php endif?>
<div class="form-actions">

  <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Back','htmlOptions'=>array('name'=>'back','disabled'=>$purchase->current_step == 1 ? 'true':''))); ?>
  <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Next','htmlOptions'=>array('name'=>'next'))); ?>
</div>
<?php $this->endWidget(); ?>


