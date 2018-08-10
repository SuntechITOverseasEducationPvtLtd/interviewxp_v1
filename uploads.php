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

	file_put_contents('uploads/profile_images/interviewCoach/'.$imageName, $data);


$sql_update = "UPDATE member_detail set banner_image='".mysqli_escape_string($conn,$imageName)."' WHERE user_id='".$id."'";
			
mysqli_query($conn, $sql_update) or die("database error:". mysqli_error($conn));


    
    

}

?>