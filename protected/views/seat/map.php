<style>
  * {
      font-size:12px;
			font-family:"Lucida Grande","Lucida Sans Unicode",Verdana,Arial,Helvetica,sans-serif;
		}
		table {
      border:0px solid #555;
		  border-collapse:collapse;
		}
    #seat_list {
      text-align:center;
    }
    #seat_list td {
      border:1px solid #555;
      padding:8px;
    }
		#seat_list td:hover {
      background:#f68938;
    }
    #seatBox {
    }
    .reserve, #seat_list td.reserve:hover {
      background:#f5c;
    }
    .pre_assign, #seat_list td.pre_assign:hover {
      text-align:center;
      background:#bbb;
    }
    .pre_assign img {
      height:15px;
    }

</style>



<center>	
    <?php
	$ids = isset($_GET['id'])? $_GET['id'] : '';
	$type = isset($_GET['class']) ? $_GET['class']: 1;
	//$skp = Array('45D','45E','45F','45G','44A','44B','44C','29A','29B','29C','30A','30B','30C','30D');
	$skp = Array('45E','45F','45G','29A','29B','29C','29D','30A','30B','30C','30D');
        //for($n="C";$n<="G";$n++){
        for($n="A";$n<="F";$n++){
        	for($m=10;$m<=17;$m++){
                	$ap = "$m$n";
                        array_push($skp,$ap);
                }
        }
        //filter for H line
        for($m=1;$m<=45;$m++){
          if($m<=9 || $m>=18){
            $sh = "{$m}H";
            array_push($skp,$sh);
          }
        }
        switch($type){
          //case 1: $cl = "BUSINESS CLASS";$min=10;$max=29;break;
          case 1: $cl = "BUSINESS CLASS";$min=1;$max=29;break;
          case 3: $cl = "BUSINESS CLASS";$min=1;$max=9;break;
          case 2: $cl = "PREMIUM ECONOMY";$min=30;$max=45;break;
          default:
        }

//                                $apr = Array('2A','2B','6D','3C','1G','30D','33G','36E','45A','45B','45C');
//                                $pres = Array('5D','5E','5F','5G','7A');



  echo "<b>$cl</b>";
  $body = "";
  //for($a="A";$a<="G";$a++){
  for($a="A";$a<="H";$a++){
  	//if($a=="D"){$body .= "<tr style=\"height:80px;border-left:1px solid transparent;border-right:1px solid transparent\"></tr>";}
        //divider
  	if($a=="E"){$body .= "<tr style=\"height:80px;border-left:1px solid transparent;border-right:1px solid transparent\"></tr>";}
    $body .= "<tr>";
    for($b=$min;$b<=$max;$b++){
    	$ts = "$b$a";
      if(!in_array($ts,$skp)){
      	if(in_array($ts,$apr)){
        	$cls = "reserve";
		$stnum = "$b$a";
          $clk = "";
        }elseif(in_array($ts,$locked)){
        	$cls = "pre_assign";
		$stnum = CHtml::image(Yii::app()->theme->baseUrl."/img/lock.png");
		//$stnum = "$b$a";
          $clk = "";
        }else{
	  $stnum = "$b$a";
          $cls = "";
          $s = "$b$a";
          $ah = $id[$s];
          $clk = "title=\"$s\" onclick=\"get('$b$a','$ids','$ah')\"";
        }
        $body .= "<td class=\"$cls\" $clk >$stnum</td>";
      }else{
        $body .= "<th style=\"\"></th>";
      }
   	}
    $body .= "</tr>";
 	}

	function econo(){
		
	}
                                ?>
                                <table id="seat_list">
                                <?php echo $body; ?>
                                </table>

</center>
<script>
	function get(seat,ids,no){
		if(ids!=""){	
			$('#'+ids).val(seat);
			$('#Seat'+ids).val(no);
			if(ids!='Booking_seat'){
                        	lockSeat(no,ids);
				$('a[data-dismiss="modal"]').click();
			}else{
				$('#seatValue').html(seat);
				$('#'+ids).val(no);
			}
		}
	}
        function lockSeat(id,index){
          $.ajax({
            type: 'POST',
            url: '<?= Yii::app()->createUrl('seat/lock',array('voyage'=>$voyage))?>&sid='+id+'&index='+index,
            success: function (data){
             if(!data){
	       $('#'+index).val('');
	       $('#Seat'+index).val('');
               alert('Seat not available!');
             }
            },
            error: function (xht){
              alert(this.url);
           }

          });
       }
</script>


<?php
die();
?>
