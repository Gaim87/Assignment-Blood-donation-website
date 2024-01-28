<?php
if(!isset($_SESSION))
session_start();

/*
Author: 100566818

Summary: This file contains code that, depending on the POST call from the "Created Requests" tab of the user's Profile page, either deletes a request
by updating its status to "Deleted" or toggles its urgency status.
*/

//Connect to the database. (Includes the contents of "dbConnect.php" in this file)
include_once ('dbConnect.php');

if (isset($_POST["DeleteButton"]))            //If there is a POST request with the given id.
{
    //Query the DB for the requests that the user is allowed to delete (the ones he has created and are either fulfilled or active).
    $queryCreatedRequestsInfo = mysqli_query ($conn, "select Request_ID from REQUEST
                                                      where Request_Created_By = '" . $_SESSION['username'] . "' and (Request_Status = 'Active' or Request_Status = 'Fulfilled');");
    $arrayCreatedRequests = array();
    //Save the "Request ID" textbox's contents in a variable.
    $requestID = strip_tags(mysqli_real_escape_string($conn, $_POST['RequestID']));
    $helperBool = false;

    //Save the above query's results into an associative array. (The table's columns' take the name of the database's columns/attributes)
    while ($helperArray = mysqli_fetch_assoc ($queryCreatedRequestsInfo))
    {
        array_push($arrayCreatedRequests, $helperArray);
    }

    //Checks if the inputted request ID is included in the query's results. Two foreach statements because we have an array inside another array.
    foreach ($arrayCreatedRequests as $result1)
    {
        foreach ($result1 as $result2)
        {
            if ($result2 == $requestID)
                $helperBool = true;
        }
    }

    if (!$helperBool)
        echo '<script>alert ("Sorry, something went wrong! Please check that you entered the correct Request ID!");
              window.location.replace("../Profile.php");</script>';
    else
    {
        if (mysqli_query ($conn, "update REQUEST
                                  set Request_Status = 'Deleted'
                                  where Request_ID = $requestID and Request_Created_By = '" . $_SESSION['username'] . "';"))
        {
            echo '<script>alert ("The request was successfully deleted!");
                  window.location.replace("../Profile.php");</script>';
        }
        else
            echo '<script>alert ("Sorry, something went wrong!");
                  window.location.replace("../Profile.php");</script>';
    }
}
else if (isset($_POST["EditButton"]))
{
    //Query the DB for the requests that the user is allowed to edit (the ones he has created and are either fulfilled or active).
    $queryCreatedRequestsInfo = mysqli_query ($conn, "select Request_ID from REQUEST
                                                      where Request_Created_By = '" . $_SESSION['username'] . "' and (Request_Status = 'Active' or Request_Status = 'Fulfilled');");
    $arrayCreatedRequests = array();
    //Save the "Request ID" textbox's contents in a variable.
    $requestID = strip_tags(mysqli_real_escape_string($conn, $_POST['RequestID']));
    $helperBool = false;

    //Save the above query's results into an associative array.
    while ($helperArray = mysqli_fetch_assoc ($queryCreatedRequestsInfo))
    {
        array_push($arrayCreatedRequests, $helperArray);
    }

    //Checks if the inputted request ID is included in the query's results.
    foreach ($arrayCreatedRequests as $result1)
    {
        foreach ($result1 as $result2)
        {
            if ($result2 == $requestID)
                $helperBool = true;
        }
    }

    if (!$helperBool)
        echo '<script>alert ("Sorry, something went wrong! Please check that you entered the correct Request ID!");
              window.location.replace("../Profile.php");</script>';
    else
    {
        //If the request's urgency is set to "Yes", it becomes "No" and vice versa
        if (mysqli_query ($conn, "if (select Request_Is_Urgent from REQUEST where Request_Created_By = '" . $_SESSION['username'] . "' and (Request_Status = 'Active' or Request_Status = 'Fulfilled')) = 'Yes' then
                                    update REQUEST
                                    set Request_Is_Urgent = 'No'
                                    where Request_ID = $requestID;
                                    
                                  else
                                    update REQUEST
                                    set Request_Is_Urgent = 'Yes'
                                    where Request_ID = $requestID;
                                  end if;"))
        {
            echo '<script>alert ("The request was successfully updated!");
                  window.location.replace("../Profile.php");</script>';
        }
        else
        {
            echo '<script>alert ("Sorry, something went wrong!");
                  window.location.replace("../Profile.php");</script>';
        }
    }
}

$conn->close();
?>