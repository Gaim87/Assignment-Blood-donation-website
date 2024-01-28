<!--The webpage for creating a blood donation request or registering a patient-->

<!DOCTYPE html>
<?php
if(!isset($_SESSION))
session_start();

if (!isset ($_SESSION['loggedIn']))
    header ("location: Index.php");
?>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!--Css Styles -->
    <link href="css/bootstrap.css" rel="stylesheet" />
    <link href="css/Style.css" rel="stylesheet" />
    <link href="/DataTables/datatables.css rel=" stylesheet"">
    <!--Scripts-->
    <script type="text/javascript" charset="utf8" src="/DataTables/datatables.js"></script>
    <script src="js/bootstrap.js"></script>

    <title>Hospitals</title>
</head>
<body>
     <!--Navigation Bar-->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="Index.php"><img src="img/logo.png" width="60" height="40" /></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#CollapseBar" aria-controls="CollapseBar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="CollapseBar">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="Index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Profile.php">Profile</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Requests
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                                <li><a class="dropdown-item" href="Requests.php">View Requests</a></li>
                                <li><a class="dropdown-item" href="Createrequest.php">Create Request</a></li>
                            </ul>
                    <li class="nav-item dropdown">
                    <li class="nav-item">
                        <a class="nav-link" href="Hospital.php">Hospitals</a>
                    </li>
                </ul>
                <ul class="navbar-nav" style="padding-right:50px;">
                 <?php 
                    if (isset ($_SESSION['loggedIn'])) {
                         echo   '<li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Hello,&nbsp; ' .$_SESSION['username'].'
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                                        <li><a class="dropdown-item" href="LoginLogoutSignup/Logout.php">Logout</a></li>
                                    </ul>
                                <li class="nav-item dropdown">';
                    } 
                    ?>
                </ul>
            </div>
        </div>
    </nav>
    
    <!--Create Request/Patient-->
    <div class="container" id="LoginCont">
        <!-- Pills navs -->
        <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist" >
            <li class="nav-item" role="presentation">
                <a class="nav-link active"
                   id="tab-login"
                   data-bs-toggle="tab"
                   data-bs-target="#pills-login"
                   role="button"
                   aria-controls="pills-login"
                   aria-selected="true">Create Request</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link"
                   id="tab-register"
                   data-bs-toggle="tab"
                   data-bs-target="#pills-register"
                   role="button"
                   aria-controls="pills-register"
                   aria-selected="false">Create Patient</a>
            </li>
        </ul>
        <!-- Pills content -->
        <div class="tab-content">
            <!--Request Form Form-->
            <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
                <form action="IncomingFormData/createRequest.php" method="POST">
                    <!--Patient NINo Input -->
                    <div class="form-outline-mb-4"  style="padding-top:25px;">
                        <label class="form-label">National Insurance Number<span style="color:red"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (Patient must have already been created)</span></label> 
                        <input type="text" id="PatientNINo" name="PatientNINo" class="form-control" placeholder="Enter national insurance number" required/>                  
                    <!-- Blood Bag input -->
                    </div>
                    <div class="form-outline mb-4" style="padding-top:25px;">
                        <label class="form-label">Blood bag</label>
                        <input type="number" id="BloodBagRequest" name="BloodBagRequest" class="form-control" placeholder="Enter Blood bag amount" min="1" required/>
                    </div>
                    <!--Hospital input -->
                    <div class="form-outline mb-4">
                        <label class="form-label" for="loginName">Hospital Name</label>
                        <input type="text" id="PatientHospital" name="PatientHospital" class="form-control" placeholder="Enter hospital name" />
                    </div>
                   <!--Urgent-->
                    <div class="form-check d-flex justify-content-center mb-4">
                        <input class="form-check-input" type="checkbox" value="Yes" id="UrgentBox" name="UrgentBox" checked>
                        <label class="form-check-label" for="UrgentBox" role="button">Is urgent</label>
                    </div>                
                    <!-- Submit button -->
                    <button type="submit" id="CreateRequest" name="CreateRequest" class="btn btn-primary btn-block mb-4" style="width:100%"">Create Request</button>
                </form>
            </div>
            <!-- Patient form -->
            <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
                <form action="IncomingFormData/createPatient.php" method="POST">

                    <!-- Patient NINo -->
                    <div class="form-outline mb-4">
                        <label class="form-label" for="loginName">National Insurance Number</label>
                        <input type="text" id="PatientRegister" name="PatientRegister" class="form-control" placeholder="Enter national insurance number" required/>
                    </div>
                    <!--First Name input -->
                    <div class="form-outline mb-4">
                        <label class="form-label" for="loginName">Name</label>
                        <input type="text" id="PatientFirst" name="PatientFirst" class="form-control" placeholder="Entername" required/>
                    </div>
                    <!-- Surname input -->
                    <div class="form-outline mb-4">
                        <label class="form-label" for="loginName">Surname</label>
                        <input type="text" id="PatientLast" name="PatientLast" class="form-control" placeholder="Enter surname" required/>
                    </div>
                    <!--Father name input -->
                    <div class="form-outline mb-4">
                        <label class="form-label" for="loginName">Father Name</label>
                        <input type="text" id="PatientFather" name="PatientFather" class="form-control" placeholder="Enter father's name" />
                    </div>
                    <!--Hospital input -->
                    <div class="form-outline mb-4">
                        <label class="form-label" for="loginName">Hospital Name</label>
                        <input type="text" id="PatientHospital" name="PatientHospital" class="form-control" placeholder="Enter hospital name" />
                    </div>
                    <!-- Submit button -->
                    <button type="submit" id="RegisterPatient" name="RegisterPatient" class="btn btn-primary btn-block mb-4" style="width:100%" >Create Patient</button>
                </form>
            </div>
        </div>
    </div>
    <!--Footer-->
    <footer class="text-white text-center text-lg-start" style="background-color: #23242a; margin-top:13%;">
    <!-- Grid container -->
    <div class="container p-4">
      <!--Grid row-->
        <div class="row mt-4">
            <!--Grid column-->
            <div class="col-lg-4 col-md-12 mb-4 mb-md-0">
                <h5 class="text-uppercase mb-4">Why donate blood?</h5>

                <p>
                    Blood is the most precious gift one can give – the gift of life.
                    A decision to donate blood can save a life or even several ones, if your blood is separated into its components – red cells, platelets and plasma – which can be used individually for patients with specific medical conditions.
                </p>
            </div>
            <!--Grid column-->
            <div class="col-lg-4 col-md-12 mb-4 mb-md-0">
                <h5 class="text-uppercase mb-4">Is donating blood safe?</h5>
                <p>
                    Yes. Remember that you will only be accepted as a blood donor if you are fit and in good health.
                    The needle and blood bag used to collect blood come in a sterile pack that cannot be reused, so the whole process is as safe as possible.
                </p>

            </div>
            <!--Grid column-->
            <div class="col-lg-4 col-md-12 mb-4 mb-md-0">
                <h5 class="text-uppercase mb-4">About us</h5>
                <p>
                    We are "ABX Team", three 2nd-year Computer Science students of the Mediterranean College of Thessaloniki (in collaboration with the University of Derby), aspiring to become programmers!
                    This website was conceived in February 2022 and was built in May 2022, as part of our "Team Project" module assignment.
                </p>

            </div>

        </div>
    </div>

    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
      © 2022 Copyright: ABX Team
    </div>
  </footer>
</body>
</html>
