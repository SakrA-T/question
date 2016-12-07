<?php 
	$_num=$_POST['tel'];
	$_pwd=$_POST['pwd'];
	$link=mysqli_connect("localhost", "root", "123574698", "question") or die("{\"code\":\"-1\",\"msg\":\"连接数据库时出错！请联系系统管理员修复！\r\nerror code:".mysqli_connect_error()."\"}");
	$query="SELECT ID,name,pwd FROM teacher WHERE num=".$_num;
	$result=mysqli_query($link, $query);
	$db_teacher=mysqli_fetch_object($result);
	$id=$db_teacher->ID;
	$pwd=$db_teacher->pwd;
	$name=$db_teacher->name;
	if($db_teacher && $pwd==$_pwd)
		echo "{\"code\":\"1\",\"name\":\"".$name."\",\"id\":\"".$id."\"}";
	else
		echo "{\"code\":\"0\",\"msg\":\"用户名或密码不正确！\"}";
?>