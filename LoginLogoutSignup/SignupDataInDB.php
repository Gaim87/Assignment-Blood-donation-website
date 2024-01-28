<?php
if(!isset($_SESSION))
session_start();

/*
Author: 100566818

Summary: This file contains code that registers a new user's username, password and email address in the DB, after checking that the username is not already in use.
*/

//Connect to the database. (Includes the contents of "dbConnect.php" in this file)
include_once ('../LinkToDB/dbConnect.php');

if (isset ($_POST["RegisterSubmit"]))            //If there is a POST request with the given id.
{
    //Save the textboxes' contents in variables.
    $signupUsername = strip_tags(mysqli_real_escape_string($conn, $_POST['RegisterUsername']));
    $signupPassword = strip_tags(mysqli_real_escape_string($conn, $_POST['RegisterPassword']));
    $verifiedPassword = strip_tags(mysqli_real_escape_string($conn, $_POST['RepeatPassword']));
    $signupEmail = strip_tags(mysqli_real_escape_string($conn, $_POST['RegisterEmail']));
    $helperBool = true;
    //Checks that the two textboxes for inputting and verifying the password contain the exact same text.
    $passwordVerified = ($verifiedPassword == $signupPassword);
   
    //Query the DB for usernames already in use.
    $queryUserTable = mysqli_query($conn, "Select Username from USERS;");
    $arrayUserTable = array();

    //Save the above query's results into an associative array. (The table's columns' take the name of the database's columns/attributes)
    while ($helperArray = mysqli_fetch_assoc ($queryUserTable))
    {
        array_push($arrayUserTable, $helperArray);
    }

    //Checks if the inputted username is already in use. Two foreach statements because we have an array inside another array.
    foreach ($arrayUserTable as $result1)
    {
        foreach ($result1 as $result2)
        {
            if ($signupUsername == $result2)
                $helperBool = false;
        }
    }

    //If the username is not already in use and the two inputted passwords match.
    if ($helperBool && $passwordVerified)
    {
        //Encrypts the password before saving it in the database.
        $encryptedPassword = password_hash ($signupPassword, PASSWORD_DEFAULT);

        //Updates the DB.
        mysqli_query ($conn, "insert into USERS
                              values ('$signupUsername', '$encryptedPassword', '$signupEmail');");

        //Informs the user that he/she has successfully signed up and redirects him/her to the new home page.
        echo '<script>alert ("You have been successfully registered!");
        window.location.replace("../Index.php");
        </script>';
    }
    else
    {
        echo '<script>alert("The username you have entered is already in use or the passwords you have entered do not match!");
        window.location.replace("../Index.php");</script>';
    }
}

$conn->close();
?>