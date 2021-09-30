<?php
	include 'sql.php';
	if(isset($_GET['un'])){
		if($_GET['un']<>""){
			$sql = "SELECT
			*
			FROM
			my_user
			WHERE
			email = '".$_GET["un"]."'";
			$result = mysql_query($sql);
			if($result){
				$row = mysql_fetch_array($result);
				if($_GET['ps']==$row['pass']){
					if(isset($_GET['data'])){
						if($_GET['data']=="news"){
							$projectContents = '{ 
							"news":[';
							$result = mysql_query("SELECT * FROM news ORDER BY time DESC LIMIT 0 , 20");
							while($rsw = mysql_fetch_array($result))
							{
								$sql = "SELECT
								*
								FROM
								my_user
								WHERE
								email = '".$rsw['email']."'";
								$reult = mysql_query($sql);
								$rw = mysql_fetch_array($reult);
								$projectContents .='{"name":"'.$rw['name'].
								'","msg":"'.$rsw['msg'].
								'","time":"'.$rsw['time'].
								'","email":"'.$rsw['email'].
								'","rating":"'.$rsw['rating'].
								'"},';
							}
							echo $projectContents."{}]
							
							}" ;
							}else if($_GET['data']=="sql"){
							$reult = mysql_query($_GET['sql']);
							}else if($_GET['data']=="mes_send"){
							if($_GET['who']=="Group"){
								$sql = "INSERT INTO Groupchat VALUES ('".$_GET['un']."','".$_GET['msg']."',CURRENT_TIMESTAMP,'0')";
								$result = mysql_query($sql);
								}else{
								$sql = "INSERT INTO ".$_GET['un']."_".$_GET['who']." VALUES ('".$_GET['un']."','".$_GET['msg']."',CURRENT_TIMESTAMP,'0')";
								$result = mysql_query($sql);
								$sql = "INSERT INTO ".$_GET['who']."_".$_GET['un']." VALUES ('".$_GET['un']."','".$_GET['msg']."',CURRENT_TIMESTAMP,'0')";
								$result = mysql_query($sql);
							}
							$sql = "UPDATE ".$_GET['who']."_msg SET seen='0',msg='".$_GET['msg']."' WHERE email='".$_GET['un']."'";
							$result = mysql_query($sql);
							$sql = "UPDATE ".$_GET['un']."_msg SET seen='1',msg='".$_GET['msg']."' WHERE email='".$_GET['who']."'";
							$result = mysql_query($sql);
							}else if($_GET['data']=="mes_get"){
							if($_GET['who']=="Group"){
								$sql = "SELECT * FROM Groupchat ORDER BY time DESC LIMIT 0 , ".$_GET['lim'];	
								}else{
								$sql = "SELECT * FROM ".$_GET['un']."_".$_GET['who']." ORDER BY time DESC LIMIT 0 , ".$_GET['lim'];
							}
							$result =  mysql_query($sql);
							echo "{\"mess\":[";
							while($row = mysql_fetch_array($result)){
								$sql1 = "SELECT * FROM my_user WHERE email='".$row['email']."'";
								$result1 = mysql_query($sql1);
								$row1 = mysql_fetch_array($result1);
								echo "{\"email\":\"".$row['email']."\",";
							echo "\"name\":\"".$row1['name']."\",";
							echo "\"msg\":\"".$row['msg']."\",";
							echo "\"time\":\"".$row['time']."\",";
							echo "\"seen\":\"".$row['seen']."\"},";
							}
							echo"{}]}";
							$sql = "UPDATE ".$_GET['who']."_".$_GET['un']." SET seen='1' WHERE email='".$_GET['who']."'";
							//echo $sql;
							$result = mysql_query($sql);
							$sql = "UPDATE ".$_GET['un']."_msg SET seen='1' WHERE email='".$_GET['who']."'";
							//echo $sql;
							$result = mysql_query($sql);
							
							}else if($_GET['data']=="mes"){
							$projectContents = '{ 
							"mess":[';
							$result = mysql_query("SELECT * FROM ".$_GET['un']."_msg ORDER BY time DESC");
							while($rsw = mysql_fetch_array($result))
							{
							$sql = "SELECT
							*
							FROM
							my_user
							WHERE
							email = '".$rsw['email']."'";
							$reult = mysql_query($sql);
							$rw = mysql_fetch_array($reult);
							$projectContents .='{"name":"'.$rw['name'].
							'","msg":"'.$rsw['msg'].
							'","time":"'.$rsw['time'].
							'","email":"'.$rsw['email'].
							'","seen":"'.$rsw['seen'].
							'"},';
							}
							echo $projectContents."{}]
							}" ;
						}
						$sql = "UPDATE
						my_user
						SET
						onlineup = CURRENT_TIMESTAMP
						WHERE
						email = '".$_GET['un']."'";
						$reult = mysql_query($sql);
					}
					}else{
					echo "fall" ;
				}
				
				}else{
				echo "fall";
			}
			}else{
			echo "fall";
		}
	}
	if(isset($_GET['pp'])){
		$projectContents = '{ 
		"pp":[';
		$result = mysql_query("SELECT * FROM news ORDER BY time DESC LIMIT 0 , 20");
		while($rsw = mysql_fetch_array($result))
		{
			$sql = "SELECT
			*
			FROM
			my_user
			WHERE
			email = '".$rsw['email']."'";
			$reult = mysql_query($sql);
			$rw = mysql_fetch_array($reult);
			if( 1 > strpos($projectContents,$rsw['email'])){ 
				$projectContents .='{"email":"'.$rsw['email'].
				'","pp":"http://thanurrr.freehostia.com/'.$rw['pp'].
				'","name":"'.$rw['name'].
				'","age":"'.$rw['age'].
				'","school":"'.$rw['school'].
				'","gender":"'.$rw['gen'].
				'"},';
			}
		}
		$sql = "SELECT
		*
		FROM
		my_user
		WHERE
		email = '".$_GET['pp']."'";
		$reult = mysql_query($sql);
		$rw = mysql_fetch_array($reult);
		if( 1 > strpos($projectContents,$_GET['pp'])){
			$projectContents .='{"email":"'.$_GET['pp'].
			'","pp":"http://thanurrr.freehostia.com/'.$rw['pp'].
			'"},';
		}
		$result = mysql_query("SELECT * FROM ".$_GET['pp']."_msg ORDER BY time DESC");
		while($rsw = mysql_fetch_array($result))
		{
			$sql = "SELECT
			*
			FROM
			my_user
			WHERE
			email = '".$rsw['email']."'";
			$reult = mysql_query($sql);
			$rw = mysql_fetch_array($reult);
			if( 1 > strpos($projectContents,$rsw['email'])){
				$projectContents .='{"email":"'.$rsw['email'].
				'","pp":"http://thanurrr.freehostia.com/'.$rw['pp'].
				'","name":"'.$rw['name'].
				'","age":"'.$rw['age'].
				'","school":"'.$rw['school'].
				'","gender":"'.$rw['gen'].
				'"},';
			}
		}
		echo $projectContents."{}]
		
		
		}" ;
	}
	if(isset($_GET['user'])){
		
		$projectContents = '{ 
		"users": 
		[';
		$result = mysql_query("SELECT * FROM my_user ORDER BY onlineup DESC");
		while($rsw = mysql_fetch_array($result))
		{
			$sql = "SELECT
			*
			FROM
			my_user
			WHERE
			email = '".$rsw['email']."'";
			$reult = mysql_query($sql);
			$rw = mysql_fetch_array($reult);
			$projectContents .='{"name":"'.$rw['name'].
			'","school":"'.$rw['school'].
			'","onlineup":"'.$rw['onlineup'].
			'","pp":"http://thanurrr.freehostia.com/'.$rw['pp'].
			'"},';
		}
		echo $projectContents."]
		
		
		}" ;
	}
	if(isset($_GET['onc'])){
		$sql = "SELECT * FROM my_user WHERE email='".$_GET['onc']."'";
		$result = mysql_query($sql);
		$row =  mysql_fetch_array($result);
		echo $row['onlineup'];
	}
?>
