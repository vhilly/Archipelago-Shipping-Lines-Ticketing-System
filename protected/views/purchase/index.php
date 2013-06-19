<?php
  //print_r($_SESSION['Purchase']);
?>

<?php echo $this->renderPartial('_form', array('purchase'=>$purchase))?>
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
         //var price = $('#Ticket_0_rate2price>option:selected').text();
         //$('.price').val(price);
         $('.cargoFare').change(function(){
           var cprice2rateId = '#'+$(this).attr('id')+'2price';
           var cpfare2classId = '#'+$(this).attr('id')+'2class';
		   var cpriceText = cprice2rateId +'text';
		   var cnewPrice = $(this).val();
		   $(cprice2rateId).val(cnewPrice);
		   $(cpfare2classId).val($(this).val());
           var cprice = $(cprice2rateId+'>option:selected').text();
           $(cpriceText).val(cprice);
         });

    "
  );
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
<?php echo $this->renderPartial('modal');?>
