
<?php echo $this->renderPartial('_form', array('purchase'=>$purchase,'passengers'=>$passengers,'fares'=>$fares,'tickets'=>$tickets,'cargo'=>$cargo,'seatings'=>$seatings)); ?>
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
        var price = $('#Ticket_0_rate2price>option:selected').text();
        $('.price').val(price);
   "
  );
?>
