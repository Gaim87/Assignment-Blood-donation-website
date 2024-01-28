<?php
if(!isset($_SESSION))
session_start();

/*
Author: 100566818

Summary: This file contains code that displays a list of all the requests that the user has accepted, after filtering them. ("Accepted Requests" tab of the user's Profile page)
It also allows him to declare that he has donated blood for a certain request or cancel his acceptance of it.

The possible values a request's "Acceptance Status" field can have are:

Accepted
Donated (user has accepted the request and pressed the "Donated" button)
Cancelled (user accepted the request but cancelled his pledge before donating blood)
*/

//Connect to the database. (Includes the contents of "dbConnect.php" in this file)
include ('dbConnect.php');

//Query the DB for the user's acceptance and patient info and also for the requests that must be visible to the user (the ones he has accepted or donated blood for, notwithstanding their status).
$queryAcceptedRequestsInfo = mysqli_query ($conn, "select REQUEST.Request_ID, Requested_Blood_Bags, Blood_Bags_Committed_To_Be_Donated, Request_Status, Request_Is_Urgent,
                                                   Phials_Committed_To_Donate, Acceptance_Status, Patient_First_Name, Patient_Surname, Patient_Father_Name, REQUEST.Patient_NINo, Patient_Hospitalised_In
                                                   from REQUEST, HAS_ACCEPTED, PATIENT
                                                   where REQUEST.Request_ID = HAS_ACCEPTED.Request_ID and REQUEST.Patient_NINo = PATIENT.Patient_NINo and HAS_ACCEPTED.Username = '" . $_SESSION['username'] . "'
                                                   and (HAS_ACCEPTED.Acceptance_Status = 'Accepted' or HAS_ACCEPTED.Acceptance_Status = 'Donated');");
$arrayAcceptedRequests = array();

//Save the above query's results into an associative array. (The table's columns' take the name of the database's columns/attributes)
while ($helperArray = mysqli_fetch_assoc ($queryAcceptedRequestsInfo))
{
    array_push($arrayAcceptedRequests, $helperArray);
}

//Display the query's results (header row).
echo '
      <table id="AcceptedRequestsTable" class="table table-striped" style="width:100%">
      <thead>
      <tr>
      <th>Request ID</th>
      <th>Blood bags gathered</th>
      <th>Request status</th>
      <th id="urgencytable" name="urgencytable">Urgency</th>
      <th>Blood bags pledged</th>
      <th>Acceptance Status</th>
      <th>Patient\'s name</th>
      <th>Patient\'s surname</th>
      <th>Patient\'s father\'s name</th>
      <th>Patient\'s NINo</th>
      <th>Hospital</th>
      </tr>
      </thead>
      <tbody>';

//Apply styling and display results, depending on each individual request's status and rest of the contents.
for ($i = 0; $i < (count($arrayAcceptedRequests)); $i += 1)
{
    if ($arrayAcceptedRequests[$i] ['Request_Status'] == "Completed")
    {
        echo '<tr style="background-color : green">';
    }
    else if ($arrayAcceptedRequests[$i] ['Request_Status'] == "Deleted")
    {
        echo '<tr style="background-color : red">';
    }
    else
    {
        echo '<tr>';
    }

    //Table's contents.
    echo '<td>' . $arrayAcceptedRequests[$i] ['Request_ID'] . '</td>         
          <td>' . $arrayAcceptedRequests[$i] ['Blood_Bags_Committed_To_Be_Donated'] . ' out of ' . $arrayAcceptedRequests[$i] ['Requested_Blood_Bags'] . '</td>';

    if ($arrayAcceptedRequests[$i] ['Request_Status'] == "Fulfilled")
    {
        echo '<td style="color : green">' . $arrayAcceptedRequests[$i] ['Request_Status'] . '</td>';
    }
    else
    {
        echo '<td>' . $arrayAcceptedRequests[$i] ['Request_Status'] . '</td>';
    }

    echo '<td>' . $arrayAcceptedRequests[$i] ['Request_Is_Urgent'] . '</td>
          <td>' . $arrayAcceptedRequests[$i] ['Phials_Committed_To_Donate'] . '</td>
          <td>' . $arrayAcceptedRequests[$i] ['Acceptance_Status'] . '</td>
          <td>' . $arrayAcceptedRequests[$i] ['Patient_First_Name'] . '</td>
          <td>' . $arrayAcceptedRequests[$i] ['Patient_Surname'] . '</td>
          <td>' . $arrayAcceptedRequests[$i] ['Patient_Father_Name'] . '</td>
          <td>' . $arrayAcceptedRequests[$i] ['Patient_NINo'] . '</td>
          <td>' . $arrayAcceptedRequests[$i] ['Patient_Hospitalised_In'] . '</td>
          </tr>';
}

//Display the query's results (end).
echo '</tbody>
      </table>';

$conn->close();
?>