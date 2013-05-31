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
      background:#9fc;
    }

</style>



<center>	
    <?php
$ids = isset($_GET['id'])? $_GET['id'] : '';
$type = isset($_GET['class']) ? $_GET['class']: 1;
$skp = Array('45D','45E','45F','45G','44A','44B','44C');
        for($n="C";$n<="G";$n++){
                                        for($m=10;$m<=17;$m++){
                                                $ap = "$m$n";
                                                array_push($skp,$ap);
                                        }
        }
                                switch($type){
                                  case 1: $cl = "PREMIUM ECONOMY";$min=10;$max=29;break;
                                        case 2: $cl = "BUSINESS CLASS";$min=1;$max=9;break;
                                  case 3: $cl = "SUNDECK";$min=30;$max=45;break;
                                        default:
                                }

//                                $apr = Array('2A','2B','6D','3C','1G','30D','33G','36E','45A','45B','45C');
//                                $pres = Array('5D','5E','5F','5G','7A');





                                $body = "";
                                 for($a="A";$a<="G";$a++){
                                        if($a=="D"){$body .= "<tr style=\"height:80px;border-left:1px solid transparent;border-right:1px solid transparent\"></tr>";}
                                   $body .= "<tr>";
                                   for($b=$min;$b<=$max;$b++){
                                           $ts = "$b$a";
                                           if(in_array($ts,$apr)){
                                                   $cls = "reserve";
                                                         $clk = "";
                                                 }elseif(in_array($ts,$pres)){
                                                   $cls = "pre_assign";
                                                         $clk = "";
                                                 }else{
                                                   $cls = "";
                                                         $clk = "onclick=\"get('$b$a','$ids')\"";
                                                 }
                                                if(!in_array($ts,$skp)){
                                                 if($b==44 && ($a>="A" OR $a<="G")){
                                                        switch($a){
                                                         case "D": $c="A";break;
                                                         case "E": $c="B";break;
                                                         case "F": $c="C";break;
                                                         case "G": $c="D";break;
                                                        }
							$clk = $clk!="" ? "onclick=\"get('$b$c','$ids')\"" : "";
                                            $body .= "<td class=\"$cls\" $clk >$b$c</td>";
                                                 }else{
                                            $body .= "<td class=\"$cls\" $clk >$b$a</td>";
                                                 }
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
	function get(seat,ids){
		if(ids!=""){	
			$('#'+ids).val(seat);
			$('a[data-dismiss="modal"]').click();
		}
	}
</script>


<?php
die();
?>
