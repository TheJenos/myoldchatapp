<!DOCTYPE html>
<html>
   <head>
      <script src="jquery.min.js"></script>
      <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
      <link rel="stylesheet" href="css/modern.css" />
      <link rel="stylesheet" href="css/theme-dark.css" />
      <style type="text/css">
         .metrouicss {
         background-color:#4A0093;
         }
         #pwordbox {               
         position: absolute;
         height: 100px;
         width: 100px;    
         left: 50%;
         top: 35%;
         transform: translate(-50%, -50%);    
         -webkit-transform: translate(-50%, -50%);
         -moz-transform: translate(-50%, -50%);
         -ms-transform: translate(-50%, -50%);
         }
         #imgcont {               
         position: absolute;   
         left: -175%;
         top: 50%;
         transform: translate(-50%, -10%);    
         -webkit-transform: translate(-50%, -10%);
         -moz-transform: translate(-50%, -10%);
         -ms-transform: translate(-50%, -10%);
         }
         #pboxcont {               
         position: absolute;   
         left: 0%;
         top: 100%;
         /*
         transform: translate(-50%, -10%);    
         -webkit-transform: translate(-50%, -10%);
         -moz-transform: translate(-50%, -10%);
         -ms-transform: translate(-50%, -10%);
         */}
         #pwordhint {
         color:#E86C19;
         font-size:17.5px;
         }
      </style>
   </head>
   <body class="metrouicss">
      <div id="pwordbox" >
      <div id="imgcont">
         <img src="images/WIN8.png" />
      </div>
      <div id="fieldcont">
         <div id="pboxcont">
            <h1 style="color:white;">Welcome </h1>
			<div class="input-control password span4" style="color:white;" id="pworddiv">
                User <input style="" type="text" />
            </div>
            <div class="input-control password span4" style="color:white;" id="pworddiv">
                Password<input style="" type="password" />
            </div>
            <div id="pwordhint">
               Metro syle powered
            </div>
         </div>
      </div>
   </body>
</html>

