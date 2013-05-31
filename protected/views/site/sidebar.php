<script>
			$('#btnSearch').bind('click', function (event) {
				var sType = $('#selection').val()+'/view';
				var sSearch = $('#search').val();
				jQuery.ajax({
            type: 'POST',
            url: '<?php echo Yii::app()->baseUrl; ?>?r='+sType+'&id='+sSearch,
            success: function(data){
							$('#ticketModal .modal-header h4').html('Ticket Details');
							$('#ticketModal .modal-body p').html(data);
							$('#ticketModal').modal();
       			},
						error: function(xhr) { 
							$('#ticketModal .modal-header h4').html('Oooops!');
							$('#ticketModal .modal-body p').html('Sorry! No result found.<br>');
							$('#ticketModal').modal();  
						},
          });
     });
</script>
<?php echo $this->renderPartial('search');?>

