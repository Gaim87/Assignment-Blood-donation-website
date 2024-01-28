<?php
if(!isset($_SESSION))
session_start();

/*
Author: 100566818

Summary: This file contains code that displays all active requests, after filtering them ("Requests" page).

The possible values a request can have are:

Active (users have accepted the request but the number of the phials they have declared/committed to donate does not cover the requested amount).
Fulfilled [a user/a number of users have pressed the "Accept" button and have committed to donate all of the requested phials].
Completed (all requested blood bags have been donated)
Deleted (the request's creator decided to delete it)
*/

//Connect to the database. (Includes the contents of "dbConnect.php" in this file)
include_once ('dbConnect.php');

//Query the DB for the requests that must be visible to the user (the ones he has not accepted or created and any ones he may have accepted but later cancelled).
$queryRequestTable = mysqli_query ($conn, "select * from REQUEST
                                           where REQUEST.Request_Status = 'Active'
                                           and Request_ID
                                           not in (
                                           select Request_ID from HAS_ACCEPTED where Username = '" . $_SESSION['username'] . "')
                                           and Request_ID
                                           not in (
                                           select Request_ID from REQUEST where Request_Created_By = '" . $_SESSION['username'] . "')
                                           or Request_ID
                                           in (
                                           select Request_ID from HAS_ACCEPTED where Username = '" . $_SESSION['username'] . "' and Acceptance_Status = 'Cancelled')
                                           order by Request_Is_Urgent desc, Request_Creation_Date asc;
                                           ");
$arrayRequestTable = array();

//Save the above query's results into an associative array. (The table's columns' take the name of the database's columns/attributes)
while ($helperArray = mysqli_fetch_assoc ($queryRequestTable))
{
    array_push($arrayRequestTable, $helperArray);
}

//Display the query's results (header row).
echo '<div class="container" style="padding-top:3%;">
      <table id="RequestsTable" class="table table-striped" style="width:100%">
      <thead>
      <tr>
      <th>Request ID</th>
      <th id="modal">Creation date</th>
      <th>Blood bags gathered</th>      
      <th>Urgency</th>
      </tr>
      </thead>';

      //Table's contents.
for ($i = 0; $i < (count($arrayRequestTable)); $i += 1)
{    
    echo '  <tr>
                <td>' . $arrayRequestTable[$i] ['Request_ID'] . '</td>
                <td>' . $arrayRequestTable[$i] ['Request_Creation_Date'] . '</td>
                <td>' . $arrayRequestTable[$i] ['Blood_Bags_Committed_To_Be_Donated'] . ' out of ' . $arrayRequestTable[$i] ['Requested_Blood_Bags'] . '</td>
                ';

                //Apply styling, if the request is urgent
                if ($arrayRequestTable[$i] ['Request_Is_Urgent'] == "Yes")
                {
                    echo '<td style="color : red">' . $arrayRequestTable[$i] ['Request_Is_Urgent'] . '</td>';
                }
                else
                    echo '<td>' . $arrayRequestTable[$i] ['Request_Is_Urgent'] . '</td>
            </tr>';
}

echo '</table>
      </div>';

$conn->close();
?>