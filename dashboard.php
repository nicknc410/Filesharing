<!DOCTYPE html>
<html lang="en">
    <head>
        <title> Dashboard</title>
    </head>

    <body>
	<h1> Welcome to your Dashboard</h1>
<?php
session_start();
$name=$_SESSION['username'];
echo "<h1> $name</h1>";
?>
    <form enctype="multipart/form-data" action="uploader.php" method="POST"><!--following code is gotten from the course wiki to upload-->
	<p>
		<input type="hidden" name="MAX_FILE_SIZE" value="20000000" />
		<label for="uploadfile_input">Choose a file to upload:</label> <input name="uploadedfile" type="file" id="uploadfile_input" />
	</p>
	<p>
		<input type="submit" value="Upload File" />
	</p>
</form>
<form action="actionHandler.php" method="get">
<?php
session_start();
$user=$_SESSION['username']; //session start and get username to find proper directory
$dirName=sprintf("/home/ryan38538/%s",$user);//directory of the user
$filesArray=scandir($dirName);//scandir and foreach method told by TA Isabel
foreach ($filesArray as $fileName) {
	if ($fileName !="." and $fileName!=".."){
		$fileDirName=sprintf("/home/ryan38538/%s/%s",$user,$fileName);
		echo "<input type='radio' name='files' value=$fileName>$fileName<br>";// we echo a radio option for each file we find in the directory
	}
}
//all three of the following submit buttons are named 'action' so that actionHandler.php can know which operation to perform on the files given the value.
echo "<input type='submit' name='action' value='Open'>"; 
echo "<input type='submit' name='action' value='Delete'>";
echo "<input type='submit' name='action' value='Rename'>";

?>
</form>

<form action ='logout.php' method = 'POST'>
	<input type='submit' name='logout' value='Logout'>
</form>
</body>
</html>
