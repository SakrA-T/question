<?php
	$type=$_POST['type'];
	if($type=="json"){
		$link=mysqli_connect("localhost", "root", "123574698", "question") or die("{\"code\":-1,\"msg\":连接数据库时出现错误！请联系系统管理员进行修复！\r\nerror code:}".mysqli_connect_error());
		$query_pub="SELECT ID,name FROM type WHERE school=0";   //公共题型
		$query="SELECT t.ID,t.name,s.ID,s.name FROM type AS t,school AS s WHERE t.school=s.ID ORDER BY s.ID,t.ID";   //学院专属题型
		
		$result_pub=mysqli_query($link,$query_pub);
		$result=mysqli_query($link,$query);
		
		$rows_pub=mysqli_num_rows($result_pub);
		$rows=mysqli_num_rows($result);

		$json="[{\"schoolID\":0,\"name\":\"综合\",\"type\":[";
		for($i=0;$i<$rows_pub;$i++){
			$row=mysqli_fetch_row($result_pub);
			$json.="{\"id\":".$row[0].",\"name\":\"".$row[1]."\"}";
			if($i!=$rows_pub-1)
				$json.=",";
		}
		$json.="]},";

		//先取两行，把第一行的学院名放到json里
		$row=mysqli_fetch_row($result);
		$row_=mysqli_fetch_row($result);
		$json.="{\"schoolID\":".$row[2].",\"name\":\"".$row[3]."\",\"type\":[";
		for($i=1;$i<$rows;$i++){
			if($row_[2]==$row[2])
				$json.="{\"id\":".$row[0].",\"name\":\"".$row[1]."\"},";
			else{
				$json.="{\"id\":".$row[0].",\"name\":\"".$row[1]."\"}";
				$json.="]},";
				$json.="{\"schoolID\":".$row_[2].",\"name\":\"".$row_[3]."\",\"type\":[";
			}
			$row=$row_;
			$row_=mysqli_fetch_row($result);
		}
		$json.="{\"id\":".$row[0].",\"name\":\"".$row[1]."\"}";
		$json.="]}]";

		echo $json;	
	}
	else if($type=="html"){
		$link=mysqli_connect("localhost", "root", "123574698", "question") or die("{\"code\":-1,\"msg\":连接数据库时出现错误！请联系系统管理员进行修复！\r\nerror code:}".mysqli_connect_error());
		$query_pub="SELECT ID,name FROM type WHERE school=0";   //公共题型
		$query="SELECT t.ID,t.name,s.ID,s.name FROM type AS t,school AS s WHERE t.school=s.ID ORDER BY s.ID,t.ID";   //学院专属题型
		
		$result_pub=mysqli_query($link,$query_pub);
		$result=mysqli_query($link,$query);
		
		$rows_pub=mysqli_num_rows($result_pub);
		$rows=mysqli_num_rows($result);

		$html="<p><span class=\"c-xy\">综合</span>";
		for($i=0;$i<$rows_pub;$i++){
			$row=mysqli_fetch_row($result_pub);
			$html.="<input type=\"checkbox\" name=\"ctype\" id=\"0-".$row[0]."\" value=\"0-".$row[0]."\"><label for=\"0-".$row[0]."\">".$row[1]."</label>";
		}
		$html.="</p>";

		$html.="<p>";
		$row=mysqli_fetch_row($result);
		$row_=mysqli_fetch_row($result);
		$html.="<span class=\"c-xy\">".$row[3]."</span>";
		for($i=1;$i<$rows;$i++){
			$html.="<input type=\"checkbox\" name=\"ctype\" id=\"".$row[2]."-".$row[0]."\" value=\"".$row[2]."-".$row[0]."\"><label for=\"".$row[2]."-".$row[0]."\">".$row[1]."</label>";
			if($row[2]!=$row_[2])
				$html.="</p><p><span class=\"c-xy\">".$row_[3]."</span>";
			$row=$row_;
			$row_=mysqli_fetch_row($result);
		}
		$html.="<input type=\"checkbox\" name=\"ctype\" id=\"".$row[2]."-".$row[0]."\" value=\"".$row[2]."-".$row[0]."\"><label for=\"".$row[2]."-".$row[0]."\">".$row[1]."</label>";
		$html.="</p>";

		echo $html;
	}
	else{
		echo "Invalid request!";
	}
?>