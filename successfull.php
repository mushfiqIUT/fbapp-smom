<?php
$currentTimestamp = time();
$bdtime = strtotime("+10 hours", $currentTimestamp);
$endTime = date("Y-m-d H:i:s", $bdtime);
header('P3P: CP="CAO PSA OUR"');
header('P3P: CP="HONK"');
error_reporting(0);

include('common/connect.php');	
//$fbid='123';

include('facebook/fbmain.php');
	//$fbid='123';
	if ($user) {
	try {
		$likes_page = $facebook->api("/me/likes/162309677257479/"); //page id for like 
		
		if(empty($likes_page['data']) ){header('location: landing_page.html');
		}
			
	  } catch (FacebookApiException $e) {
		error_log($e);
		$user = null;
	  }
	}
	$fbid=$user;
	if ($user){
        $userInfo           = $facebook->api("/$user");        
        try{
            $fql    =   "select name, hometown_location, sex, pic_square from user where uid=" . $user;
            $param  =   array(
                'method'    => 'fql.query',
                'query'     => $fql,
                'callback'  => ''
            );
            $fqlResult   =   $facebook->api($param);
        }
        catch(Exception $o){
            d($o);
        }
    }	
	$id=$userInfo['id'];
	$name=$userInfo['name'];
	$gender=$userInfo['gender'];
	$birthday=$userInfo['birthday'];
	$mail=$userInfo['email'];
	$location=$userInfo['location']['name'];
	$sql="SELECT * FROM users WHERE fbid=$id";
	$result=mysql_query($sql);
	$rows_number=mysql_num_rows($result);
	
	if($rows_number<1){
		try {
			$publishStream = $facebook->api("/me/feed", 'post', array(
				'message' =>'I just took part in Meril Baby Adore Gora Bhobishshot 2013',
				'link'    =>'https://apps.facebook.com/merilsupermom/',
                'caption' => 'Win Tk. 10 lac for your baby',
                'picture' => "http://fbapp.webpers.com/fbwall/webpers/wallpost.jpg?v=1.6", 
                'name'    => 'Meril Baby Adore Gora Bhobishshot 2013',
                'description'=> 'Upload photos of loving moments with your child and get a chance to secure his/her future with education insurance up to Tk. 10 lac!'
				
				)
			);
			
	  } catch (FacebookApiException $e) {
		  d($e);
	  }
		$sql="INSERT INTO users ( fbid, name, gender, mail, country, dob, create_date) VALUES ('$id', '$name', '$gender', '$mail', '$location', '$birthday', '$endTime')";
		mysql_query($sql);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

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
<!--<script src="javascript/class2_slide.js" type="text/javascript"></script>-->
<!-- 
	font-family: 'Noto Sans', sans-serif;
-->
<title>Home Page</title>
</head>
<body style="overflow:hidden;">
<div id="fb-root"></div>
    <script type="text/javascript" src="https://connect.facebook.net/en_US/all.js"></script>
     <script type="text/javascript">
       FB.init({
         appId  : '552168648193833',
         status : true, // check login status
         cookie : true, // enable cookies to allow the server to access the session
         xfbml  : true  // parse XFBML
       });
	   
	   (function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
			fjs.parentNode.insertBefore(js, fjs);
		  }(document, 'script', 'facebook-jssdk'));
       window.fbAsyncInit = function() {
		   FB.Canvas.setAutoGrow();
		 };
		 function sendRequestViaMultiFriendSelector() {
        FB.ui({method: 'apprequests',
          message: 'Click to win Tk. 10 lac for your baby'
        }, requestCallback);
      }
      
      function requestCallback(response) {
        // Handle callback here
      }
	   FB.Canvas.scrollTo(0,0); 
     </script>
     <div  style="position:relative">
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
        <div id="nav">
        		<a href="#" onclick="sendRequestViaMultiFriendSelector();"> <button class="button" style="float:right; margin-left:5px;">Invite </button></a>
            	<a href="https://apps.facebook.com/merilsupermom/index.php" target="_top"> <button class="button" style="float:right; margin-left:5px;">My Photos </button></a>
                <a href="https://apps.facebook.com/merilsupermom/upload.php" target="_top"><button class="button" style="float:right; margin-left:5px;">Upload Photos </button></a>
                <a href="https://www.facebook.com/supermombd" target="_blank"><button class="button" style="float:right; margin-left:5px;">Visit Fanpage </button></a>
                <a href="http://www.supermombd.com/" target="_blank"><button class="button" style="float:right; margin-left:5px;">Visit Website </button></a>
                  
        		
            </div>
            <br /> <br />
		
		<div id="successfull_message">
			<p>You Have Successfully Uploaded Your Images.</p>
		</div>	
		
		<div id="successfull_msg_fanpage_bnt_container">
			<a href="index.php">See your image</a>
		</div>
		
		<div id="rules_and_regulation_button_container"><a href='rules_regulations.php' class='rules_and_regulation_button'>Rules & Regulation</a></div>
	<div class="footer"><a href="#" onClick="webpers();"><img src="images/footer_webpers.png"/><div></div></a></div><!-- end of footer -->
	</div><!-- /#container -->
	
	
	<div id="rules_and_regulation">
		<h1>RULES & REGULATION</h1>
		<ul>
			<li>Complete your registration before submitting your pictures.</li>
            <li>You can upload more than one photo if you want. </li>
            <li>FACEBOOK is not any part of this competition. </li>
            <li>Authorities can change rules or close the campaign any times without any prior notice.</li>
		</ul>
	</div><!-- /#rules_and_regulation -->
    </div>
</body>
</html>
