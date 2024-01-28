<?php
if(!isset($_SESSION))
session_start();

/*
Author: 100566818

Summary: This file contains code that accepts POST requests from the "Accepted Requests" tab of the user's Profile page.
         Depending on the POST call, it either registers the user's blood donation in the system ("Confirm Donation" button) or cancels a request's acceptance ("Cancel Pledge" button).
*/

//Connect to the database. (Includes the contents of "dbConnect.php" in this file)
include ('dbConnect.php');

if (isset($_POST["DonateButton"]))            //If there is a POST request with the given id.
{
    //Query the DB for the requests that the user is allowed to donate blood for [the ones he has accepted and are either fulfilled (users have pledged to donate
    //all asked for blood bags) or active].
    $queryAcceptedRequestsInfo = mysqli_query ($conn, "select REQUEST.Request_ID from REQUEST, HAS_ACCEPTED
                                                       where REQUEST.Request_ID = HAS_ACCEPTED.Request_ID and HAS_ACCEPTED.Username = '" . $_SESSION['username'] . "'
                                                       and HAS_ACCEPTED.Acceptance_Status = 'Accepted'
                                                       and (REQUEST.Request_Status = 'Active' or REQUEST.Request_Status = 'Fulfilled');");
    $arrayAcceptedRequests = array();
    //Save the "Request ID" textbox's contents in a variable.
    $requestID = strip_tags(mysqli_real_escape_string($conn, $_POST['RequestID']));
    $helperBool = false;

    //Save the above query's results into an associative array. (The table's columns' take the name of the database's columns/attributes)
    while ($helperArray = mysqli_fetch_assoc ($queryAcceptedRequestsInfo))
    {
        array_push($arrayAcceptedRequests, $helperArray);
    }

    //Checks if the inputted request ID is included in the query's results. Two foreach statements because we have an array inside another array.
    foreach ($arrayAcceptedRequests as $result1)
    {
        foreach ($result1 as $result2)
        {
            if ($result2 == $requestID)
                $helperBool = true;
        }
    }

    if (!$helperBool)
        echo '<script>alert ("Sorry, something went wrong! Please check that you entered the correct Request ID and try again!");
              window.location.replace("../Profile.php");</script>';
    else
    {
        mysqli_query ($conn, "update HAS_ACCEPTED
                              set Acceptance_Status = 'Donated' where Request_ID = $requestID and Username = '" . $_SESSION['username'] . "';");

        //If, after a user's donation, all the requested blood bags have been donated, the request is flagged "Completed".
        mysqli_query ($conn, "if (select sum(Phials_Committed_To_Donate) from HAS_ACCEPTED where Acceptance_Status = 'Donated' and Request_ID = $requestID) = (select Requested_Blood_Bags from REQUEST where Request_ID = $requestID) then
                                update REQUEST
                                set Request_Status = 'Completed'
                                where Request_ID = $requestID;
                              end if;");

        echo '<script>alert ("Your donation was registered successfully!");
              window.location.replace("../Profile.php");</script>';
    }
}
else if (isset($_POST["CancelButton"]))
{
    //Query the DB for the requests that the user is allowed to cancel his acceptance of (the ones he has accepted and are either fulfilled or active).
    $queryAcceptedRequestsInfo = mysqli_query ($conn, "select REQUEST.Request_ID from REQUEST, HAS_ACCEPTED
                                                       where REQUEST.Request_ID = HAS_ACCEPTED.Request_ID and HAS_ACCEPTED.Username = '" . $_SESSION['username'] . "'
                                                       and HAS_ACCEPTED.Acceptance_Status = 'Accepted'
                                                       and (REQUEST.Request_Status = 'Active' or REQUEST.Request_Status = 'Fulfilled');");
    $arrayAcceptedRequests = array();
    //Save the "Request ID" textbox's contents in a variable.
    $requestID = strip_tags(mysqli_real_escape_string($conn, $_POST['RequestID']));
    $helperBool = false;

    //Save the above query's results into an associative array.
    while ($helperArray = mysqli_fetch_assoc ($queryAcceptedRequestsInfo))
    {
        array_push($arrayAcceptedRequests, $helperArray);
    }

    //Checks if the inputted request ID is included in the query's results.
    foreach ($arrayAcceptedRequests as $result1)
    {
        foreach ($result1 as $result2)
        {
            if ($result2 == $requestID)
                $helperBool = true;
        }
    }

    if (!$helperBool)
        echo '<script>alert ("Sorry, something went wrong! Please check that you entered the correct Request ID and try again!");
              window.location.replace("../Profile.php");</script>';
    else
    {
        mysqli_query ($conn, "update HAS_ACCEPTED
                              set Acceptance_Status = 'Cancelled' where Request_ID = $requestID and Username = '" . $_SESSION['username'] . "';");

        //The amount of blood bags the user had committed to donate is subtracted from the total blood bags that the users have committed to donate for that request.
        mysqli_query ($conn, "update REQUEST
                              set Blood_Bags_Committed_To_Be_Donated = Blood_Bags_Committed_To_Be_Donated - (select Phials_Committed_To_Donate from HAS_ACCEPTED where Request_ID = $requestID and Username = '" . $_SESSION['username'] . "')
                              where Request_ID = $requestID;");

        //If the request was flagged "fulfilled", it is once more flagged "Active", because the user's blood bags have been subtracted.
        mysqli_query ($conn, "if (select Request_Status from REQUEST where Request_ID = $requestID) = 'Fulfilled' then
                                update REQUEST
                                set Request_Status = 'Active'
                                where Request_ID = $requestID;
                             end if;");
    
        echo '<script>alert ("Your request acceptance was successfully cancelled!");
              window.location.replace("../Profile.php");</script>';   
    }
}

$conn->close();
?>