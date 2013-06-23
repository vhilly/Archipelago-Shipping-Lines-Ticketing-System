<div id="transDetails"></div>
<script>
  $.ajax({
  type: 'GET',
    url: '<?php echo Yii::app()->baseUrl;?>?r=transaction/view&id='+'<?=$purchase->tr_no?>',
    success: function (data){
    $('#transDetails').html(data);
  },
  error: function (xht){
    alert(this.url);
  }

  });
</script>
