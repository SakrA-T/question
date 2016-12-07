<?php 
	$link=mysqli_connect("localhost", "root", "123574698", "question") or die("{\"code\":-1,\"msg\":连接数据库时出现错误！请联系系统管理员进行修复！\r\nerror code:}".mysqli_connect_error());
	$query="SELECT t.ID as tID,t.name as tname,s.name as sname FROM school AS s,team AS t WHERE t.school=s.ID ORDER BY sname DESC";
	$query_school="SELECT ID,name,team_num FROM school ORDER BY name DESC";
	$result=mysqli_query($link, $query);
	$result_school=mysqli_query($link,$query_school);
	$rows=mysqli_num_rows($result);
	$rows_school=mysqli_num_rows($result_school);
	$array=array();
	$array_school=array();
	for($i=0;$i<$rows;$i++)
		array_push($array, mysqli_fetch_object($result));
	for($i=0;$i<$rows_school;$i++)
		array_push($array_school, mysqli_fetch_object($result_school));

	$json="[";
	$team_index=0;
	for($i=0;$i<$rows_school;$i++){
		$json.="{\"id\":\"school-".$array_school[$i]->ID."\",\"name\":\"".$array_school[$i]->name."\",\"team\":[";
		for($k=0;$k<$array_school[$i]->team_num;$k++,$team_index++){
			$json.="{\"id\":\"team-".$array[$team_index]->tID."\",\"name\":\"".$array[$team_index]->tname."\"}";
			if($k!=$array_school[$i]->team_num-1)
				$json.=",";
		}
		$json.="]}";
		if($i!=$rows_school-1)
			$json.=",";
	}
	$json.="]";
	echo $json;
 ?>