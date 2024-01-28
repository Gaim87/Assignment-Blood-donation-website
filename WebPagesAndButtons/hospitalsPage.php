<?php
if(!isset($_SESSION))
session_start();

/*
Author: 100566818

Summary: This file contains code that displays a list of the hospitals saved in the DB ("Hospitals" page).
*/

//Connect to the database. (Includes the contents of "dbConnect.php" in this file)
include_once ('dbConnect.php');

//Query the DB for the hospitals.
$queryHospitalTable = mysqli_query ($conn, "select Hospital_Name, Hospital_Address, Hospital_City, Hospital_Prefecture, Donation_Service_Phone
                                            from HOSPITAL;");
$arrayHospitalTable = array();

//Save the above query's results into an associative array. (The table's columns' take the name of the database's columns/attributes)
while ($helperArray = mysqli_fetch_assoc ($queryHospitalTable))
{
    array_push($arrayHospitalTable, $helperArray);
}

//Display the query's results (header row).
echo '<div class="container">
        <table id="HospitalsTable" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Hospital name</th>
                    <th>Address</th>    
                    <th>City</th>
                    <th>Prefecture</th>
                    <th>Contact</th>
                </tr>
            </thead>
            <tbody>';

//Table's contents.
for ($i = 0; $i < (count($arrayHospitalTable)); $i += 1)
{
  echo '<tr>
            <td>' . $arrayHospitalTable[$i] ['Hospital_Name'] . '</td>
            <td>' . $arrayHospitalTable[$i] ['Hospital_Address'] . '</td>
            <td>' . $arrayHospitalTable[$i] ['Hospital_City'] . '</td>
            <td>' . $arrayHospitalTable[$i] ['Hospital_Prefecture'] . '</td>
            <td>' . $arrayHospitalTable[$i] ['Donation_Service_Phone'] . '</td>
        </tr>';
}

echo '  </tbody>
        </table>
        </div>';

$conn->close();
?>