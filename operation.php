<?php
date_default_timezone_set("Asia/Dhaka");
$current_date=date('Y-m-d');
header('P3P: CP="CAO PSA OUR"');
header('P3P: CP="HONK"');
error_reporting(0);

include('common/connect.php');
$fbid=$_POST['fbid'];
$name=$_POST['name'];
$babyname=$_POST['bname'];
$age=$_POST['age'];
$email=$_POST['email'];
$mobile=$_POST['mobile'];
$address=base64_encode($_POST['address']);
$code=$_POST['code'];

$sql="INSERT INTO `registration` (`id`, `fbid`, `name`, `babyname`, `age`, `email`, `mobile`, `address`, `code`, `date`) VALUES ('', '$fbid', '$name', '$babyname', '$age', '$email', '$mobile', '$address', '$code', '$current_date')";
mysql_query($sql);
header("location: https://www.e.webpers.com/supermom/upload.php");
?>