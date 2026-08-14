<?php

session_start();

/* Remove all session variables */
$_SESSION = array();

/* Destroy session */
session_destroy();

/* Redirect to main login page */
header("Location: ../login.php");

exit();

?>
