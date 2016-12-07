<?php 
	$name=$_POST['name'];
	$value=$_POST['value'];
	if(setcookie($name, $value, time()+3600*24*7))
		echo 1;
	else
		echo 0;
?>