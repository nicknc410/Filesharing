<?php
$h = fopen("/home/ryan38538/users.txt", "r");
$user_list=array();
$linenum = 1;//following lines gotten from course wiki
echo "<ul>\n";
while( !feof($h) ){
	array_push($user_list,trim(fgets($h)));//to check for proper user, we trim the lines in user.txt to get of newline characters and then store them into array. Later we check if the submitted input text is an element contained in the array. (in_array method source linked below)
};
printf("</ul>\n");
$input_user=$_GET["user"];
if (in_array($input_user, $user_list)){ //found in https://www.geeksforgeeks.org/php-in_array-function/
	session_start();
	$_SESSION['username']=$input_user; //set session 'username' to $input_user to use name of the user in other files.
	header("Location: dashboard.php");
	exit;
}
else{
	echo "Not found";
}
fclose($h);
?>
