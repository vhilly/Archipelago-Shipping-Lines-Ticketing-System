<?php
$now = date('Y-m-d H:i:s'); //currentdate

$fiveminsago = mktime(date("H"),date("i")-5,date("s"),date("m"),date("d"),date("Y"));

$_5minsago = date('Y-m-d H:i:s', $fiveminsago);//currentdate 5 mins ago

echo "current time is $now and the time 5 mins ago is $_5minsago <br>";

$db = mysql_connect('localhost', 'root', 'mysqladmin');

if (!$db) {
        die('Could not connect: ' . mysql_error());
}
mysql_select_db("archipelago", $db);

$remove_locks = "delete from seat_lock where timestamp <= '$_5minsago'";

$remove_locks_query = mysql_query($remove_locks);

mysql_fetch_assoc($remove_locks_query);

echo $remove_locks;
 //to do
 //1 get 5 mins earlier the current datetime
 //2 delete * from seat_lock where timestamp  <= datetime 5 mins ealier

?>
