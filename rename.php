<?php
session_start();
$fileName=$_GET["newName"];//"$fileName is the name we are trying to change to
if ($fileName==""){//if user didn't input in anything to rename, throw an error
	echo "no";
	exit;
}
else{
	$path=sprintf("/home/ryan38538/%s/%s",$_SESSION["username"],$_SESSION["renameFile"]);//"renameFile" is the name of the old file we are trying to rename
	
	$dotPos=strpos($_SESSION["renameFile"],".");//we find the position of the "." in the old name ("strpos" method found on https://www.php.net/manual/en/function.strpos.php)
	$fileExt=substr($_SESSION["renameFile"],$dotPos);//using that index position we found, we can get the substring for the file extension so that the user doesn't have to do it themselves and may possibly input in the wrong extension (method found on https://www.php.net/manual/en/function.substr.php)
	$conCat=$fileName . $fileExt; //concatenate the new filename with the extension
	$newPath=sprintf("/home/ryan38538/%s/%s",$_SESSION["username"],$conCat);//new path of the file with the new name
	rename($path, $newPath);//rename old file path to new file path ("rename" method found on https://www.php.net/manual/en/function.rename.php_
	header("Location: dashboard.php");//redirect to dashboard after renaming complete
	exit;
}
?>
