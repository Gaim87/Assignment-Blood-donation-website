<!--The webpage for managing the user's profile and viewing his/her accepted and created requests-->

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
    <link href="/css/datatables.css rel=" stylesheet"">
    <!--Scripts-->
    <script type="text/javascript" charset="utf8" src="/js/datatables.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/autofill/2.3.9/js/dataTables.autoFill.min.js"></script>
<!-- Datatable initialization-->
<script>    
$(document).ready(function() {
    var table = $('#CreatedRequestsTable').dataTable( {
        scrollX: true,
        scrollCollapse: true,
        paging: false,
        dom: 'Pfrtip',
        
    } );
} );
$(document).ready(function() {
    var table = $('#AcceptedRequestsTable').dataTable( {
        scrollX: true,
        scrollCollapse: true,
        paging: false,
        dom: 'Pfrtip',

    } );
} );
</script>

    <title>Profile</title>

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
                        <a class="nav-link active" href="Profile.php">Profile</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
    <!--Tab Navigation-->
   <div class="container" style="margin-top:2%; ">
        <ul class="m-0 nav nav-fill nav-justified nav-tabs" id="myTab" role="tablist" style="background-color:#D7E6FA; border-left:solid 2px; border-right:solid 2px; border-top:solid 2px;" > 
            <li class="nav-item" role="presentation"  > 
                <button class="active nav-link" id="AccountUpdate" data-bs-toggle="tab" data-bs-target="#AccountDetails" type="button" role="tab" aria-controls="AccountDetails" aria-selected="true" > Account Details </button> </li> 
            <li class="nav-item" role="presentation"> 
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false"> Accepted Requests </button> </li> 
            <li class="nav-item" role="presentation"> <button class="nav-link" id="messages-tab" data-bs-toggle="tab" data-bs-target="#CreatedRequests" type="button" role="tab" aria-controls="CreatedRequests" aria-selected="false" ></i> Created Requests </button> </li>  
            </ul> 
        <div class="border-grey p-3 tab-content" style="background-color:#D7E6FA;border-left:solid 2px; border-right:solid 2px; border-bottom:solid 2px;" > 
            <div class="tab-pane active" id="AccountDetails" role="tabpanel" aria-labelledby="AccountUpdate" style="background-color:#D7E6FA;"> 
            <div class="tab-pane fade show active" id="PillDetails" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <!-- Update profile form -->
                        <div class="container" style="padding-right:20%; padding-left:20%;" >
                            <form action="IncomingFormData/changeAccountDetails.php" method="post" >
                                <label class="mb-2 mr-sm-2">Username</label>
                                <input type="text" class="form-control mb-2 mr-sm-2" id="UsernameUpdate" placeholder="Enter new username" name="UsernameUpdate">
                                <button type="submit" class="btn btn-primary btn-block mb-4" id="ChangeUsername" name="ChangeUsername">Update</button></br>
                                <label class="mb-2 mr-sm-2">Password</label>
                                <input type="password" class="form-control mb-2 mr-sm-2" id="PasswordUpdate" placeholder="Enter new password" name="PasswordUpdate">
                                <button type="submit" name="ChangePassword" id="ChangePassword" class="btn btn-primary mb-2">Update</button></br>
                                <label class="mb-2 mr-sm-2">Email</label>
                                <input type="email" class="form-control mb-2 mr-sm-2" id="EmailUpdate" placeholder="Enter new email" name="EmailUpdate">
                                <button type="submit" name="ChangeEmail" id="ChangeEmail" class="btn btn-primary mb-2">Update</button>
                            </form>
                        </div>
                    </div>
            </div> 
            <!--Accepted requests table-->
            <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab" style="background-color:#D7E6FA;"> 
                <?php
                    include 'WebPagesAndButtons/acceptedRequestsProfilePage.php';
                ?> 
                <!--Update accepted requests form-->                   
                <div class="container" style="padding-right:35%; padding-left:35%; padding-top:3%;">
                    <form action="IncomingFormData/acceptedRequestsManagement.php" method="post">
                        <label class="mb-2 mr-sm-2">Request ID</label>
                        <input type="number" class="form-control mb-2 mr-sm-2" id="RequestID" placeholder="Enter Request ID" name="RequestID"required min="1">
                        <button type="submit" name="DonateButton" id="DonateButton" class="btn btn-primary mb-2" style="width:100%" >Confirm Donation</button>
                        <button type="submit" name="CancelButton" id="CancelButton" class="btn btn-primary mb-2" style="width:100%" >Cancel Pledge</button>
                    </form>
                </div>
            </div> 
            <!--Created Requests table-->
            <div class="tab-pane" id="CreatedRequests" role="tabpanel" aria-labelledby="messages-tab" style="background-color:#D7E6FA;">  
                <div class="container">
                    <?php
                    include 'WebPagesAndButtons/createdRequestsProfilePage.php';
                    ?>
                    <!--Update created requests form-->      
                    <form action="IncomingFormData/createdRequestsManagement.php" method="post" style="padding-right:35%; padding-left:35%; padding-top:3%;">
                        <label class="mb-2 mr-sm-2">Request ID</label>
                        <input type="number" class="form-control mb-2 mr-sm-2" id="RequestID" placeholder="Enter Request ID" name="RequestID"required min="1">
                        <button type="submit" name="EditButton" id="EditButton" class="btn btn-primary mb-2" style="width:100%" >Edit Urgency</button>
                        <button type="submit" name="DeleteButton" id="DeleteButton" class="btn btn-primary mb-2" style="width:100%" >Delete Request</button>
                    </form> 
                </div>
            </div> 
        </div>
    </div>
    <!--Footer-->
    <footer class="text-white text-center text-lg-start" style="background-color: #23242a; margin-top:23%;">
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
