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
<?php $_SESSION['nonce'] = $nonce = md5('salt'.microtime()); ?>
<input type="hidden" name="nonce" value="<?php echo $nonce; ?>" />



<div <?=$purchase->current_step==1 ? '' : 'style=display:none'?>>
  <?php $this->renderPartial('_step1',array('hidden'=>$hidden,'form'=>$form,'purchase'=>$purchase,'transaction_type'=>$transaction_type,'cargo'=>$cargo,'stowage'=>$stowage)); ?>
</div>


<div <?=$purchase->current_step==2 ? '' : 'style=display:none'?>>
  <?php $this->renderPartial('_step2',array('hidden'=>$hidden,'form'=>$form,'purchase'=>$purchase,'transaction_type'=>$transaction_type,'passengers'=>$passengers,'seats'=>$seats,'fares'=>$fares)); ?>
</div>
<div <?=$purchase->current_step==3 ? '' : 'style=display:none'?>>
  <?php $this->renderPartial('_step3',array('hidden'=>$hidden,'form'=>$form,'purchase'=>$purchase)); ?>
</div>

<?if($purchase->current_step==4): ?>
  <?php $this->renderPartial('_step4',array('hidden'=>$hidden,'purchase'=>$purchase)); ?>
<?php endif;?>

<div class="form-actions">
  <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Back','htmlOptions'=>array('name'=>'back','disabled'=>$purchase->current_step == 1 ? 'true':''))); ?>
  <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Next','htmlOptions'=>array('name'=>'next'))); ?>
</div>
<?php $this->endWidget();?>
<?php
  Yii::app()->clientScript->registerScript('show', "
    $('#Cargo_cargo_class').change(function(){
      loadData($(this).val(),$('#Purchase_voyage').val());
    });
    $('#Purchase_voyage').change(function(){
      loadData($('#Cargo_cargo_class').val(),$(this).val());
    });
    loadData($('#Cargo_cargo_class').val(),$('#Purchase_voyage').val());
    function loadData(class_id,voyage_id){
      $.ajax({
        type: 'POST',
        url: '".$this->createUrl('purchase/getCargoRate')."&id='+class_id+'&voyage='+voyage_id,
        success:
          function (data){
            $('#cargo_cost').val(data);
          },
        error:
          function (data){
          }
    });
    
    }
");
?>
<script>
  $('.smodal').bind('click', function (event){
    var scl = $('#Purchase_class').val();
    $.ajax({
      type: 'POST',
      url: '<?php echo Yii::app()->baseUrl;?>?r=seat/map&class='+scl+'&id='+this.id+'&voyage=<?php echo $purchase->voyage?>',
      success: function (data){
        $('#ticketModal .modal-header h2').html('Seat Map');
        $('#ticketModal .modal-body div').html(data);
        $('#ticketModal').modal();
      },
      error: function (xht){
        alert(this.url);
      }

    });
  });

  $('.stmodal').bind('click', function (event){
    $.ajax({
      type: 'POST',
      url: '<?php echo Yii::app()->baseUrl;?>?r=bookingCargo/map&class=stmodal',
      success: function (data){
        $('#ticketModal .modal-header h2').html('Stowage');
        $('#ticketModal .modal-body div').html(data);
        $('#ticketModal').modal();
      },
      error: function (xht){
        alert(this.url);
      }

    });
  });


</script>

<?php
  Yii::app()->clientScript->registerScript('prices',
    "
         $('.fare').change(function(){
           var price2rateId = '#'+$(this).attr('id')+'2price';
           var priceText = price2rateId +'text';
           var newPrice = $(this).val();
           $(price2rateId).val(newPrice);
           var price = $(price2rateId+'>option:selected').text();
           $(priceText).val(price);
         });
         if(!$('.fare').val()){
           $('.price').val('0.00');
         }
    "
  );
?>
<?php echo $this->renderPartial('modal');?>
