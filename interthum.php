<?php


if(isset($_POST["image"]))
{
	$data = $_POST["image"];

 	$id = $_POST["id"];

	$image_array_1 = explode(";", $data);

	 
	$image_array_2 = explode(",", $image_array_1[1]);

	 
	$data = base64_decode($image_array_2[1]);

	$imageName = uniqid().'.png';

	file_put_contents('uploads/interview_images/'.$imageName, $data);


	echo '<img src="http://cloudforcehub.com/interviewxp/uploads/interview_images/'.$imageName.'" style="width: 100%;" />
	
	<input name="image" value="'.$imageName.'" type="hidden">
	
	';

}

?>