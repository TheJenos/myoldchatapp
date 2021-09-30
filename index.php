<?php
	session_start();
	include("header.php");
	include 'sql.php';
?>
<script src="test_helpers.js" type="text/javascript"></script>
<script src="jquery.js" type="text/javascript"></script>
<script src="jquery.timeago.js" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function(){
		function noti(){
			var oldscrollHeight = $("lo").attr("scrollHeight") - 20;
			$.ajax({
				url: "msg.php?msglist",
				cache: false,
				success: function(html){		
					$("#lso").html(html); //Insert chat log into the #chatbox div								
				},									
			});
		}
		tier=setInterval (noti, 3000);
		function nosti(){
			if(($( window ).width())>620){
				$("#log").css({left:'25%'},"fast");
				$("#log").animate({width:'50%'},"fast");
				<?php
					if(isset($_GET['War'])){
					?>
					$("#logc").animate({height:'1000%'},"fast");
					<?php
						}else{
					?>
					$("#logc").animate({height:'100%'},"fast");
					<?php
					}
				?>
				$("#logc").css({left:'25%'},"fast");
				$("#logc").animate({width:'50%'},"fast");
				}else{
				$("#log").css({left:'0%'},"fast");
				$("#log").animate({width:'100%'},"fast");
				<?php
					if(isset($_GET['War'])){
					?>
					$("#logc").animate({height:'1000%'},"fast");
					<?php
						}else{
					?>
					$("#logc").animate({height:'100%'},"fast");
					<?php
					}
				?>
				$("#logc").css({left:'-10px'},"fast");
				$("#logc").animate({width:'103%'},"fast");
			}	
			$("sspan").hide();
			$("iframe").hide();
			$("#mseag").animate({top:'0%'},"fast");	
			$.ajax({
				url: "msg.php?on",
				cache: false,
				success: function(html){		
					$("#slso").html(html); //Insert chat log into the #chatbox div								
				},									
			});
		}
		setInterval (nosti, 1000);
		$("#staticDialog").click(function(){
			$.ajax({
				url: "msg.php?stick",
				cache: false,
				success: function(html){		
					$("#stick").html(html); //Insert chat log into the #chatbox div								
				},									
			});
			
		});
		$("#msgbu").click(function(){
			var oldscrollHeight = $("#msgt").val();
			$.ajax({
				url: "msg.php?send=<?php if(isset($_GET['on'])){ echo $_GET['on']; } ?>&msg="+oldscrollHeight ,
				cache: false,
				success: function(html){
					$("#msgt").attr("value", "");
				},			
			});
		});
		$("#msgt").keypress(function(e) {
			if (e.keyCode == 13) {
				var oldscrollHeight = $("#msgt").val();
				$.ajax({
					url: "msg.php?send=<?php if(isset($_GET['on'])){ echo $_GET['on']; } ?>&msg="+oldscrollHeight ,
					cache: false,
					success: function(html){
						$("#msgt").attr("value", "");
					},			
				});
			}});
	});
	function stick(num){
		$.ajax({
			url: "msg.php?send=<?php if(isset($_GET['on'])){ echo $_GET['on']; } ?>&msg="+'<img width="64px" src="'+num+'">' ,
			cache: false,		
		});
	}
</script>
<style>
	body{
	background-color: navy;
	text-align: center;
	margin:0;
	padding:0; 
	padding-left:0px;
	}
