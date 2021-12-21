<?php
define('APP_ID','552168648193833');
define('APP_SECRET','5278752d519faaede8aff6a0c5f95f79');

require ("facebook.php");

$facebook = new Facebook(array(
    'appId'  => APP_ID,
    'secret' => APP_SECRET,
    'cookie' => true,
));

$signed_request = $facebook->getSignedRequest();

$liked = $signed_request["page"]["liked"];
//$liked=0;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php if($liked!=0){?>
	<script type="text/javascript">
	   window.top.location.href = 'https://apps.facebook.com/merilsupermom';
	</script>
<?php }?>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta name="author" content="webpers">
<meta name="keywords" content="HTML, CSS, XML, XHTML, JavaScript">
<meta name="description" content="Free Web tutorials on HTML and CSS">


<link rel="stylesheet" type="text/css" href="stylesheet/style.css" />

<script type="text/javascript" src="javascript/jquery.js"></script>
<script type="text/javascript" src="javascript/bjqs-1.3.min.js"></script>
<script type='text/javascript' src='javascript/jquery.simplemodal.js'></script>
<script type="text/javascript" src="javascript/webpers.js"></script>
<!-- 
	font-family: 'Noto Sans', sans-serif;
-->
<title>Home Page</title>
</head>
<body>
	<div id="fb-root"></div>
	<script type="text/javascript" src="https://connect.facebook.net/en_US/all.js"></script>
	<script type="text/javascript">
	       	FB.init({
	         	appId  : '552168648193833',
	         	status : true, // check login status
	         	cookie : true, // enable cookies to allow the server to access the session
	         	xfbml  : true  // parse XFBML
	       	});
		   	window.fbAsyncInit = function() {
	 	FB.Canvas.setAutoGrow();
   	};
			
				FB.Event.subscribe('edge.create',
	    	function(response) {
	        	//alert('You liked the URL: ' + response);
				window.top.location.href = 'https://apps.facebook.com/merilsupermom';
	    	}
		);
	</script>
	<!--<img src="images/pran_logo.png" id="pran_logo" width="130px;"/>
<img src="images/camera_right_top.png" id="camera" width="130px;"/>-->
	<!--blink-->
     <div id="left_sidebar">
    	<img src="images/left.png"/>
    	
    </div>
    <div id="right_sidebar">
        <img src="images/right.png"/>
        
    </div>	
    <!--end of blink-->
	<div id="container" class="div_750_auto">
		<div id="alpona"></div>
        
        
		<div id="content">
		
		
	  <p class="like_text">Please <button id="like_us"></button> us </p>
        <br/>
        <p class="like_text">To participate this exciting event</p>
        <div id="like">
        <div id="div_for_like">
				<div class="fb-like transparent" style="position:absolute;" data-href="https://www.facebook.com/supermombd" data-send="false" data-width="50" data-show-faces="false"></div>
				<div class="fb-like transparent" style="position:absolute;  margin-left:37px;" data-href="https://www.facebook.com/supermombd" data-send="false" data-width="50" data-show-faces="false"></div>
				
				
						
				<div class="fb-like transparent" style="position:absolute;  margin-top:12px;" data-href="https://www.facebook.com/supermombd" data-send="false" data-width="50" data-show-faces="false"></div>
				<div class="fb-like transparent" style="position:absolute;  margin-top:12px; margin-left:37px;" data-href="https://www.facebook.com/supermombd" data-send="false" data-width="50" data-show-faces="false"></div>
				
				
		
						
		</div>
        <img src="images/like_soto.png"/><!-- <img src="images/join.png"/> -->
        
        </div>
        <br/>
        <div id="fane_page">
        <a href="https://www.facebook.com/supermombd" target="_blank"><button class="visite">Visit Fanpage </button></a>
        </div>
	</div><!--/content-->
		
		
	<div class="footer"><a href="#" onClick="webpers();"><img src="images/footer_webpers.png"/><div></div></a></div><!-- end of footer -->
	</div><!-- /#container -->
</body>
</html>
