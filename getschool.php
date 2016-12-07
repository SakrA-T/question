<?php
	$link=mysqli_connect("localhost", "root", "123574698", "question") or die("{\"code\":-1,\"msg\":连接数据库时出现错误！请联系系统管理员进行修复！\r\nerror code:}".mysqli_connect_error());
	$query="SELECT ID,name FROM school ORDER BY name DESC";
	$result=mysqli_query($link, $query);
	$rows=mysqli_num_rows($result);
	$json="[";
	for($i=0;$i<$rows;$i++){
		$row=mysqli_fetch_row($result);
		$json.="{\"id\":\"school-".$row[0]."\",\"name\":\"".$row[1]."\"}";
		if($i!=$rows-1)
			$json.=",";
	}
	$json.="]";

	echo $json;
?>