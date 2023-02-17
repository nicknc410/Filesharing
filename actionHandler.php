<?php
session_start();

$filename = $_GET['files'];

// We need to make sure that the filename is in a valid format; if it's not, display an error and leave the script.
// To perform the check, we will use a regular expression.
$action = $_GET['action']; //get action from dashboard.php
if ($filename==''){ //if filename is empty (a file isn't chosen) then do nothing and redirect to dashboard.
	header("Location: dashboard.php");
}
elseif ($action == 'Open') {//if "Open" chosen for action, open the file using the code given in wiki
	if (!preg_match('/^[\w_\.\-]+$/', $filename)) {
		echo $filename;
		exit;
	}

	// Get the username and make sure that it is alphanumeric with limited other characters.
	// You shouldn't allow usernames with unusual characters anyway, but it's always best to perform a sanity check
	// since we will be concatenating the string to load files from the filesystem.
	$username = $_SESSION['username'];
	if (!preg_match('/^[\w_\-]+$/', $username)) {
		echo "Invalid username";
		exit;
	}

	$full_path = sprintf("/home/ryan38538/%s/%s", $username, $filename);

	// Now we need to get the MIME type (e.g., image/jpeg).  PHP provides a neat little interface to do this called finfo.
	$finfo = new finfo(FILEINFO_MIME_TYPE);
	$mime = $finfo->file($full_path);

	// Finally, set the Content-Type header to the MIME type of the file, and display the file.
	header("Content-Type: " . $mime);
	header('content-disposition: inline; filename="' . $filename . '";');
	readfile($full_path);
}
elseif ($action=="Delete"){ //if option is "Delete", delete the file using "unlink" method found on PHP's documentation
	$username=$_SESSION['username'];
	$path=sprintf("/home/ryan38538/%s/%s",$username,$filename);
	unlink($path);//code gotten from https://www.geeksforgeeks.org/how-to-delete-a-file-using-php/
	header("Location:dashboard.php");
}
elseif($action=="Rename"){//if option is "Rename", redirect to a HTML page called "rename.html" which will include the php file neccessary to rename the file. To pass on the original filename, we set the $_SESSION variable of 'renameFile' to $filename.
	$_SESSION['renameFile']=$filename;
	header("Location:rename.html");
}
?>
