<?php
if(!isset($_SESSION))
session_start();

/*
Author: 100566818

Summary: This file contains code that displays a list of all the requests that the user has created, after filtering them. ("Created Requests" tab of the user's Profile page)
It also allows him to toggle a request's urgency status or delete it.
*/

//Connect to the database. (Includes the contents of "dbConnect.php" in this file)
include ('dbConnect.php');

//Query the DB for patient info and for the requests that must be visible to the user (the ones he has created).
$queryCreatedRequestsInfo = mysqli_query ($conn, "select Request_ID, Request_Creation_Date, Requested_Blood_Bags, Blood_Bags_Committed_To_Be_Donated, Request_Status,
                                                  Request_Is_Urgent, Patient_First_Name, Patient_Surname, Patient_Father_Name, REQUEST.Patient_NINo, Patient_Hospitalised_In
                                                  from REQUEST, PATIENT
                                                  where Request_Created_By = '" . $_SESSION['username'] . "' and REQUEST.Patient_NINo = PATIENT.Patient_NINo;");
$arrayCreatedRequests = array();

//Save the above query's results into an associative array. (The table's columns' take the name of the database's columns/attributes)
while ($helperArray = mysqli_fetch_assoc ($queryCreatedRequestsInfo))
{
    array_push($arrayCreatedRequests, $helperArray);
}

//Display the query's results (header row).
echo '<div class="container">
      <table id="CreatedRequestsTable" class="table table-striped" style="width:100%">
      <thead>
      <tr>
      <th>Request ID</th>
      <th>Creation date</th>
      <th>Blood bags gathered</th>
      <th>Request status</th>
      <th>Urgency</th>
      <th>Patient\'s name</th>
      <th>Patient\'s surname</th>
      <th>Hospital</th>
      </tr>
      </thead>
      <tbody>';

//Apply styling and display results, depending on each individual request's status and rest of the contents.
for ($i = 0; $i < (count($arrayCreatedRequests)); $i += 1)
{    
    if ($arrayCreatedRequests[$i] ['Request_Status'] == "Completed")
    {
        echo '<tr style="background-color : green">';
    }
    else if ($arrayCreatedRequests[$i] ['Request_Status'] == "Deleted")
    {
        echo '<tr style="background-color : red">';
    }
    else
    {
        echo '<tr>';
    }

    //Table's contents.
    echo '<td>' . $arrayCreatedRequests[$i] ['Request_ID'] . '</td>
          <td>' . $arrayCreatedRequests[$i] ['Request_Creation_Date'] . '</td>            
          <td>' . $arrayCreatedRequests[$i] ['Blood_Bags_Committed_To_Be_Donated'] . ' out of ' . $arrayCreatedRequests[$i] ['Requested_Blood_Bags'] . '</td>';

    if ($arrayCreatedRequests[$i] ['Request_Status'] == "Fulfilled")
    {
        echo '<td style="color : green">' . $arrayCreatedRequests[$i] ['Request_Status'] . '</td>';
    }
    else
    {
        echo '<td>' . $arrayCreatedRequests[$i] ['Request_Status'] . '</td>';
    }

    echo '<td>' . $arrayCreatedRequests[$i] ['Request_Is_Urgent'] . '</td>
          <td>' . $arrayCreatedRequests[$i] ['Patient_First_Name'] . '</td>
          <td>' . $arrayCreatedRequests[$i] ['Patient_Surname'] . '</td>
          <td>' . $arrayCreatedRequests[$i] ['Patient_Hospitalised_In'] . '</td>
          </tr>';
}

echo '</tbody>
      </table>
      </div>';      

$conn->close();
?>