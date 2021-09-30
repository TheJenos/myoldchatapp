<?php
session_start();
include("header.php");
include ('sql.php');
?>
<script src="test_helpers.js" type="text/javascript"></script>
<script src="jquery.js" type="text/javascript"></script>
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
	$("#log").css({left:'25%'},"slow");
	$("#log").animate({width:'50%'},"slow");
	$("#logc").animate({height:'100%'},"slow");
	$("#logc").css({left:'25%'},"slow");
	$("#logc").animate({width:'50%'},"slow");
	}else{
    $("#log").css({left:'0%'},"slow");
	$("#log").animate({width:'100%'},"slow");
	$("#logc").animate({height:'100%'},"slow");
	$("#logc").css({left:'-10px'},"slow");
	$("#logc").animate({width:'102%'},"slow");
	}	
	$("sspan").hide();
    $("iframe").hide();
	$("#mseag").animate({top:'0%'},"slow");	
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
<?php
if(isset($_POST["n"]) && isset($_POST["uup"]) && isset($_POST["email"]) ){
 mysql_query("INSERT INTO my_user (name,pass,age,school,email,gen,pp) VALUES ('".stripslashes(htmlspecialchars($_POST['n']))."', '".stripslashes(htmlspecialchars($_POST['uup']))."','".stripslashes(htmlspecialchars($_POST['age']))."','".stripslashes(htmlspecialchars($_POST['sch']))."','".stripslashes(htmlspecialchars($_POST['email']))."','".stripslashes(htmlspecialchars($_POST['gen']))."','/pic/logo.jpg')");
 setcookie("un", $_POST["email"],time() + (86400 * 14));
 setcookie("up", $_POST["uup"],time() + (86400 * 14));
printf("<script>location.href='index.php'</script>");
 }
?>
<style>
body{
background-color: navy;
text-align: center;
margin:0;
padding:0; 
padding-left:0px;
}
</style>
<div id="log" style="position:fixed;padding:10px;width:"  >
<form action="singup.php?enter" method="post">
<h1>Sign Up<i style="font-size:64px;" class="icon-user-3"></i></h1>

<br>
<div class="" style="margin-right:10px;text-align:left;color:#ffffff" >
Nick Name
</div>
<div class="input-control text " style="text-align:left;color:#ffffff" >
 <input  name="n" type="text" />
 <button class="btn-clear"></button>
</div>
<div class="" style="margin-right:10px;text-align:left;color:#ffffff" >
Password
</div>
<div class="input-control password " style="text-align:left;color:#ffffff" >
 <input name="uup"  type="password" />
 <button class="btn-clear"></button>
</div>
<div class="" style="margin-right:10px;text-align:left;color:#ffffff" >
Age
</div>
<div class="input-control text " style="text-align:left;color:#ffffff" >
 <input  name="age" type="text" />
 <button class="btn-clear"></button>
</div>
<div class="" style="margin-right:10px;text-align:left;color:#ffffff" >
School
</div>
<div class="input-control text " style="text-align:left;color:#ffffff" >
 <input  name="sch" type="text" />
 <button class="btn-clear"></button>
</div>
<div class="" style="margin-right:10px;text-align:left;color:#ffffff" >
Login Name(No Spaces,Short,No Symbols)
</div>
<div class="input-control text " style="text-align:left;color:#ffffff" >
 <input  name="email" type="text" />
 <button class="btn-clear"></button>
</div>
<div class="" style="margin-right:10px;text-align:left;color:#ffffff" >
Gender
</div>
<div class="input-control text " style="text-align:left;color:#ffffff" >
 <input  name="gen" type="text" />
 <button class="btn-clear"></button>
</div>
<input id="enter" type="submit" value="Sign up"/>
<input type="reset"  value="Clear"/>
</form>
</div>