</style>
<?php
	if(isset($_COOKIE["un"])){
		$sql = "SELECT
		*
		FROM
		my_user
		WHERE
		email = '".$_COOKIE["un"]."'";
		$result = mysql_query($sql);
		
		if($result){
			$row = mysql_fetch_array($result);
			if(($_COOKIE["up"]==$row['pass'])){
				$_SESSION['ue'] = $_COOKIE["un"];
				$_SESSION['up'] = $_COOKIE["up"];
			}
		}
	}
	if(isset($_GET['enter'])){
		if($_POST['un'] != ""){
			$_SESSION['ue'] = stripslashes(htmlspecialchars($_POST['un']));
			$_SESSION['up'] = stripslashes(htmlspecialchars($_POST['up']));
//			setcookie("un", $_SESSION['ue'],time() + (86400 * 14));
//			setcookie("up", $_SESSION['up'],time() + (86400 * 14));
		}
		else{
			echo '<span class="error">Please type in a name</span>';
		}
	}
	if(isset($_GET['un'])){
		if($_GET['un'] != ""){
			$_SESSION['ue'] = stripslashes(htmlspecialchars($_GET['un']));
			$_SESSION['up'] = stripslashes(htmlspecialchars($_GET['up']));
//			setcookie("un", $_SESSION['ue'],time() + (86400 * 14));
//			setcookie("up", $_SESSION['up'],time() + (86400 * 14));
			printf("<script>location.href='index.php'</script>");
		}
		else{
			
			echo '<span class="error">Please type in a name</span>';
		}
	}
	if(isset($_GET['logout'])){	
		//Simple exit message  
        $_SESSION['up']="";
		$fp = fopen("log.html", 'a');
		fwrite($fp, '<div class="msgln" style="margin-top:2px;margin-left:3px;border: 3px solid #ffffff;width:95%;text-align:left;padding:2px;" ><i>User '. $_SESSION['un'] .' has left the chat session.</i><br></div>');
		fclose($fp);
//        setcookie("un","", time() + (86400 * 14));
//        setcookie("up","", time() + (86400 * 14));
		session_destroy();
		printf("<script>location.href='index.php'</script>"); //Redirect the user
	}
	if(isset($_SESSION['ue'])){
		$sql = "SELECT
		*
		FROM
		my_user
		WHERE
		email = '".$_SESSION['ue']."'";
		$result = mysql_query($sql);
	}
	if(isset($_SESSION['ue']) && $result ){
		$row = mysql_fetch_array($result);
		if ($_SESSION['up']==$row['pass']){
			$_SESSION['un']=$row['name'];
			$_SESSION['pp']=$row['pp'];
		?>
		<div id="logc" style="position:relative;padding:10px;background:#ffffff;text-align:left;margin: 0px;"  >
			<div class="nav-bar">
				<div class="nav-bar-inner">
					<h2 class="element">Welcome <?php echo $row['name']; ?>
					</h2>
				</div>
				
			</div>
			<script type="text/javascript">
				function nossdti(){
					var oldscrollHeight = $("#boxr").attr("scrollHeight") - 20;
					$.ajax({
						url: "msg.php?newmsgs",
						cache: false,
						success: function(html){		
							$("#boxr").html(html); //Insert chat log into the #chatbox div			
							var newscrollHeight = $("#boxr").attr("scrollHeight") - 20;
							if(newscrollHeight > oldscrollHeight){
								$("#boxr").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
								$("#boxr").animate({height: "50px"}, 1000);
								$("#boxr").animate({height: "0px"}, 2000);				 
							} 
						},									
					});
				}
				tier=setInterval (nossdti, 3000);
			</script>
			<div id="boxr" Style="position:relative;left:0px;width:100%;padding:0px;height:0px;overflow:hidden;">
				<?php
					$projectContents ="";
					$result = mysql_query("SELECT * FROM ".$_SESSION['ue']."_msg ORDER BY time");
					while($rsw = mysql_fetch_array($result))
					{
						if($rsw['seen']=="0"){
							
							if($rsw['email']="Group"){
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
				?>
			</div>	
			<div id="lo" style="margin-top:10px;"  >
				<a href="index.php"><button style="padding:2px;color:#ffffff;margin:0px 0px 5px;background-color: #00A300 !important;" class="tool-button">
					<script type="text/javascript">
						function not(){
							$.ajax({
			                    url: "msg.php?newmsg=<?php echo $_SESSION['ue']; ?>",
			                    cache: false,
								success: function(html){
									if(html.length=="186"){  								
										$("#pro").html('<i style="font-size:24px;" class="icon-home"></i>'); //Insert chat log into the #chatbox div
										}else{
										$("#pro").html('<i style="font-size:24px;" class="icon-mail-2"></i>'); //Insert chat log into the #chatbox div
										$("#pro").animate({opacity:0},200,"linear",function(){$(this).animate({opacity:1},200);});
									}			
								},									
							});
						}
						tier=setInterval (not, 1000);
					</script>
					<div class=""   style=""  id="pro"  ></div>
				</button></a>
				<a href="?news"><button style="padding:2px;color:#ffffff;margin:0px 0px 5px;background-color: #00A300 !important;" class="tool-button"><i style="font-size:24px;" class="icon-trophy"></i></button></a>
				<a href="?set"><button style="padding:2px;color:#ffffff;margin:0px 0px 5px;background-color: #00A300 !important;" class="tool-button"><i style="font-size:24px;" class="icon-equalizer"></i></button></a>
				<a href="?logout"><button style="padding:2px;color:#ffffff;margin:0px 0px 5px;background-color: #00A300 !important;" class="tool-button"><i style="font-size:24px;" class="icon-switch"></i></button></a> 
				<a href="msg.php?onof"><button style="padding:2px;color:#ffffff;margin:0px 0px 5px;background-color: #00A300 !important;" class="tool-button">
					<?php if($row['online']=="1"){ ?>
						<i style="font-size:24px;" class="icon-heart"></i>
						<?php }else{ ?>
						<i style="font-size:24px;" class="icon-heart-2"></i>
					<?php } ?>
				</button></a>
				<a href="?War"><button style="padding:2px;color:#ffffff;margin:0px 0px 5px;background-color: #00A300 !important;" class="tool-button"><i style="font-size:24px;" class="icon-target-2"></i></button></a>		
				<ul class="listview" style="margin-left: 0px;">
					<?php
						if(isset($_GET['on'])){
							if($_GET['on']==""){
								printf("<script>location.href='index.php'</script>");
							}
						?>
						<script type="text/javascript">
							function nossti(){
								var oldscrollHeight = $("#box").attr("scrollHeight") - 20;
								$.ajax({
									url: "msg.php?getmsg=<?php echo $_GET['on']; ?>",
									cache: false,
									success: function(html){		
										$("#lsoo").html(html); //Insert chat log into the #chatbox div								
										var newscrollHeight = $("#box").attr("scrollHeight") - 20;
										if(newscrollHeight > oldscrollHeight){
											$("#box").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
										} 
									},									
								});
							}
							tier=setInterval (nossti, 3000);
						</script>
						<?php 
							if($_GET['on']<>"Group"){
							?>
							<script type="text/javascript">
								function not(){
									$.ajax({
										url: "msg.php?onc=<?php echo $_GET['on']; ?>",
										cache: false,
										success: function(html){
											if(jQuery.timeago(html)=="Few seconds ago"){  								
												$("#progrrsand").html("Online"); //Insert chat log into the #chatbox div
												}else{
												$("#progrrsand").html(jQuery.timeago(html)); //Insert chat log into the #chatbox div
											}								
										},									
									});
								}
								tier=setInterval (not, 1000);
							</script>
							<a href="?pro=<?php echo $_GET['on']; ?>"> 
								<?php
								}
								$sql = "SELECT
								*
								FROM
								my_user
								WHERE
								email = '".$_GET['on']."'";
								$reult = mysql_query($sql);
								$rw = mysql_fetch_array($reult);
								echo $rw['name'];
							?>
						</a><div class=""   style="font-size: 8pt;color:red;"  id="progrrsand"  ></div>
						<div id="box" Style="position:relative;left:0px;width:100%;padding:0px;height:370px;overflow:scroll;">
							<hr>
							<ul class="replies" style="font-size: 8pt;min-width:80px;" >
								<div class="ti" style="width:10%;font-size: 8pt;min-width:80px;" id="lsoo"></div>
							</ul>
						</div>
						<div class="input-control text " id="msgtb" style="width:100%;text-align:left;color:#ffffff" >
							<input  name="uns" id="msgt" type="text" />
							<button class="btn-clear"></button>
						</div><input type="button" id="msgbu" value="Send"  >
						<button id="staticDialog">Stickers</button>
						<div id="stick" >
							
						</div>								
						<?php
							}else if(isset($_GET['ewar'])){	
							if(isset($_GET['Set'])){
								$sql = "UPDATE
								".$_GET['waR']."_war
								SET
								base = '".htmlspecialchars($_POST['base'])."'
								WHERE
								no = '".$_GET['ewar']."'";
								$reult = mysql_query($sql);
								$sql = "UPDATE
								".$_GET['waR']."_war
								SET
								dis = '".htmlspecialchars($_POST['dis'])."'
								WHERE
								no = '".$_GET['ewar']."'";
								$reult = mysql_query($sql);
								$sql = "UPDATE
								".$_GET['waR']."_war
								SET
								1s = '".htmlspecialchars($_POST['1s'])."'
								WHERE
								no = '".$_GET['ewar']."'";
								$reult = mysql_query($sql);
								$sql = "UPDATE
								".$_GET['waR']."_war
								SET
								2n = '".htmlspecialchars($_POST['2n'])."'
								WHERE
								no = '".$_GET['ewar']."'";
								$reult = mysql_query($sql);
								$sql = "UPDATE
								".$_GET['waR']."_war
								SET
								sta = '".htmlspecialchars($_POST['sta'])."'
								WHERE
								no = '".$_GET['ewar']."'";
								$reult = mysql_query($sql);
								printf("<script>location.href='index.php?war=".$_GET['waR']."'</script>");
							}
							$sql = "SELECT
							*
							FROM
							".$_GET['waR']."_war
							WHERE
							no = '".$_GET['ewar']."'";
							$reult = mysql_query($sql);
							$rw = mysql_fetch_array($reult);
						?>	
						<form action="index.php?waR=<?php echo $_GET['waR']; ?>&ewar=<?php echo $_GET['ewar']; ?>&Set=" method="post">
							<hr>
							Name - <input type="text" name="base" value="<?php echo $rw['base']; ?>"><hr>
							Discription - <textarea name="dis" ><?php echo $rw['dis']; ?></textarea><hr>
							1st Attack - <input type="text" style=" width: 70px;" name="1s" value="<?php echo $rw['1s']; ?>">
							2st Attack - <input type="text" style=" width: 70px;" name="2n" value="<?php echo $rw['2n']; ?>"><hr>
							Percentage - <input type="text" name="pre" value="<?php echo $rw['pre']; ?>">
							Stars      - <input type="text" style=" width: 15px;" name="sta" value="<?php echo $rw['sta']; ?>"><hr>
							<hr>
							<input type="submit" name="enter" id="enter" value="Save" /><br>  
							<hr>
						</form>
						<?php
							}else if(isset($_GET['end'])){
							$count=0;
							$rrr = mysql_query("SELECT * FROM ".$_GET['end']."_war ORDER BY no DESC");
							while($www = mysql_fetch_array($rrr))
							{
								$count = $count+1;
							}	
							$sql = "SELECT
							*
							FROM
							warlist
							WHERE
							war = '".$_GET['end']."'";
							$reult = mysql_query($sql);
							$rw = mysql_fetch_array($reult);
							$nunn = (int)$rw['os'];
							if($nunn < $count ){
								$sql = "UPDATE
								warlist
								SET
								vic = '1'
								WHERE
								war = '".$_GET['end']."'";
								$reult = mysql_query($sql);
								}else{
								$sql = "UPDATE
								warlist
								SET
								vic = '2'
								WHERE
								war = '".$_GET['end']."'";
								$reult = mysql_query($sql);
							}
							printf("<script>location.href='index.php?War'</script>");
							}else if(isset($_GET['adwar'])){
							if(isset($_GET['SEt'])){
								$sql = "CREATE TABLE ".$_POST['wat']."_war
								(
								no INT PRIMARY KEY,
								base TEXT,
								dis TEXT,
								1s TEXT,
								2n TEXT,
								pre TEXT,
								sta TEXT
								)";
								// Execute query
								mysql_query($sql,$con);
								mysql_query("INSERT INTO warlist (war,vic,os) 
								VALUES ('".$_POST['wat']."', '0','0')");
								
								for($x=1; $x<=$_POST['wart']; $x++){
									mysql_query("INSERT INTO ".$_POST['wat']."_war (no,base,dis,1s,2n,pre,sta) 
									VALUES ('".$x."','0','0','0','0','0','0')");
								}
								printf("<script>location.href='index.php?war=".$_POST['wat']."'</script>");
							}
						?>	
						<form action="index.php?adwar=&SEt=" method="post">
							<hr>
							Name - <input type="text" name="wat" value=""><hr>
							War Type - <input type="text" name="wart" value=""><hr>
							<input type="submit" name="enter" id="enter" value="Save" /><br>  
							<hr>
						</form>
						<?php
							}else if(isset($_GET['war'])){
							if(isset($_GET['SET'])){
								$sql = "UPDATE
								warlist
								SET
								os = '".$_POST['wat']."'
								WHERE
								war = '".$_GET['war']."'";
								$reult = mysql_query($sql);
								printf("<script>location.href='index.php?war=".$_GET['war']."'</script>");
							}
							$sql = "SELECT
							*
							FROM
							warlist
							WHERE
							war = '".$_GET['war']."'";
							$reult = mysql_query($sql);
							$rw = mysql_fetch_array($reult);
							if($rw['vic']==0){
								$projectContents ='<h2><center>'.$_GET['war'].'('.$rw['os'].')</center></h2>
								<a href="?end='.$_GET['war'].'"><button class="image-button bg-color-darken fg-color-white">End The War<i class="icon-cancel bg-color-red"></i></button></a>
								<form action="index.php?war='.$_GET['war'].'&SET=" method="post">
								'.$_GET['war'].' Stars- <input type="text" name="wat" value="">
								<input type="submit" name="enter" id="enter" value="Save" /> 
								</form>
								';
								}else{
								$projectContents ='<h2><center>'.$_GET['war'].'('.$rw['os'].')</center></h2>';	
							}
							$result = mysql_query("SELECT * FROM ".$_GET['war']."_war ORDER BY no ASC ");
							while($rsw = mysql_fetch_array($result))
							{
								$rsand = round(rand(10,99)).round(rand(10,99)).round(rand(10,99));
								$projectContents .='
								<li style="width:100%;border: 4px #'.$rsand.' solid;" >
								<a href="?ewar='.$rsw['no'].'&waR='.$_GET['war'].'"><div class="badge bg-color-green right bottom">
								Edit
								</div></a>
								<div class="badge bg-color-green right top" style="font-size: 8pt;" >'.$rsw['pre'].'
								</div>
								<div class="notice-header "><h4>('.$rsw['no'].') '.$rsw['base'].'</h4>
								<div class="rating small fg-color-white " data-role="rating" data-param-vote="off" data-param-rating="'.$rsw['sta'].'" data-param-stars="3">
								</div></div>
								<div class="notice-text">
								1st Attack - '.$rsw['1s'].'        2nd Attack - '.$rsw['2n'].'<hr>
								'.smile($rsw['dis']).'</div>
								</li>
								';
							}
							echo $projectContents ;
							}else if(isset($_GET['War'])){
							$projectContents ='
							<a href="?adwar"><button class="image-button bg-color-darken fg-color-white">Add A War<i class="icon-target-2 bg-color-red"></i></button></a>
							';
							$result = mysql_query("SELECT * FROM warlist ORDER BY day DESC");
							while($rsw = mysql_fetch_array($result))
							{
								$count=0;
								$strs=0;
								$xtx='';
								$rrr = mysql_query("SELECT * FROM ".$rsw['war']."_war ORDER BY no ASC");
								while($www = mysql_fetch_array($rrr))
								{
									$count = $count+1;
									$strs = $strs+ $www['sta'] ;
									$xtx .= '('.$www['no'].') '.$www['base'].'<div class="rating small"  data-role="rating" data-param-vote="off" data-param-rating="'.$www['sta'].'" data-param-stars="3"> </div>';
								}		
								if($rsw['vic']==0){      
									$stt = '<div class="badge alert"></div>';
									}else if($rsw['vic']==1){
									$stt = '';	
									}else if($rsw['vic']==2){
									$stt = '<div class="badge error"></div>';
								}	
								$projectContents .='
								<a href="?war='.$rsw['war'].'">
								<div class="tile double fg-color-red " Style="width: 100%;  height: 500px;" >
								<div class="brand">
								'.$stt.'
								</div>
								<div class="tile-content">
								<h3 style="margin-bottom: 5px;">2015 A/l Batch('.$strs.'/'.($count)*3 .') Vs '.$rsw['war'].'('.$rsw['os'].'/'.($count)*3 .')</h3>
								<p>
								'.$xtx.'
								</p>
								
								</div>
								</div>
								</div>
								</a>
								';
								
							}
							echo $projectContents ;
						?>
						<?php
							}else if(isset($_GET['set'])){
							if (isset($_FILES["file"])){
								if ($_FILES["file"]["error"] > 0)
								{
									echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
								}
								else
								{
									echo "source: " . $_FILES["file"]["name"] . "<br />";
									echo "Type: " . $_FILES["file"]["type"] . "<br />";
									echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
									echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
									
									if (file_exists($_POST["name"]."/pic/" . $_FILES["file"]["name"]))
									{
										echo $_FILES["file"]["name"] . " already exists. ";
									}
									else
									{
										move_uploaded_file($_FILES["file"]["tmp_name"],"pic/" . $_FILES["file"]["name"]);
										$sql = "UPDATE
										my_user
										SET
										pp = '"."pic/" . $_FILES["file"]["name"]."'
										WHERE
										email = '".$_SESSION['ue']."'";
										$reult = mysql_query($sql);
										echo "Stored in: ".$_POST["name"]."/pic/". $_FILES["file"]["name"];
									}
								}
							}
							if(isset($_GET['re'])){ 
								$sql = "UPDATE
								my_user
								SET
								name = '".htmlspecialchars($_POST['name'])."'
								WHERE
								email = '".$_SESSION['ue']."'";
								$reult = mysql_query($sql);
								$sql = "UPDATE
								my_user
								SET
								gen = '".htmlspecialchars($_POST['gen'])."'
								WHERE
								email = '".$_SESSION['ue']."'";
								$reult = mysql_query($sql);
								$sql = "UPDATE
								my_user
								SET
								age = '".htmlspecialchars($_POST['age'])."'
								WHERE
								email = '".$_SESSION['ue']."'";
								$reult = mysql_query($sql);
								$sql = "UPDATE
								my_user
								SET
								school = '".htmlspecialchars($_POST['school'])."'
								WHERE
								email = '".$_SESSION['ue']."'";
								$reult = mysql_query($sql);				
							}
							$sql = "SELECT
							*
							FROM
							my_user
							WHERE
							email = '".htmlspecialchars($_SESSION['ue'])."'";
							$reult = mysql_query($sql);
							$rw = mysql_fetch_array($reult);
							?> <div class="page snapped">
							<img src="<?php echo $rw['pp']; ?>" width="100%" >
							<hr>
							<script type="text/javascript">
								function not(){
									$.ajax({
										url: "msg.php?onc=<?php echo $_SESSION['ue']; ?>",
										cache: false,
										success: function(html){
											if(jQuery.timeago(html)=="Few seconds ago"){  								
												$("#progrrsand").html("Online"); //Insert chat log into the #chatbox div
												}else{
												$("#progrrsand").html(jQuery.timeago(html)); //Insert chat log into the #chatbox div
											}								
										},									
									});
								}
								tier=setInterval (not, 1000);
							</script>
							<div class=""   style="font-size: 8pt;color:red;"  id="progrrsand"  ></div>
						</div>
						<div class="page fill">
							<form action="index.php?re=&set" method="post">
								<h6>Name - <input type="text" name="name" value="<?php echo $rw['name']; ?>"></h6>
								<hr>
								Birth Date - <input type="text" name="age" value="<?php echo $rw['age']; ?>"><br>
								Gender - <input type="text" name="gen" value="<?php echo $rw['gen']; ?>"><br>
								School - <input type="text" name="school" value="<?php echo $rw['school']; ?>"><br>	<input type="submit" name="enter" id="enter" value="Save" /><br>
							</form> 
							<form action="index.php?set" method="post"
							enctype="multipart/form-data">
								<label for="file">Profile Picture:</label>
								<input type="file" name="file" id="file"><br>
								<input type="submit" name="submit" value="Submit">
							</form>
							
						</div>
						
						<?php
							}else if(isset($_GET['pro'])){
							$sql = "SELECT
							*
							FROM
							my_user
							WHERE
							email = '".$_GET['pro']."'";
							$reult = mysql_query($sql);
							$rw = mysql_fetch_array($reult);
						?>
						<div class="page snapped">
							<img src="<?php echo $rw['pp']; ?>" width="100%" >
							<hr>
							<script type="text/javascript">
								function not(){
									$.ajax({
										url: "msg.php?onc=<?php echo $_GET['pro']; ?>",
										cache: false,
										success: function(html){
											if(jQuery.timeago(html)=="Few seconds ago"){  								
												$("#progrrsand").html("Online"); //Insert chat log into the #chatbox div
												}else{
												$("#progrrsand").html(jQuery.timeago(html)); //Insert chat log into the #chatbox div
											}								
										},									
									});
								}
								tier=setInterval (not, 1000);
							</script>
							<div class=""   style="font-size: 8pt;color:red;"  id="progrrsand"  ></div>
						</div>
						<div class="page fill">
							<h2><?php echo $rw['name']; ?></h2>
							<hr>
							Birth Date-<?php echo $rw['age']; ?><br>
							Gender-<?php echo $rw['gen']; ?><br>
							School-<?php echo $rw['school']; ?><br>
							<hr>
							About me<p><?php echo $rw['dis']; ?></p>
						</div>
						<?php
							}else if(isset($_GET['news'])){
							$projectContents ="";
							$sql = "CREATE TABLE news
							(
							email varchar(15),
							msg varchar(200),
							time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP PRIMARY KEY,
							rating varchar(20),
							rated_users text
							)";
							if($_GET['news']=="add"){
								mysql_query("INSERT INTO news (email,msg,rating,rated_users) 
								VALUES ('".$_SESSION['ue']."', '".$_POST['name']."','0','')");
								printf("<script>location.href='index.php?news'</script>");
							}
							// Execute query
							mysql_query($sql,$con);
							$result = mysql_query("SELECT * FROM news ORDER BY time DESC");
							
							while($rsw = mysql_fetch_array($result))
							{
								$rsand = round(rand(0,800000000));
								$timett='
								<script type="text/javascript">
								function not'.$rsand.'(){
								$("#prog_'.$rsand.'").text(jQuery.timeago("'.$rsw['time'].'"));
								}
								tier=setInterval (not'.$rsand.', 1000);
								</script>
								<div class="ti"  style="font-size: 8pt;"  id="prog_'.$rsand.'"  ></div>
								';
								$rsand = round(rand(0,800000000));
								$timest='
								<script type="text/javascript">
								function not'.$rsand.'(){
								$.ajax({
			                    url: "msg.php?onc='.$rsw['email'].'",
			                    cache: false,
								success: function(html){
                                if(jQuery.timeago(html)=="Few seconds ago"){  								
								$("#prog_'.$rsand.'").html("Online"); //Insert chat log into the #chatbox div
                                }else{
								$("#prog_'.$rsand.'").html(jQuery.timeago(html)); //Insert chat log into the #chatbox div
                                }								
								},									
								});
								}
								tier=setInterval (not'.$rsand.', 1000);
								</script>
								<div class=""   style="font-size: 8pt;"  id="prog_'.$rsand.'"  ></div>
								';
								$sql = "SELECT
								*
								FROM
								my_user
								WHERE
								email = '".$rsw['email']."'";
								$reult = mysql_query($sql);
								$rw = mysql_fetch_array($reult);
								$nag="";
								if($rsw['email']=="Group"){
									$nag = "Group";
									$timest = "";
									}else{
									$nag = $rw['name'] ;
								}
								$sqll="SELECT * FROM news WHERE time='".$rsw['time']."' AND rated_users LIKE '%".$_SESSION['ue']."%'";
								$resultt = mysql_query($sqll);
								$rsws = mysql_fetch_array($resultt);
								if(Count($rsws) < 2){
									$rating = "";
									for($i=0;$i < 5;$i++){
									$rating .= '<a href="header.php?news_add&rate='.($i+1).'&time='.$rsw['time'].'"><button style="float:right;padding:2px;color:#ffffff;margin:0px 2px 1px;background-color: #00A300 !important;" class="tool-button">+'.($i+1).'</button></a>';
									}
								}else{
									$rating = "";
								}
								$rsand = round(rand(10,99)).round(rand(10,99)).round(rand(10,99));
								$projectContents .='
								<a>
								<li style="width:100%;border: 4px #'.$rsand.' solid;" >
								<div class="badge bg-color-green right bottom">'.$timett.'</div>
								<div class="badge bg-color-green right top" style="font-size: 8pt;" >'.$timest.'</div>
								<div class="icon"><img src="'.$rw['pp'].'" style="border: 2px solid #ffffff;left:10px;" height="100px;" ></div>
								<div class="data"><h4>'.$nag.'</h4><p style="color:#000000" >
								'.smile($rsw['msg']).'</p>
								<div style="float:left" class="rating" data-static="true" data-role="rating" 	data-score-title="Rate : " data-value="'.$rsw['rating'].'" data-size="large" data-size="small" data-on-rate="demo_func_onRate"></div>
								'.$rating.'
						</li>
						</a>
						';
						
						}			
						
						echo $projectContents ; ?>
					</ul>
					<form action="index.php?news=add" method="post">
						Post - <input type="text" name="name" value="">	<input type="submit" name="enter" id="enter" value="Send" /><br>  						
					</form>
					<?php
						}else{
						$projectContents ="";
						$result = mysql_query("SELECT * FROM ".$_SESSION['ue']."_msg ORDER BY time DESC");
						
						while($rsw = mysql_fetch_array($result))
						{
							$rsand = round(rand(0,800000000));
							
							if($rsw['seen']=="1"){
								$timets='';
								}else{
								if($rsw['email']<>"
								
								"){
									$count=0;
									$rrr = mysql_query("SELECT * FROM ".$_SESSION['ue']."_".$rsw['email']." ORDER BY time DESC");
									while($www = mysql_fetch_array($rrr))
									{
										if($www['seen']=="0"){
											$count = $count+1;
										}
									}	
									}else{
									$count="New";
								}
								
								$timets='<div class="badge">('.$count.')</div>';
							}
							$timett='
							<script type="text/javascript">
							function not'.$rsand.'(){
							$("#prog_'.$rsand.'").text(jQuery.timeago("'.$rsw['time'].'"));
							}
							tier=setInterval (not'.$rsand.', 1000);
							</script>
							<div class="ti"  style="font-size: 8pt;"  id="prog_'.$rsand.'"  ></div>
							';
							$rsand = round(rand(0,800000000));
							$timest='
							<script type="text/javascript">
							function not'.$rsand.'(){
							$.ajax({
							url: "msg.php?onc='.$rsw['email'].'",
							cache: false,
							success: function(html){
							if(jQuery.timeago(html)=="Few seconds ago"){  								
							$("#prog_'.$rsand.'").html("Online"); //Insert chat log into the #chatbox div
							}else{
							$("#prog_'.$rsand.'").html(jQuery.timeago(html)); //Insert chat log into the #chatbox div
							}								
							},									
							});
							}
							tier=setInterval (not'.$rsand.', 1000);
							</script>
							<div class=""   style="font-size: 8pt;"  id="prog_'.$rsand.'"  ></div>
							';
							$sql = "SELECT
							*
							FROM
							my_user
							WHERE
							email = '".$rsw['email']."'";
							$reult = mysql_query($sql);
							$rw = mysql_fetch_array($reult);
							$nag="";
							if($rsw['email']=="Group"){
								$nag = "Group";
								$timest = "";
								}else{
								$nag = $rw['name'] ;
							}
							$rsand = round(rand(10,99)).round(rand(10,99)).round(rand(10,99));
							$projectContents .='
							<a href="index.php?on='.$rsw['email'].'#msgt">
							<li style="width:100%;border: 4px #'.$rsand.' solid;" >
							
							'.$timets.'
							<div class="badge bg-color-green right bottom">'.$timett.'</div>
							<div class="badge bg-color-green right top" style="font-size: 8pt;" >'.$timest.'</div>
							<div class="icon"><img src="'.$rw['pp'].'" style="border: 2px solid #ffffff;left:10px;" height="100px;" ></div>
							<div class="data"><h4>'.$nag.'</h4><p style="color:#000000" >
							'.smile($rsw['msg']).'</p></div>
							
							
							</li>
							</a>
							';
							
						}			
						
						echo $projectContents ;
					?>
				</ul>
				<?php
					$projectContents = "";
					$result = mysql_query("SELECT * FROM my_user ORDER BY onlineup DESC");
					while($rsw = mysql_fetch_array($result))
					{
						if($rsw['online']=="1" && !($rsw['email'] == $_SESSION['ue'])){
							$sql = "SELECT
							*
							FROM
							my_user
							WHERE
							email = '".$rsw['email']."'";
							$reult = mysql_query($sql);
							$rw = mysql_fetch_array($reult);
							$projectContents .='
							<a href="index.php?on='.$rsw['email'].'#msgt"><button style="color:#ffffff;margin:0px 0px 5px;background-color: #00A300 !important;" >'.$rw['name'].'</button></a>
							';
						}
					}
					echo $projectContents ;
				?>
				
			</div>
			<?php
			}
			}else{
		}
		}else{
	?>
	<div id="log" style="position:fixed;padding:10px;width:"  >
		<form action="index.php?enter" method="post">
			<h1>Sign In<i style="font-size:64px;" class="icon-user-3"></i></h1>
			
			<br>
			<div class="" style="margin-right:10px;text-align:left;color:#ffffff" >
				User Name
			</div>
			<div class="input-control text " style="width:100%;text-align:left;color:#ffffff" >
				<input  name="un" type="text" />
				<button class="btn-clear"></button>
			</div>
			<div class="" style="margin-right:10px;text-align:left;color:#ffffff" >
				Password
			</div>
			<div class="input-control password " style="width:100%;text-align:left;color:#ffffff" >
				<input name="up"  type="password" />
				<button class="btn-clear"></button>
			</div>
			<input id="enter" type="submit" value="Sing in"/>
			<a href="singup.php" ><input type="button"  value="Sign up"/></a>
			<input type="reset"  value="Clear"/>
		</form>
	</div>
	<?php
	}
?>
