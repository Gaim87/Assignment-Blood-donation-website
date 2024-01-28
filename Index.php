<!--The site's home page-->

<?php
session_start();

if (isset ($_SESSION['loggedIn']))
    header ("location: Requests.php");
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
    <title>Home</title>
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
                        <a class="nav-link active" aria-current="page" href="Index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Profile.php">Profile</a>
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
    <header class="bg-dark py-5" id="Intro">
        <div class="container px-5">
            <div class="row gx-5 align-items-center justify-content-center">
                <div class="col-lg-8 col-xl-7 col-xxl-6">
                    <div class="my-5 text-center text-xl-start">
                        <h1 class="display-5 fw-bolder text-white mb-2">Welcome!</h1>
                        <p class="lead fw-normal text-white-50 mb-4">Our site enables you to donate or request blood and also locate blood donation centers in Greece!</p>
                        <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xl-start">
                            <button onclick="myFunction()" class="btn btn-primary btn-lg px-4 me-sm-3">Get Started!</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-xxl-6 d-none d-xl-block text-center"><img class="img-fluid rounded-3 my-5" src="img/IntroImage.jpg" alt="..." /></div>
            </div>
        </div>
    </header>
    <!--Login Register-->
    <div class="container" id="LoginCont" style="display:none;">
        <!-- Pills navs -->
        <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist" >
            <li class="nav-item" role="presentation">
                <a class="nav-link active"
                   id="tab-login"
                   data-bs-toggle="tab"
                   data-bs-target="#pills-login"
                   role="button"
                   aria-controls="pills-login"
                   aria-selected="true">Login</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link"
                   id="tab-register"
                   data-bs-toggle="tab"
                   data-bs-target="#pills-register"
                   role="button"
                   aria-controls="pills-register"
                   aria-selected="false"
                   >Register</a>
            </li>
        </ul>
        <!-- Pills content -->
        <div class="tab-content">
            <!--Login Form-->
            <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
                <form action="LoginLogoutSignup/LoginDataInDB.php" method="POST">
                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <label class="form-label" for="loginName">Username</label>
                        <input type="text" id="LoginUsername" name="LoginUsername" class="form-control" placeholder="Enter Username"/>
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <label class="form-label" for="loginName">Password</label>
                        <input type="password" id="LoginPassword" name="LoginPassword" class="form-control" placeholder="Enter Password"/>
                    </div>
                    <!-- Submit button -->
                    <button type="submit" id="LoginButton" name="LoginButton" class="btn btn-primary btn-block mb-4" style="width:100%">Sign in</button>
                </form>
            </div>
            <!-- Register form -->
            <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
                <form action="LoginLogoutSignup/SignupDataInDB.php" method="POST">

                    <!-- Username input -->
                    <div class="form-outline mb-4">
                        <label class="form-label" for="loginName">Username</label>
                        <input type="text" id="RegisterUsername" name="RegisterUsername" class="form-control" placeholder="Enter Username" required />
                    </div>

                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <label class="form-label" for="loginName">Email</label>
                        <input type="email" id="RegisterEmail" name="RegisterEmail" class="form-control" placeholder="Enter Email" required/>
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <label class="form-label" for="loginName">Password</label>
                        <input type="password" id="RegisterPassword" name="RegisterPassword" class="form-control" placeholder="Enter Password" required/>
                    </div>
                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <label class="form-label" for="loginName">Repeat Password</label>
                        <input type="password" id="RepeatPassword" name="RepeatPassword" class="form-control" placeholder="Repeat Password" required/>
                    </div>
                    <!-- Submit button -->
                    <button type="submit" id="RegisterSubmit" name="RegisterSubmit" class="btn btn-primary btn-block mb-4" style="width:100%">Sign up </button>
                </form>
            </div>
        </div>
    </div>
    <!--Footer-->
    <footer class="text-white text-center text-lg-start" style="background-color: #23242a; margin-top: 13%;">
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
                    Yes! Remember that you will only be accepted as a blood donor if you are fit and in good health.
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
<script>
function myFunction() {
  var x = document.getElementById("Intro");
  var y = document.getElementById("LoginCont");
  x.style.display = "none";
  y.style.display = "block";

}
</script>
</html>
