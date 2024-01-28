<?php
/*
Author: 100566818

Summary: This file contains code that logs a user out of the website.
*/

session_start();

//Resets (empties) the global variable containing the current session's information.
$_SESSION = array();

session_destroy();

header ("location: ../Index.php");      //Redirects the user to the home page.
?>