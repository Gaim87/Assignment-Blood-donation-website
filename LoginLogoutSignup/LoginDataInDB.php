<?php
if(!isset($_SESSION))
session_start();

/*
Author: 100566818

Summary: This file contains code that logs a user in the website, after checking that his username exists in the database and that his password is correct.
         Communication between files is achieved with POST calls.
*/

//Connect to the database. (Includes the contents of "dbConnect.php" in this file)
include_once ('../LinkToDB/dbConnect.php');

if(isset($_POST["LoginButton"]))            //If there is a POST request with the given id.
{
    //Save the textboxes' contents in variables.
    $loginUsername = strip_tags(mysqli_real_escape_string($conn, $_POST['LoginUsername']));
    $loginPassword = strip_tags(mysqli_real_escape_string($conn, $_POST['LoginPassword']));
   
    //Query the database for the current (still not logged in) user's username and password.
    $queryUserTable = mysqli_query($conn, "select Username, User_Password from USERS where Username = '$loginUsername';");
    //Save the above query's results into an associative array. (The table's columns' take the name of the database's columns/attributes)
    $arrayUserTable = mysqli_fetch_assoc ($queryUserTable);
    //Checking the validity of the password by first decrypting it.
    $verifiedPassword = password_verify ($loginPassword, $arrayUserTable ['User_Password']);

    if ($verifiedPassword)
    {
        $_SESSION['username'] = $loginUsername;     //Global variables.
        $_SESSION['loggedIn'] = true;

        //Informs the user that he/she has successfully logged in and redirects him/her to the new home page.
        echo '<script>alert ("You have successfully logged in!");
        window.location.replace("../Requests.php");
        </script>';
    }
    else
    {
        echo '<script>alert ("Wrong username or password. Please retry!");
        window.location.replace("../Index.php");
        </script>';
    }
}

$conn->close();
?>