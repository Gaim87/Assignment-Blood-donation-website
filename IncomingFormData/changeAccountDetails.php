<?php
if(!isset($_SESSION))
session_start();

/*
Author: 100566818

Summary: This file contains code that accepts a POST request from the "Account Details" tab of the user's Profile page and updates the user's username, password or email address in the database.
*/

//Connect to the database. (Includes the contents of "dbConnect.php" in this file)
include_once ('dbConnect.php');

$dbQuery;

if (isset($_POST["ChangeUsername"]))            //If there is a POST request with the given id.
{
    //Save the "Username" textbox's contents in a variable.
    $newUsername = strip_tags(mysqli_real_escape_string($conn, $_POST['UsernameUpdate']));
    //Query the DB for the already existing usernames.
    $queryUsernames = mysqli_query ($conn, "select Username from USERS;");
    $arrayUsernames = array ();

    //Save the above query's results into an associative array. (The table's columns' take the name of the database's columns/attributes)
    while ($helperArray = mysqli_fetch_assoc ($queryUsernames))
    {
        array_push($arrayUsernames, $helperArray);
    }

    //Checks if the inputted username is included in the query's results. Two foreach statements because we have an array inside another array.
    foreach ($arrayUsernames as $result1)
    {
        foreach ($result1 as $result2)
        {
            if ($newUsername == $result2)
            {
                echo '<script>alert ("This username is already in use!");
                      window.location.replace("../Profile.php");</script>';
                      $conn->close();
                      exit();
            }
        }
    }

    //Updates every instance of the user's username inside the database.
    if ($newUsername != null && $newUsername != "")
    {
        $dbQuery = mysqli_query ($conn, "update HAS_ACCEPTED
                                         set Username = '$newUsername' where Username = '" . $_SESSION['username'] . "';");

        $dbQuery = mysqli_query ($conn, "update USERS
                                         set Username = '$newUsername' where Username = '" . $_SESSION['username'] . "';");
                                     
        $dbQuery = mysqli_query ($conn, "update REQUEST
                                         set Request_Created_By = '$newUsername' where Request_Created_By = '" . $_SESSION['username'] . "';");
        
        $_SESSION['username'] = $newUsername;
    }
    else
    {
        echo '<script>alert ("Please enter a valid username!");
              window.location.replace("../Profile.php");</script>';
              $conn->close();
              exit();
    }
}
else if (isset($_POST["ChangePassword"]))
{
    //Save the "Password" textbox's contents in a variable.
    $newPassword = strip_tags(mysqli_real_escape_string($conn, $_POST['PasswordUpdate']));
    
    if ($newPassword != null && $newPassword != "")
    {
        $encryptedNewPassword = password_hash ($newPassword,  PASSWORD_DEFAULT);

        $dbQuery = mysqli_query ($conn, "update USERS
                                         set User_Password = '$encryptedNewPassword' where Username = '" . $_SESSION['username'] . "';");
    }
        else
    {
        echo '<script>alert ("Please enter a valid password!");
              window.location.replace("../Profile.php");</script>';
              $conn->close();
              exit();
    }
}
else 
{
    //Save the "Email" textbox's contents in a variable.
    $newEmail= strip_tags(mysqli_real_escape_string($conn, $_POST['EmailUpdate']));

    if ($newEmail != null && $newEmail != "")
    {
        $dbQuery = mysqli_query ($conn, "update USERS
                                         set User_Email_Address = '$newEmail' where Username = '" . $_SESSION['username'] . "';");
    }
        else
    {
        echo '<script>alert ("Please enter a valid email address!");
              window.location.replace("../Profile.php");</script>';
              $conn->close();
              exit();
    }
}

if ($dbQuery)
{
    echo '<script>alert ("Your account was successfully updated!");
          window.location.replace("../Profile.php");</script>';
}
else
    echo '<script>alert ("Sorry, something went wrong!");
          window.location.replace("../Profile.php");</script>';

$conn->close();
?>