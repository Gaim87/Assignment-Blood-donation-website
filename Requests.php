<!--The webpage for viewing/accepting registered blood donation requests-->

<?php
if(!isset($_SESSION))
session_start();

if (!isset ($_SESSION['loggedIn']))
    header ("location: Index.php");
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!--Css Styles -->
    <link href="css/bootstrap.css" rel="stylesheet" />
    <link href="css/Style.css" rel="stylesheet" />
    <!--Scripts-->
    <script src="js/bootstrap.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <!-- Datatable initialization-->
    <script>$(document).ready(function () 
        {
            $('#RequestsTable').DataTable(
                {
                    "order":[],                      
                    searchPanes: {
                            controls: false
                        },
                    dom: 'Pfrtip',
                });
        });
    </script>
    


    <title>Requests</title>
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
    <!-- Request table -->
    <?php include 'WebPagesAndButtons/requestsPage.php' ?>
        <!-- Accept request form -->
        <div class="container" style="padding-right:40%; padding-top:3%;">
            <form action="IncomingFormData/acceptRequestAndCheckIfFulfilled.php" method="post">
                <label class="mb-2 mr-sm-2">Request ID:</label>
                <input type="number" class="form-control mb-2 mr-sm-2" id="RequestIDTextbox" placeholder="Enter Request ID" name="RequestIDTextbox"required min="1">
                <label class="mb-2 mr-sm-2">Blood bags pledged:</label>
                <input type="number" class="form-control mb-2 mr-sm-2" id="BloodBagTextbox" placeholder="Enter blood bags" name="BloodBagTextbox"min="1" value="1" required>
                <button type="submit" name="RequestButton" id="RequestButton" class="btn btn-primary mb-2" style="width:100%" >Accept Request</button>
                </form>
        </div>

    <!--Footer-->
    <footer class="text-white text-center text-lg-start" style="background-color: #23242a; margin-top:2%;">
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
