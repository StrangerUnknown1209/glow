<!DOCTYPE html>
<html lang="en">

<head>
    <?php session_start();?>
    <meta charset="utf-8">
    <title>DCS:Home</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <script src="npm/node_modules/bootstrap/dist/js/bootstrap.js"></script>
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
    </div>
    <!-- Spinner End -->


    <!-- Topbar Start -->
    <div class="container-fluid bg-primary text-white d-none d-lg-flex">
        <div class="container py-3">
            <div class="d-flex align-items-center">
                <a href="index.html">
                    <h2 class="text-white fw-bold m-0">DCS</h2>
                </a>
                <div class="ms-auto d-flex align-items-center">
                    <small class="ms-4"><i class="fa fa-map-marker-alt me-3"></i>Office address goes here</small>
                    <small class="ms-4"><i class="fa fa-envelope me-3"></i>Email?</small>
                    <small class="ms-4"><i class="fa fa-phone-alt me-3"></i>+91-DialNumber</small>
                    <div class="ms-3 d-flex">
                        <a class="btn btn-sm-square btn-light text-primary rounded-circle ms-2" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-sm-square btn-light text-primary rounded-circle ms-2" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-sm-square btn-light text-primary rounded-circle ms-2" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <div class="container-fluid bg-white sticky-top">
        <div class="container">
            <nav class="navbar navbar-expand-lg bg-white navbar-light p-lg-0">
                <a href="index.html" class="navbar-brand d-lg-none">
                    <h1 class="fw-bold m-0">DCS</h1>
                </a>
                <button type="button" class="navbar-toggler me-0" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav">
                        <a href="index.html" class="nav-item nav-link active">Home</a>
                        <a href="about.html" class="nav-item nav-link">About</a>
                        <a href="logout.php" class="nav-item nav-link">logout</a>                    </div>
                    <div class="ms-auto d-none d-lg-block">

                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->




    <!--user profile stuff start-->

    <?php
    // Replace with your database credentials
    $host = "localhost";
    $username = "admin";
    $password = "l[nv844MLLbHpD9R";
    $database = "DCS";
    
    // Start a session
    // create connection
    $conn = new mysqli($host, $username, $password, $database);
    
    // check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    $id=$_SESSION['id'];
    // get user details from database
    $sql = "SELECT * FROM usrDetails WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        // output user details in a read-only format
        $row = mysqli_fetch_assoc($result);
        ?>
        <div class="container">
    <h1>User Profile</h1>
    <div class="row">
        <div class="col-md-6">
            <form action="userProfUpdate.php" method="POST">
                <div class="form-group mb-2">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $row['uName']; ?>">
                </div>
                <div class="form-group">
                    <label for="firstName">First Name:</label>
                    <input type="text" class="form-control" id="firstName" value="<?php echo $row['fName']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="lastName">Last Name:</label>
                    <input type="text" class="form-control" id="lastName" value="<?php echo $row['lName']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="age">Age:</label>
                    <input type="text" class="form-control" id="age" name="age" value="<?php echo $row['age']; ?>">
                </div>
                <div class="form-group">
                    <label for="mobile">Mobile:</label>
                    <input type="text" class="form-control" id="mobile" value="<?php echo $row['mob']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>">
                </div>
                <div class="form-group mt-2">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


        <?php
    } else {
        echo "<div class='alert alert-danger' role='alert'>User not found.</div>";
    }
    
    // close database connection
    mysqli_close($conn);
    ?>
            <!--user profile stuff end-->

            <!--user profile stuff end-->




            <!-- Footer Start -->
            <div class="container-fluid bg-dark footer mt-5 py-5 wow fadeIn" data-wow-delay="0.1s">
                <div class="container py-5">
                    <div class="row g-5">
                        <div class="col-lg-4 col-md-6">
                            <h4 class="text-white mb-4">Our Office</h4>
                            <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>123 Street, New York, USA</p>
                            <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                            <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@example.com</p>
                            <div class="d-flex pt-3">
                                <a class="btn btn-square btn-light rounded-circle me-2" href=""><i
                                class="fab fa-twitter"></i></a>
                                <a class="btn btn-square btn-light rounded-circle me-2" href=""><i
                                class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square btn-light rounded-circle me-2" href=""><i
                                class="fab fa-youtube"></i></a>
                                <a class="btn btn-square btn-light rounded-circle me-2" href=""><i
                                class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <h4 class="text-white mb-4">Quick Links</h4>
                            <a class="btn btn-link" href="">About Us</a>
                            <a class="btn btn-link" href="">Contact Us</a>
                            <a class="btn btn-link" href="">Terms & Condition</a>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <h4 class="text-white mb-4">Business Hours</h4>
                            <p class="mb-1">Monday - Friday</p>
                            <h6 class="text-light">09:00 am - 05:00 pm</h6>
                            <p class="mb-1">Saturday</p>
                            <h6 class="text-light">09:00 am - 04:00 pm</h6>
                            <p class="mb-1">Sunday</p>
                            <h6 class="text-light">Closed?</h6>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Footer End -->


            <!-- Copyright Start -->
            <div class="container-fluid copyright py-4">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a class="fw-medium text-light" href="#">DCS Finances</a>, All Rights Reserved.
                        </div>

                    </div>
                </div>
            </div>
            <!-- Copyright End -->


            <!-- Back to Top -->
            <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i
            class="bi bi-arrow-up"></i></a>


            <!-- JavaScript Libraries -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
            <script src="lib/wow/wow.min.js"></script>
            <script src="lib/easing/easing.min.js"></script>
            <script src="lib/waypoints/waypoints.min.js"></script>
            <script src="lib/owlcarousel/owl.carousel.min.js"></script>
            <script src="lib/lightbox/js/lightbox.min.js"></script>

            <!-- Template Javascript -->
            <script src="js/main.js"></script>
</body>

</html>