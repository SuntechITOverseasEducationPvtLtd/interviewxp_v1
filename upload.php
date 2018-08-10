<?php

$servername = "localhost";
$username = "khandane_intervi";
$password = "e+9p%SdY}y9*";
$dbname = "khandane_interviewxp";
$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}



if(isset($_POST["image"]))
{
	$data = $_POST["image"];

 	$id = $_POST["id"];

	$image_array_1 = explode(";", $data);

	 
	$image_array_2 = explode(",", $image_array_1[1]);

	 
	$data = base64_decode($image_array_2[1]);

	$imageName = uniqid().'.png';

	file_put_contents('uploads/profile_images/'.$imageName, $data);


$sql_update = "UPDATE users set profile_image='".mysqli_escape_string($conn,$imageName)."' WHERE id='".$id."'";
			
mysqli_query($conn, $sql_update) or die("database error:". mysqli_error($conn));



	echo '<img src="http://cloudforcehub.com/interviewxp/uploads/profile_images/'.$imageName.'" style="width: 130px;
    margin-top: 66px;
    max-width: 130px;
    max-height: 130px;
    height: 130px;" id="profile_image uploaded_image" />';

}

?>