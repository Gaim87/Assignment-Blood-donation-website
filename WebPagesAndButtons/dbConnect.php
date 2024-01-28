<?php
/*
Author: 100566818

Summary: This file contains code that establishes a link with the DB.
*/

    //Setting the DB server's credentials
    // $servername = "sql300.epizy.com";   //"MySQL Hostname" στο free site που κάναμε συνδρομή
    // $username = "epiz_31582739";
    // $password = "afoKKEOYNu7W";
    // $dbname = "epiz_31582739_ABXTeam";

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "blood_donation";

    //Establishing the connection.
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    //Checking for errors.
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
        
        echo 'alert ("Error in connecting to the DB");';
    }
?>