<?php
if(!isset($_SESSION))
session_start();

/*
Author: 100566818

Summary: This file contains code that accepts a POST request from the "Create Patient" tab in the "Requests" page and creates a new patient entry.
*/

//Connect to the database. (Includes the contents of "dbConnect.php" in this file)
include_once ('dbConnect.php');

if(isset($_POST["RegisterPatient"]))            //If there is a POST request with the given id.
{
    //Save the textboxes' content in variables
    $patientFirstName = strip_tags(mysqli_real_escape_string($conn, $_POST['PatientFirst']));
    $patientLastName = strip_tags(mysqli_real_escape_string($conn, $_POST['PatientLast']));
    $patientNINo = strip_tags(mysqli_real_escape_string($conn, $_POST['PatientRegister']));             //National Insurance Number.
    $patientFathersName = strip_tags(mysqli_real_escape_string($conn, $_POST['PatientFather']));
    $patientHospitalizedIn = strip_tags(mysqli_real_escape_string($conn, $_POST['PatientHospital']));
    $helperBool = false;

    //Query the DB for the already registered patients.
    $queryPatientNINo = mysqli_query ($conn, "select Patient_NINo from PATIENT;");
    $arrayPatientNINo = array ();

    //Save the above query's results into an associative array. (The table's columns' take the name of the database's columns/attributes)
    while ($helperArray = mysqli_fetch_assoc ($queryPatientNINo))
    {
        array_push($arrayPatientNINo, $helperArray);
    }

    //Checks if the inputted patient NINo is included in the query's results.
    foreach ($arrayPatientNINo as $result1)
    {
        foreach ($result1 as $result2)
        {
            if ($patientNINo == $result2)
                $helperBool = true;
        }
    }

    if (!$helperBool)
    {
        mysqli_query ($conn, "insert into PATIENT
                              values ('$patientNINo', '$patientFirstName', '$patientLastName', '$patientFathersName', '$patientHospitalizedIn');");

        echo '<script>alert ("The patient was successfully registered!");
              window.location.replace("../Createrequest.php");</script>';
    }
    else
    {
        echo '<script>alert ("The patient has already been registered!");
              window.location.replace("../Createrequest.php");</script>';
    }
}

$conn->close();
?>