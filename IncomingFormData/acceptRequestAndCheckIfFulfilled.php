<?php
if(!isset($_SESSION))
session_start();

/*
Author: 100566818

Summary: This file contains code that accepts a POST call and registers a request's acceptance (from the "Requests" page) in the database. It also updates the request's status to "Fulfilled", if needed.
*/

//Connect to the database. (Includes the contents of "dbConnect.php" in this file)
include_once ('dbConnect.php');

if (isset($_POST["RequestButton"]))            //If there is a POST request with the given id.
{
    //Query the DB for the requests that the user is allowed to accept (the ones that are active and have not already been accepted by him, as well as any he might
    //have accepted in the past but later cancelled).
    $queryRequestTable = mysqli_query ($conn, "select Request_ID from REQUEST
                                               where Request_Status = 'Active'
                                               and Request_ID
                                               not in (
                                               select Request_ID from HAS_ACCEPTED where Username = '" . $_SESSION['username'] . "')
                                               or Request_ID
                                               in (
                                               select Request_ID from HAS_ACCEPTED where Username = '" . $_SESSION['username'] . "' and Acceptance_Status = 'Cancelled');");
    $arrayRequestTable = array();
    //Save the textboxes' content in variables. ("Blood Bags Pledged" and "Request ID" textboxes)
    $bagsUserCommitedToDonate = strip_tags(mysqli_real_escape_string($conn, $_POST['BloodBagTextbox']));
    $requestID = strip_tags(mysqli_real_escape_string($conn, $_POST['RequestIDTextbox']));
    $helperBool = false;

    //Save the above query's results into an associative array. (The table's columns' take the name of the database's columns/attributes)
    while ($helperArray = mysqli_fetch_assoc ($queryRequestTable))
    {
    array_push($arrayRequestTable, $helperArray);
    }

    //Checks if the inputted request ID is included in the query's results. Two foreach statements because we have an array inside another array.
    foreach ($arrayRequestTable as $result1)
    {
        foreach ($result1 as $result2)
        {
            if ($result2 == $requestID)
                $helperBool = true;
        }
    }

    if (!$helperBool)
        echo '<script>alert ("Sorry, something went wrong! Please check that you entered the correct Request ID and try again!");
              window.location.replace("../Requests.php");</script>';
    else
    {
        $queryCheckUserCommittedBags = mysqli_query ($conn, "select Requested_Blood_Bags, Blood_Bags_Committed_To_Be_Donated from REQUEST
                                                             where Request_ID = $requestID");
        $arrayCheckUserCommittedBags = array();

        //Save the above query's results into an associative array.
        array_push($arrayCheckUserCommittedBags, mysqli_fetch_assoc ($queryCheckUserCommittedBags));

        $totalRequestedBloodBags;       //The number of blood bags the request's creator has asked for.
        $totalCommittedBloodBags;       //The sum of the blood bags that have been pledged to be donated by the users that have accepted this request.

        //Save the array's content in variables.
        foreach ($arrayCheckUserCommittedBags as $result1)
        {
            $totalRequestedBloodBags = $result1["Requested_Blood_Bags"];
            $totalCommittedBloodBags = $result1["Blood_Bags_Committed_To_Be_Donated"];
        }

        //Checks if the blood bags the user committed to donate plus the amount of blood bags other users (may) have already committed to donate is
        //equal to or less than the total number of blood bags requested by the request's creator.
        if (($totalCommittedBloodBags + $bagsUserCommitedToDonate) <= $totalRequestedBloodBags)
        {
            mysqli_query ($conn, "insert into HAS_ACCEPTED
                                  values ('" . $_SESSION['username'] . "', $requestID, 'Accepted', $bagsUserCommitedToDonate);");

            mysqli_query ($conn, "update HAS_ACCEPTED
                                  set Phials_Committed_To_Donate = $bagsUserCommitedToDonate, Acceptance_Status = 'Accepted'
                                  where Request_ID = $requestID and Username = '" . $_SESSION['username'] . "';");

            //Updates the total amount of blood bags the users have pledged to donate for that request.
            mysqli_query ($conn, "update REQUEST
                                  set Blood_Bags_Committed_To_Be_Donated = Blood_Bags_Committed_To_Be_Donated + $bagsUserCommitedToDonate
                                  where Request_ID = $requestID;");
            
            //If the number of blood bags the users have pledged to donate equals the total requested amount, the request is flagged "Fulfilled".
            mysqli_query ($conn, "if (select Requested_Blood_Bags from REQUEST where Request_ID = $requestID) = (select Blood_Bags_Committed_To_Be_Donated from REQUEST where Request_ID = $requestID) then
                                    update REQUEST
                                    set Request_Status = 'Fulfilled' where Request_ID = $requestID;
                                  end if;");

            echo '<script>alert("Request accepted");
                  window.location.replace("../Requests.php");</script>';
        }
        else
        {
            //The number of blood bags the user committed to donate surpasses the total blood bags the request's creator has asked for.
            echo '<script>alert ("Sorry, something went wrong! Please check that you entered the correct number of bags and try again!");
                  window.location.replace("../Requests.php");</script>';
        }
    }
}

$conn->close();
?>