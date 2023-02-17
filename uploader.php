<?php
//code gotten from course wiki to upload file
session_start();

// Get the filename and make sure it is valid
$filename = basename($_FILES['uploadedfile']['name']);
if(!preg_match('/^[\w_\.\-]+$/', $filename) ){
	echo "Invalid filename<br>";
	echo $_FILES['uploadedfile']['tmp_name'];
	exit;
}
// Get the username and make sure it is valid
$username = $_SESSION['username'];
if( !preg_match('/^[\w_\-]+$/', $username) ){
	echo "Invalid username";
	exit;
}

$full_path = sprintf("/home/ryan38538/%s/%s", $username, $filename);
$f="/home/ryan38538/public_html";
if( move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $full_path) ){
	header("Location: dashboard.php");//redirect back to dashboard after upload
	exit;
}else{
	echo $full_path;
	exit;
}

?>
