<?php
if(!isset($_SESSION))
session_start();

/*
Author: 100566818

Summary: This file contains code that accepts a POST request from the "Create Request" tab in the "Requests" page and creates a new blood request entry.
*/

//Connect to the database. (Includes the contents of "dbConnect.php" in this file)
include_once ('dbConnect.php');

if(isset($_POST["CreateRequest"]))            //If there is a POST request with the given id.
{   
    //Query the DB for the already registered patients. (You cannot create a blood request for a patient that has not been registered)
    $queryinputtedPatientNINo = mysqli_query ($conn, "select Patient_NINo from PATIENT;");
    $arrayinputtedPatientNINo = array ();
    $inputtedNINoIsCorrect;
    //Save the textboxes' content in variables.
    $bloodBagsRequired = strip_tags(mysqli_real_escape_string($conn, $_POST['BloodBagRequest']));
    $isUrgent;
    $inputtedPatientNINo = strip_tags(mysqli_real_escape_string($conn, $_POST['PatientNINo']));
    $patientHospitalizedIn = strip_tags(mysqli_real_escape_string($conn, $_POST['PatientHospital']));

    //Save the above query's results into an associative array. (The table's columns' take the name of the database's columns/attributes)
    while ($helperArray = mysqli_fetch_assoc ($queryinputtedPatientNINo))
    {
        array_push($arrayinputtedPatientNINo, $helperArray);
    }

    //Checks if the inputted patient NINo is included in the query's results. Two foreach statements because we have an array inside another array.
    foreach ($arrayinputtedPatientNINo as $result1)
    {
        foreach ($result1 as $result2)
        {
            if ($inputtedPatientNINo == $result2)
                    $inputtedNINoIsCorrect = true;
        }
    }

    //Assigns a value for the request's urgency, depending on if the form's checkbox is checked or not.
    if (isset($_POST['UrgentBox']))
        $isUrgent = "Yes";
    else
        $isUrgent = "No";

    //If the user has inputted a correct patient NINo, the request is created.
    if ($inputtedNINoIsCorrect)
    {
        mysqli_query ($conn, "insert into REQUEST (Request_Creation_Date, Requested_Blood_Bags, Blood_Bags_Committed_To_Be_Donated,  Request_Status, Request_Is_Urgent, Request_Created_By, Patient_NINo)
                              values (NOW(), $bloodBagsRequired, 0, 'Active', '$isUrgent', '" . $_SESSION['username'] . "', '$inputtedPatientNINo');");
        
        //In case this is not the first request for this patient, the DB is updated with the newest info about his hospitalisation.
        mysqli_query ($conn, "update PATIENT
                              set Patient_Hospitalised_In = '$patientHospitalizedIn'
                              where Patient_NINo = '$inputtedPatientNINo';");
                              
        echo '<script>alert ("The request was successfully created!");
              window.location.replace("../Requests.php");</script>';
    }
    else
        {
            echo '<script>alert ("Please fill all the fields!");
                  window.location.replace("../Createrequest.php");</script>';
        }
}

$conn->close();
?>