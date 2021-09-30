<?php

 $con = mysql_connect("localhost","sdaasd714_fbox","123");
 mysql_select_db("sdaasd714_fbox", $con);
 $db = "sdaasd714_fbox";
  if(isset($_SESSION['ue'])){
  $sql = "CREATE TABLE ".$_SESSION['ue']."_msg
 (
 email varchar(15) PRIMARY KEY,
 msg varchar(20000),
 time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
 seen varchar(20000)
 )";
 // Execute query
 mysql_query($sql,$con);
  
 $sql = "SELECT
					*
					FROM
					".$_SESSION['ue']."_msg
					WHERE
					email = 'Group'";
                $reult = mysql_query($sql,$con);
				$rw = mysql_fetch_array($reult);
				if(!($rw['msg'])){
  mysql_query("INSERT INTO ".$_SESSION['ue']."_msg (email,msg,seen) 
 VALUES ('Group', 'msg','1')",$con);
				}
 }
 function smile($row){
                $commet = str_ireplace("<cc>","'",$row);
 				$commet = str_ireplace(" >:(","<img id='smyl' src='smileys/caca.png'>",$commet);
				$commet = str_ireplace(" :'(","<img id='smyl' src='smileys/cry.png'>",$commet);
				$commet = str_ireplace(" :/","<img id='smyl' src='smileys/confused.png'>",$commet);
				$commet = str_ireplace(" O.o","<img id='smyl' src='smileys/dizzy.png'>",$commet);
				$commet = str_ireplace(" ^_^","<img id='smyl' src='smileys/happy.png'>",$commet);
				$commet = str_ireplace(" :D","<img id='smyl' src='smileys/lol.png'>",$commet);
				$commet = str_ireplace(" :|","<img id='smyl' src='smileys/neutral.png'>",$commet);
				$commet = str_ireplace(" :O","<img id='smyl' src='smileys/omg.png'>",$commet);
				$commet = str_ireplace(" :(","<img id='smyl' src='smileys/sad.png'>",$commet);
				$commet = str_ireplace(" :)","<img id='smyl' src='smileys/smile.png'>",$commet);
				$commet = str_ireplace(" :P","<img id='smyl' src='smileys/tongue.png'>",$commet);
				$commet = str_ireplace(" ;)","<img id='smyl' src='smileys/wink.png'>",$commet);
				$commet = str_ireplace(" :-/","<img id='smyl' src='smileys/confused.png'>",$commet);
				$commet = str_ireplace(" o.O","<img id='smyl' src='smileys/dizzy.png'>",$commet);
				$commet = str_ireplace(" :-D","<img id='smyl' src='smileys/lol.png'>",$commet);
				$commet = str_ireplace(" :-|","<img id='smyl' src='smileys/neutral.png'>",$commet);
				$commet = str_ireplace(" :-O","<img id='smyl' src='smileys/omg.png'>",$commet);
				$commet = str_ireplace(" :-(","<img id='smyl' src='smileys/sad.png'>",$commet);
				$commet = str_ireplace(" :-)","<img id='smyl' src='smileys/smile.png'>",$commet);
				$commet = str_ireplace(" :-P","<img id='smyl' src='smileys/tongue.png'>",$commet);
				$commet = str_ireplace(" ;-)","<img id='smyl' src='smileys/wink.png'>",$commet);
				return $commet; 
 }
  function smiles($row){
?>
<button id="wallr" style="background-color:#ffffff;color:black;float:left;margin:3px;border: 3px solid #ffffff;" >+</button><button id="walla" style="float:left;margin:3px;border: 3px solid #ffffff;" >+</button>
	<br><div id="divr" style="width:100px;height:100px;float:left;margin:3px;border: 2px solid #ffffff;">
		<button onClick="add(':)')"  style="padding:2px;background-color:#ffffff;float:left;margin:3px;border: 3px solid black;" >
		<img src="smileys/smile.png">
		</button>
		<button onClick="add(':(')"  style="padding:2px;background-color:#ffffff;float:left;margin:3px;border: 3px solid black;" >
		<img src="smileys/sad.png">
		</button>
		<button onClick="add(';)')"  style="padding:2px;background-color:#ffffff;float:left;margin:3px;border: 3px solid black;" >
		<img src="smileys/wink.png">
		</button>
		<button onClick="add(':D')"  style="padding:2px;background-color:#ffffff;float:left;margin:3px;border: 3px solid black;" >
		<img src="smileys/lol.png">
		</button>
		<button onClick="add('cry')"  style="padding:2px;background-color:#ffffff;float:left;margin:3px;border: 3px solid black;" >
		<img src="smileys/cry.png">
		</button>
		<button onClick="add(':P')"  style="padding:2px;background-color:#ffffff;float:left;margin:3px;border: 3px solid black;" >
		<img src="smileys/tongue.png">
		</button>
		<button onClick="add(':O')"  style="padding:2px;background-color:#ffffff;float:left;margin:3px;border: 3px solid black;" >
		<img src="smileys/omg.png">
		</button>
		<button onClick="add('>:(')"  style="padding:2px;background-color:#ffffff;float:left;margin:3px;border: 3px solid black;" >
		<img src="smileys/caca.png">
		</button>
		<button onClick="add(':/')"  style="padding:2px;background-color:#ffffff;float:left;margin:3px;border: 3px solid black;" >
		<img src="smileys/confused.png">
		</button>
		<button onClick="add('O.o')"  style="padding:2px;background-color:#ffffff;float:left;margin:3px;border: 3px solid black;" >
		<img src="smileys/dizzy.png">
		</button>
		<button onClick="add('^_^')"  style="padding:2px;background-color:#ffffff;float:left;margin:3px;border: 3px solid black;" >
		<img src="smileys/happy.png">
		</button>
		<button onClick="add(':|')"  style="padding:2px;background-color:#ffffff;float:left;margin:3px;border: 3px solid black;" >
		<img src="smileys/neutral.png">
		</button>
		</div>
<?php
}
?>
