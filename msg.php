<?php
session_start();

include 'sql.php';
?>
<script src="test_helpers.js" type="text/javascript"></script>
<script src="jquery.js" type="text/javascript"></script>
<script src="jquery.timeago.js" type="text/javascript"></script>
<?php
if(isset($_GET['newmsg'])){
$projectContents ="0";
	$result = mysql_query("SELECT * FROM ".$_SESSION['ue']."_msg ORDER BY time");
		while($rsw = mysql_fetch_array($result))
	{
	if($rsw['seen']=="0"){
	$projectContents .="1";
	}
	}
echo $projectContents;	
}
if(isset($_GET['newmsgs'])){
$projectContents ="";
	$result = mysql_query("SELECT * FROM ".$_SESSION['ue']."_msg ORDER BY time");
		while($rsw = mysql_fetch_array($result))
	{
if($rsw['seen']=="0"){

				if($rsw['email']=="Group"){
						$sql = "SELECT
					*
					FROM
					Groupchat
					WHERE
					msg = '".$rsw['msg']."'";
                $reult = mysql_query($sql);
				$rw = mysql_fetch_array($reult);
				$sql = "SELECT
					*
					FROM
					my_user
					WHERE
					email = '".$rw['email']."'";
                $reult = mysql_query($sql);
				$rw = mysql_fetch_array($reult);
				
						$projectContents .="<hr><h6>You have msg from Group(".$rw['name']."):- ".$rsw['msg']."</h6><hr>";
				}else{
						$sql = "SELECT
					*
					FROM
					my_user
					WHERE
					email = '".$rsw['email']."'";
                $reult = mysql_query($sql);
				$rw = mysql_fetch_array($reult);
						$projectContents .="<hr><h6>You have msg from ".$rw['name'].":- ".$rsw['msg']."</h6><hr>";
				}
	}
	}
echo $projectContents;	
}
if(isset($_GET['stick'])){
$projectContents ="";
	$result = mysql_query("SELECT * FROM stick ORDER BY cat ASC");
		while($rsw = mysql_fetch_array($result))
	{
	$projectContents.="<a style='float:left;' onClick=".'"'."stick('".$rsw['url']."')".'"'." ><img width='64px'  src='".$rsw['url']."'></a>";
	}
echo $projectContents;
}
if(isset($_GET['send'])){
	If($_GET['send']=="Group"){
		$commet = str_ireplace("'","<cc>",$_GET['msg']);
 mysql_query("INSERT INTO Groupchat (email,msg) 
 VALUES ('".$_SESSION['ue']."', '".$commet."')");
	$result = mysql_query("SELECT * FROM my_user");
		while($rsw = mysql_fetch_array($result))
	{				
				$sql = "UPDATE
					".$rsw['email']."_msg
					SET
					msg = '".$commet."'
					WHERE
					email = 'Group'";
				$reult = mysql_query($sql);
					if($rsw['email']==$_SESSION['ue']){
					$sql = "UPDATE
					".$rsw['email']."_msg
					SET
					seen = '1'
					WHERE
					email = 'Group'";
                $reult = mysql_query($sql);
					}else{
					$sql = "UPDATE
					".$rsw['email']."_msg
					SET
					seen = '0'
					WHERE
					email = 'Group'";
                $reult = mysql_query($sql);
					}
				$sql = "UPDATE
					".$rsw['email']."_msg
					SET
					time = CURRENT_TIMESTAMP
					WHERE
					email = 'Group'";
                $reult = mysql_query($sql);
	}
	}else{
$commet = str_ireplace("'","<cc>",$_GET['msg']);
 mysql_query("INSERT INTO ".$_GET['send']."_".$_SESSION['ue']." (email,msg,seen) 
 VALUES ('".$_SESSION['ue']."', '".$commet."','0')");
 mysql_query("INSERT INTO ".$_SESSION['ue']."_".$_GET['send']." (email,msg,seen) 
 VALUES ('".$_SESSION['ue']."', '".$commet."','0')");
 $sql = "SELECT
					*
					FROM
					".$_SESSION['ue']."_msg
					WHERE
					email = '".$_GET['send']."'";
                $reult = mysql_query($sql);
				$rw = mysql_fetch_array($reult);
				if(!($rw['msg'])){
  mysql_query("INSERT INTO ".$_SESSION['ue']."_msg (email,msg,seen) 
 VALUES ('".$_GET['send']."', '".$commet."','0')");
				}
 $sql = "SELECT
					*
					FROM
					".$_GET['send']."_msg
					WHERE
					email = '".$_SESSION['ue']."'";
                $reult = mysql_query($sql);
				$rw = mysql_fetch_array($reult);
				if(!($rw['msg'])){
  mysql_query("INSERT INTO ".$_GET['send']."_msg (email,msg,seen) 
 VALUES ('".$_SESSION['ue']."', '".$commet."','1')");
				}
				
				$sql = "UPDATE
					".$_GET['send']."_msg
					SET
					msg = '".$commet."'
					WHERE
					email = '".$_SESSION['ue']."'";
                $reult = mysql_query($sql);
				$sql = "UPDATE
					".$_GET['send']."_msg
					SET
					seen = '0'
					WHERE
					email = '".$_SESSION['ue']."'";
                $reult = mysql_query($sql);
				$sql = "UPDATE
					".$_SESSION['ue']."_msg
					SET
					msg = '".$commet."'
					WHERE
					email = '".$_GET['send']."'";
				$reult = mysql_query($sql);
				$sql = "UPDATE
					".$_SESSION['ue']."_msg
					SET
					seen = '1'
					WHERE
					email = '".$_GET['send']."'";
                $reult = mysql_query($sql);
				$sql = "UPDATE
					".$_GET['send']."_msg
					SET
					time = CURRENT_TIMESTAMP
					WHERE
					email = '".$_SESSION['ue']."'";
                $reult = mysql_query($sql);
				$sql = "UPDATE
					".$_SESSION['ue']."_msg
					SET
					time = CURRENT_TIMESTAMP
					WHERE
					email = '".$_GET['send']."'";
                $reult = mysql_query($sql);
	}				
}
if(isset($_GET['onof'])){
				$sql = "SELECT
					*
					FROM
					my_user
					WHERE
					email = '".$_SESSION['ue']."'";
$result = mysql_query($sql);
if(isset($_SESSION['ue']) && $result ){
$rsw = mysql_fetch_array($result);
if($rsw['online']=="1"){
				$sql = "UPDATE
					my_user
					SET
					online = '0'
					WHERE
					email = '".$_SESSION['ue']."'";
                $reult = mysql_query($sql);
}else{
				$sql = "UPDATE
					my_user
					SET
					online = '1'
					WHERE
					email = '".$_SESSION['ue']."'";
                $reult = mysql_query($sql);				
}
}
printf("<script>location.href='index.php'</script>");
}
if(isset($_GET['on'])){
				$sql = "SELECT
					*
					FROM
					my_user
					WHERE
					email = '".$_SESSION['ue']."'";
$result = mysql_query($sql);
if(isset($_SESSION['ue']) && $result ){
$rsw = mysql_fetch_array($result);
if($rsw['online']=="1"){
				$sql = "UPDATE
					my_user
					SET
					onlineup = CURRENT_TIMESTAMP
					WHERE
					email = '".$_SESSION['ue']."'";
                $reult = mysql_query($sql);
}				
}
}
if(isset($_GET['onc'])){
				$sql = "SELECT
					*
					FROM
					my_user
					WHERE
					email = '".$_GET['onc']."'";
                $result = mysql_query($sql);
				$rsw = mysql_fetch_array($result);
				$rsand = round(rand(0,800000000));
				$timett = $rsw['onlineup'];
				echo $timett;
}
if(isset($_GET['getmsg'])){
if($_GET['getmsg']=='Group'){
	    $sql = "CREATE TABLE Groupchat (
 email varchar(15),
 msg varchar(2000),
 time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP PRIMARY KEY)";
  $reult = mysql_query($sql);
  				$sql = "UPDATE
				".$_SESSION['ue']."_msg
					SET
					seen = '1'
					WHERE
					email = '".$_GET['getmsg']."'";
                $reult = mysql_query($sql);	
  $projectContents="";
  	$result = mysql_query("SELECT * FROM Groupchat ORDER BY time DESC LIMIT 0 , 10");
		while($rsw = mysql_fetch_array($result))
	{
	$rsand = round(rand(0,800000000));
					$timett='
				<div class="ti"  style="font-size: 8pt;"  id="prog_'.$rsand.'"  ></div>	
				<script type="text/javascript">
						$("#prog_'.$rsand.'").text(jQuery.timeago("'.$rsw['time'].'"));
				</script>
				';
					$sql = "SELECT
					*
					FROM
					my_user
					WHERE
					email = '".$rsw['email']."'";
                $reult = mysql_query($sql);
				$rw = mysql_fetch_array($reult);
				$chek='';
	if($_SESSION['ue']==$rsw['email']){
	 $projectContents ='
                                <li class="bg-color-blue" style="left:30%;margin-bottom:2px;min-height: 80px;width:260px;" >'.$chek.'								
                                    <b class="sticker sticker-right sticker-color-blue"></b>
                                    <div class="avatar"><img src="'.$rw['pp'].'" style="border: 2px solid #ffffff;left:10px;" height="100px;" ></div>
                                    <div class="reply">
                                        <div class="date" id="date" >'.$timett.'</div>
                                        <div class="author">Me:</div>
                                        <div class="text">'.smile($rsw['msg']).'</div>
                                    </div>
                                </li>
     
	'.$projectContents;
	}else{
		 $projectContents ='
                                <li class="bg-color-red" style="margin-bottom:2px;min-height:80px;width:260px;" >'.$chek.'
                                    <b class="sticker sticker-left sticker-color-red"></b>
                                    <div class="avatar"><img src="'.$rw['pp'].'" style="border: 2px solid #ffffff;left:10px;" height="100px;" ></div>
                                    <div class="reply">
                                        <div class="date" id="date" >'.$timett.'</div>
                                        <div class="author">'.$rw['name'].':</div>
                                        <div class="text">'.smile($rsw['msg']).'</div>
                                    </div>
                                </li>
     
	'.$projectContents;
	}
	}
	echo $projectContents;
	
}else{
				$sql = "UPDATE
					".$_GET['getmsg']."_".$_SESSION['ue']."
					SET
					seen = '1'
					WHERE
					email = '".$_GET['getmsg']."'";
                $reult = mysql_query($sql);
				$sql = "UPDATE
				".$_SESSION['ue']."_msg
					SET
					seen = '1'
					WHERE
					email = '".$_GET['getmsg']."'";
                $reult = mysql_query($sql);					
$projectContents ='';
      $sql = "CREATE TABLE ".$_SESSION['ue']."_".$_GET['getmsg']."
 (
 email varchar(15),
 msg varchar(2000) ,
 time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP PRIMARY KEY,
 seen varchar(2)
 )";
  $reult = mysql_query($sql);
       $sql = "CREATE TABLE ".$_GET['getmsg']."_".$_SESSION['ue']."
 (
 email varchar(15),
 msg varchar(2000),
 time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP PRIMARY KEY ,
 seen varchar(2)
 )";
 $reult = mysql_query($sql);
 $result = mysql_query("SELECT * FROM ".$_SESSION['ue']."_".$_GET['getmsg']." ORDER BY time DESC LIMIT 0 ,10");
		while($rsw = mysql_fetch_array($result))
	{
	$rsand = round(rand(0,800000000));
					$timett='
				<div class="ti"  style="font-size: 8pt;"  id="prog_'.$rsand.'"  ></div>	
				<script type="text/javascript">
						$("#prog_'.$rsand.'").text(jQuery.timeago("'.$rsw['time'].'"));
				</script>
				';
					$sql = "SELECT
					*
					FROM
					my_user
					WHERE
					email = '".$rsw['email']."'";
                $reult = mysql_query($sql);
				$rw = mysql_fetch_array($reult);
				if($rsw['seen']=="1"){
				$chek='<div class="badge bg-color-blue right bottom"><i class="icon-checkmark"></i></div>';
				}else{
				$chek='';
				}
	if($_SESSION['ue']==$rsw['email']){
	 $projectContents ='
                                <li class="bg-color-blue" style="left:30%;margin-bottom:2px;min-height: 80px;width:260px;" >'.$chek.'								
                                    <b class="sticker sticker-right sticker-color-blue"></b>
                                    <div class="avatar"><img src="'.$rw['pp'].'" style="border: 2px solid #ffffff;left:10px;" height="100px;" ></div>
                                    <div class="reply">
                                        <div class="date" id="date" >'.$timett.'</div>
                                        <div class="author">Me:</div>
                                        <div class="text">'.smile($rsw['msg']).'</div>
                                    </div>
                                </li>
     
	'.$projectContents;
	}else{
		 $projectContents ='
                                <li class="bg-color-red" style="margin-bottom:2px;min-height:80px;width:260px;" >'.$chek.'
                                    <b class="sticker sticker-left sticker-color-red"></b>
                                    <div class="avatar"><img src="'.$rw['pp'].'" style="border: 2px solid #ffffff;left:10px;" height="100px;" ></div>
                                    <div class="reply">
                                        <div class="date" id="date" >'.$timett.'</div>
                                        <div class="author">'.$rw['name'].':</div>
                                        <div class="text">'.smile($rsw['msg']).'</div>
                                    </div>
                                </li>
     
	'.$projectContents;
	}
	}
	echo $projectContents;
}
}

?>