<?php
$to = "ramascoolguy@gmail.com";
$subject = "HTML email";

$message = "
<html>
<head>
<title>HTML email</title>
</head>
<body>
<p>This email contains HTML Tags!</p>
<table>
<tr>
<th>Firstname</th>
<th>Lastname</th>
</tr>
<tr>
<td>John</td>
<td>Doe</td>
</tr>
</table>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: ramakrishnajkm@gmail.com' . "\r\n";

if(mail($to,$subject,$message,$headers)){
			echo "<script>alert('Thank you for contact us, we will get back ASAP');window.location.href='contact.php';</script>";
		}else{
			echo "<script>alert('Sorry, Something went wrong please try again');;window.location.href='contact.php';</script>";
		}

?>