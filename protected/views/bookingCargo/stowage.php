<style>
	.sBox {
		border:1px solid black;
		margin:3px;
		float:left;
		padding-top:20px;
		
	}
	.car {
		width:80px;
		height:40px;
	}
	.bus {
		height: 50px;
		width: 180px;
	}
	.truck {
		width:196px;
		height:40px;
	}
	.sBox:hover {
		background:#3fc;
	}
	.active {
		background:#3ac;
	}


</style>
<center>
<div style="width:800px;overflow:auto;padding:5px;">
<?php
	$box = Array(9,7,6,4,7,8);
	$bus = Array(23,24,25,26);
	$right = Array(8,9,16,27,34,35);
	$truck = Array(19,20);
	$cnt = 1;
	foreach($box as $key => $num){
			$sl = ($key==1 || $key==4) ? "style=margin-left:84px": "";
			$sp = ($key==2 || $key==4) ? "<br>": "";
		echo $sp;
		echo "<div $sl>";
		for($a=1;$a<=$num;$a++){
			if(in_array($cnt,$bus)){
				$type = "bus";
			}elseif(in_array($cnt,$truck)){
				$type = "truck";
			}else{
				$type = "car";
			}
			$act = (in_array($cnt,$active)) ? "active" : "";
			echo "<div class=\"sbox $type $act\">$cnt</div>";
			$cnt++;
		}
		echo "</div><div style=clear:both></div>";
	
	}

?>
</div>
</center>
<?php
die();
?>
