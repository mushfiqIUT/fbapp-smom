<?php
date_default_timezone_set("Asia/Dhaka");
$current_date=date('Y-m-d');
header('P3P: CP="CAO PSA OUR"');
header('P3P: CP="HONK"');
error_reporting(0);

include('common/connect.php');
include('facebook/fbmain.php');
$fbid=$_GET['ssid'];
$id=$_GET['ppid'];
$referee=$_SERVER['HTTP_REFERER'];
$url=parse_url($referee);
$create_url=$url['scheme']."://".$url['host'].$url['path'];
$reference_url1="https://apps.facebook.com/merilsupermom/update.php";
if($create_url==$reference_url1){
	if($fbid==$user){
		$sql="UPDATE images SET is_delete=1 WHERE fbid=$fbid and id=$id";
		mysql_query($sql);
	}
}
$select=mysql_query("SELECT * FROM images WHERE fbid=$fbid and is_delete=0");
$count=mysql_num_rows($select);

?>
<html>
<head>
<script type="text/javascript">
function redirect(number){
	if(number>0){
		window.top.location.href = "https://apps.facebook.com/merilsupermom";
	}
	else{
		window.top.location.href = "https://apps.facebook.com/merilsupermom/upload.php";
	}
}
</script>
</head>
<body onload="redirect(<?php echo $count?>)">
</body>
</html>