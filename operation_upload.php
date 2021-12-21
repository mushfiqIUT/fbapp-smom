<?php
include("common/connect.php");
$title=$_POST['title'];
$name=$_POST['name'];
$mail=$_POST['email'];
$mobile=$_POST['mobile'];
$fbid=$_POST['fbid'];
/*echo "<pre>";
print_r($_POST);*/

if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/tiff")
|| ($_FILES["file"]["type"] == "image/pjpeg"))
&& ($_FILES["file"]["size"] < 900000000))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    	header("location: error.html");
    }
  else
    {
     
	$ext = explode('.',$_FILES['file']['name']);
	$ext2=substr(strrchr($_FILES['file']['name'], "."),1);
	$extension = $ext[1];
	srand(time(0));
	$token=100000+rand()%(900000-100000);
	$newname=$token.'.'.$ext2;
	/*$imagename = basename($_FILES['file']['name']);
	$time = time();
	$newname = $time . $imagename;*/
    if (file_exists("upload/" . $newname))
      {
      header("location: unsuccessfull.html");
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "upload/" . $newname);
       "Stored in: " . "upload/" . $_FILES["file"]["name"];
	   $sql="INSERT INTO images (id, fbid, title, name, mail, mobile, image, category) VALUES ('', '$fbid', '$title', '$name',  '$mail', '$mobile', '$newname', '$category')";
	  mysql_query($sql);
	    $from = "supermom@gmail.com";
		
		 $to      = $mail;
		$subject = 'Notification of successfully upload your photo';
		$message = "Dear $name,
		
		Thank you for your interest in participating in this competition. You photo has been uploaded successfully. 
		Keep your eyes at our facebook page http://www.facebook.com/supermombd.
 
		Once we have uploaded your photo you can view it!
 
		Thanks
		Supermom Facebook Developer Team
"; 

		mail($to, $subject, $message, "From: $from");
		
		$sql="SELECT * FROM images WHERE thumbnail=0 LIMIT 2";
		$result=mysql_query($sql);
		while($row=mysql_fetch_assoc($result)){
		$image=$row['image'];
		$id=$row['id'];
			createThumbs("upload/","thumbs/",900,$image,$id);
			createThumbs("upload/","small_thumbs/",150,$image,$id);	
		}
		
		header("location: successfull.php");
      }
    }
  }
else
  {
  	header("location: unsuccessfull.php");
  }
  
  
  
function createThumbs( $pathToImages, $pathToThumbs, $thumbWidth, $imagename, $id ) 
{
  $dir = opendir( $pathToImages );
  	$fname = $imagename;
	
	//$include="http://fbapp.webpers.com/juiphoto/function.php?image=".$imagename;	
    $info = pathinfo($pathToImages . $fname);
    if ( strtolower($info['extension']) == 'jpg' ) 
    {
      echo "Creating thumbnail for {$fname} <br />";
      $img = imagecreatefromjpeg( "{$pathToImages}{$fname}" );
      $width = imagesx( $img );
      $height = imagesy( $img );
      $new_width = $thumbWidth;
      $new_height = floor( $height * ( $thumbWidth / $width ) );
      $tmp_img = imagecreatetruecolor( $new_width, $new_height );
      imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );
      imagejpeg( $tmp_img, "{$pathToThumbs}{$fname}" );
    }
  closedir( $dir );
  $sql="UPDATE images SET thumbnail=1 WHERE id=$id";
  mysql_query($sql);
  //include('$include');
}



function itg_fetch_image($img_url, $store_dir = 'image', $store_dir_type = 'relative', $overwrite = false, $pref = false, $debug = false) {
    $i_name = explode('.', basename($img_url));
    $i_name = $i_name[0];
    if(preg_match('/https?:\/\/.*\.png$/i', $img_url)) {
        $img_type = 'png';
    }
    else if(preg_match('/https?:\/\/.*\.(jpg|jpeg)$/i', $img_url)) {
        $img_type = 'jpg';
    }
    else if(preg_match('/https?:\/\/.*\.gif$/i', $img_url)) {
        $img_type = 'gif';
    }
    else {
        if(true == $debug)
            echo 'Invalid image URL';
        return '';
    }

    $dir_name = (($store_dir_type == 'relative')? './' : '') . rtrim($store_dir, '/') . '/';
    if(!file_exists($dir_name))
        mkdir($dir_name, 0777, true);
    $i_dest = $dir_name . $i_name . (($pref === false)? '' : '_' . $pref) . '.' . $img_type;
    if(file_exists($i_dest)) {
        $pref = (int) $pref;
        if(false == $overwrite)
            return itg_fetch_image($img_url, $store_dir, $store_dir_type, $overwrite, ++$pref, $debug);
        else
            unlink ($i_dest);
    }
    $img_info = @getimagesize($img_url);
    if(false == $img_info || !isset($img_info[2]) || !($img_info[2] == IMAGETYPE_JPEG || $img_info[2] == IMAGETYPE_PNG || $img_info[2] == IMAGETYPE_JPEG2000 || $img_info[2] == IMAGETYPE_GIF)) {
        if(true == $debug)
            echo 'The image doesn\'t seem to exist in the remote server';
        return ''; 
    }
    if($img_type == 'jpg') {
        $m_img = @imagecreatefromjpeg($img_url);
    } else if($img_type == 'png') {
        $m_img = @imagecreatefrompng($img_url);
        @imagealphablending($m_img, false);
        @imagesavealpha($m_img, true);
    } else if($img_type == 'gif') {
        $m_img = @imagecreatefromgif($img_url);
    } else {
        $m_img = FALSE;
    }
    if(FALSE === $m_img) {
        if(true == $debug)
            echo 'Can not create image from the URL';
        return '';
    }
    if($img_type == 'jpg') {
        if(imagejpeg($m_img, $i_dest, 100))
            return $i_dest;
        else
            return '';
    } else if($img_type == 'png') {
        if(imagepng($m_img, $i_dest, 0))
            return $i_dest;
        else
            return '';
    } else if($img_type == 'gif') {
        if(imagegif($m_img, $i_dest))
            return $i_dest;
        else
            return '';
    }

    return '';
}
?>