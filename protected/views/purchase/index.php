
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
        $('#Cargo_cargo_class').change(function(){
          $('#Cargo_price').val($(this).val());
          $('#Purchase_cargoPrice').val($('#Cargo_price>option:selected').text());
        });
          $('#Purchase_cargoPrice').val($('#Cargo_price>option:selected').text());
   "
  );
?>
<script>
	$('.smodal').bind('click', function (event){
		var scl = $('#Purchase_class').val();
		$.ajax({
			type: 'POST',
			url: '<?php echo Yii::app()->baseUrl;?>?r=seat/map&class='+scl+'&id='+this.id,
			success: function (data){
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
