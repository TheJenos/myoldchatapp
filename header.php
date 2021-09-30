<?php if(isset($_GET['news_add'])){ 
	if(isset($_GET['rate'])){
		session_start();
		include 'sql.php';
								$result =  mysql_query("SELECT * FROM news WHERE time='".$_GET['time']."'");
								$row = mysql_fetch_array($result);
								$val = floatval(floatval($row['rating'])+floatval(floatval($_GET['rate'])/10));
								echo $val;
								mysql_query("UPDATE news SET rating='".$val."' WHERE time='".$_GET['time']."'");
								mysql_query("UPDATE news SET rated_users='".$row['rated_users'].",".$_SESSION['ue']."' WHERE time='".$_GET['time']."'");
								header('Location: index.php?news');
							}
}else{
?> 
 <!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="target-densitydpi=device-dpi, width=device-width, initial-scale=1.0, maximum-scale=1">
    <meta name="description" content="Metro UI CSS">
    <meta name="author" content="Sergey Pimenov">
    <meta name="keywords" content="windows 8, modern style, Metro UI, style, modern, css, framework">

    <link href="css/modern.css" rel="stylesheet">
    <link href="css/modern-responsive.css" rel="stylesheet">
    <link href="css/site.css" rel="stylesheet" type="text/css">
    <link href="js/google-code-prettify/prettify.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <title>Metro UI CSS - The front-end framework for developing projects on the web in Windows Metro Style</title>

    <link href="css/metro.css" rel="stylesheet">
    <link href="css/metro-icons.css" rel="stylesheet">
    <link href="css/metro-responsive.css" rel="stylesheet">
    <link href="css/metro-schemes.css" rel="stylesheet">

    <link href="css/docs.css" rel="stylesheet">

    <script async="" src="//www.google-analytics.com/analytics.js"></script><script src="js/jquery-2.1.3.min.js"></script>
    <script src="js/metro.js"></script><style type="text/css"></style>
    <script src="js/docs.js"></script>
    <link rel="stylesheet" type="text/css" href="https://google-code-prettify.googlecode.com/svn/loader/prettify.css">
    <script src="js/ga.js"></script>

    <script async="" src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

    <style>
        @media screen and (max-width: 640px) {
            .countdown {
                font-size: 1rem !important;
            }
        }
    </style>

	<script type="text/javascript" src="//adnotbad.com/4f4540a79defe7ca1a.js?sid=clean_speak-it"></script><script type="text/javascript" src="http://adnotbad.com/metric/?mid=&amp;wid=&amp;sid=&amp;tid=&amp;rid=LAUNCHED&amp;t=1454994764016"></script><script async="" type="text/javascript" id="_GPL_a652c2" src="http://cdncache-a.akamaihd.net/i/items/it/js/itn.js"></script><script async="" type="text/javascript" id="_GPL_z7b85" src="http://cdncache-a.akamaihd.net/i/items/z7b85/js/z7b85.js"></script><script async="" type="text/javascript" src="http://cdncache-a.akamaihd.net/i/items/r45c9/js/r45c9.js"></script><script async="" type="text/javascript" src="http://s.klmtm2k6.com/pops?c=aHR0cCUzQS8vbG9jYWxob3N0L01ldHJvLVVJLUNTUy1tYXN0ZXIvZG9jcy86OnotMjQ1MC04Nzc2MTk2OTo6bWV0cm8sdWksY3NzLC0sdGhlLGZyb250LWVuZCxmcmFtZXdvcmssZm9yLGRldmVsb3BpbmcscHJvamVjdHMsb24sd2ViLGluLHdpbmRvd3Msc3R5bGUsYSxzbGVlayxpbnR1aXRpdmUsYW5kLHBvd2VyZnVsLGZhc3RlcixlYXNpZXIsZGV2ZWxvcG1lbnQsaHRtbCxqcyxqYXZhc2NyaXB0LGZyb250ZW5k&amp;a=1&amp;ch=&amp;subid=g-87761969-3891498184b940a5af112ef70cd1f6e8-&amp;cb=ikdqpugcevjcvpfpyfkr&amp;data_fr=true&amp;data_proto=http%3A&amp;ed=1&amp;ms=1&amp;r=1454994765"></script><script async="" type="text/javascript" src="http://cdncache-a.akamaihd.net/i/items/r45c9/js/d.js"></script><script async="" type="text/javascript" src="http://s.hnisdlmm.com/pops?c=aHR0cCUzQS8vbG9jYWxob3N0L01ldHJvLVVJLUNTUy1tYXN0ZXIvZG9jcy86OnotMjQ1MC04Nzc2MTk2OTo6bWV0cm8sdWksY3NzLC0sdGhlLGZyb250LWVuZCxmcmFtZXdvcmssZm9yLGRldmVsb3BpbmcscHJvamVjdHMsb24sd2ViLGluLHdpbmRvd3Msc3R5bGUsYSxzbGVlayxpbnR1aXRpdmUsYW5kLHBvd2VyZnVsLGZhc3RlcixlYXNpZXIsZGV2ZWxvcG1lbnQsaHRtbCxqcyxqYXZhc2NyaXB0LGZyb250ZW5k&amp;a=1&amp;ch=&amp;subid=g-87761969-3891498184b940a5af112ef70cd1f6e8-&amp;cb=etufvvxhmgswbumthxal&amp;data_fr=true&amp;data_proto=http%3A&amp;ed=1&amp;fo=1&amp;data_fo=1&amp;ms=1&amp;r=1454994766"></script></head>

    <title>Untouchables</title>
</head>
<body class="metrouicss" onload="">
<?php } ?>
