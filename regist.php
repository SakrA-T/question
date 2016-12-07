<?php 
	$tel=$_POST['tel'];
	$name=$_POST['name'];
	$pwd=$_POST['pwd'];
	$team=$_POST['team'];
	$link=mysqli_connect("localhost", "root", "123574698", "question") or die("{\"code\":\"-1\"连接数据库时出现错误！请联系系统管理员进行修复！\r\nerror code:".mysqli_connect_error());
	$query="SELECT num FROM teacher WHERE num=$tel";
	$result=mysqli_query($link, $query);
	$p=mysqli_fetch_object($result);
	if(isset($p->num)){//如果存在此工号
		echo "{\"code\":\"0\",\"msg\":\"此工号已被注册！请重新核对注册信息！\"}";
	}
	else{
		$insert="INSERT INTO teacher VALUES (0,$tel,'$name','$pwd',$team)";
		if(mysqli_query($link, $insert))
			echo "{\"code\":\"1\",\"msg\":\"注册成功！\"}";
		else
			echo "{\"code\":\"-2\",\"msg\":\"出现未知错误！请联系系统管理员修复！\r\nerror code:".mysqli_error($link)."\"}";
	}
 ?>