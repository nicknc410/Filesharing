<?php
//simple php to log out(destroy session) and redirect to login page
session_destroy();
header("Location: filesharing.html");
?>
