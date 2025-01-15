<?php
    session_start();
    include('dbconnect.php');
 

    if(isset($_POST['btnsubmit'])){
        if(!isset($_SESSION['CID']) ){

            echo "<script>window.alert('Please login first.You can again book and recent book will be deleted.')</script>";
            echo "<script>window.location='login.php'</script>";
        }
        else{
            $OrderID = 'OR_' . str_pad(mysqli_fetch_assoc(mysqli_query($connect, "SELECT MAX(CAST(RIGHT(OrderID, 3) AS UNSIGNED)) AS LastID FROM orders"))['LastID'] + 1, 3, '0', STR_PAD_LEFT);
        $date = $_POST['odate'];
        $cname= $_POST['cname'];
        $VNumber = $_POST['txtVNumer'];
        $ptypeid = $_POST['ptype'];
        $CID= $_SESSION['CID'];
        $litres = $_POST['txtlitres'];
        $cboftype = $_POST['cboftype'];
        $pamount = $_POST['txtamount'];
        $OrderDID = 'ORD_' . str_pad(mysqli_fetch_assoc(mysqli_query($connect, "SELECT MAX(CAST(RIGHT(OrderdetailsCode, 3) AS UNSIGNED)) AS LastID FROM orderdetails"))['LastID'] + 1, 3, '0', STR_PAD_LEFT);
        // $ptype = "SELECT PaymentTypeCode FROM paymenttype WHERE PaymentType = '$ptypeid'";                      
        // $result = mysqli_query($connect, $ptype);
        // $row = mysqli_fetch_array($result);
        // $ptypes = $row['PaymentTypeCode'];
        $cbovtype = $_POST['cbovtype'];
        $cbopro = $_POST['cbopro'];
        // $cbopro = "SELECT PromotionCode FROM promotion WHERE PromotionName = '$cbopro'";
        // $result = mysqli_query($connect, $cbopro);
        // $row = mysqli_fetch_array($result);
        // $cbopros = $row['PromotionCode'];
        $cbobids = $_POST['cbobid'];
        // $cbobid = "SELECT Branchid FROM branches WHERE BranchName = '$cbobid'";
        // $result = mysqli_query($connect, $cbobid);
        // $row = mysqli_fetch_array($result);
        // $cbobids = $row['Branchid'];
     echo   $orderdetailsinsert = "INSERT INTO orderdetails(OrderdetailsCode,OrderID,  OrderLitres, OrderAmount,PetrolCode) 
                        VALUES ('$OrderDID','$OrderID' , '$litres', '$pamount', '$cboftype')";
       
      echo  $saleinsert = "INSERT INTO orders(OrderID, OrderDate, CustomerID, CarNumber, PaymentTypeCode, CarType, PromotionCode, Branchid) 
                        VALUES ('$OrderID', '$date', '$CID', '$VNumber', '$ptypeid', '$cbovtype', '$cbopro', '$cbobids')";
        $query=mysqli_query($connect, $saleinsert);
        $sdquery=mysqli_query($connect, $orderdetailsinsert);
if ($query && $sdquery) {
        echo "<script>alert('You are booked. Your order id is ".$OrderID."  Please remember it.')</script>";
        echo "<script>window.location='index.php'</script>";
    
}
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Petrol Station</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@600&family=Lobster+Two:wght@700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <!-- <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div> -->
        <!-- Spinner End -->


        <!-- Navbar Start -->
        <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top px-4 px-lg-5 py-lg-0">
            <a href="index.php" class="navbar-brand">
                <h1 class="m-0 text-primary">Denko</h1>
            </a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                    <a href="index.php" class="nav-item nav-link active">Home</a>
                    <a href="about.php" class="nav-item nav-link">About Us</a>
                    <a href="booking.php" class="nav-item nav-link">Booking</a>
                    <a href="contact.php" class="nav-item nav-link">Contact Us</a>
                </div>
                <?php
           
           if (!isset($_SESSION['CID'])) 
           
           {
               echo "<a href='login.php' class='btn btn-primary rounded-pill px-3 d-none d-lg-block'>Log in / Sign Up<i class='fa fa-arrow-right ms-3'></i></a>";
           } 
           
           
           
           else
           {
              
               echo "<a href='logout.php'>Log out l </a>";
               echo " <a href='UCustomer.php'> l Your Account</a>";
           
           }
           ?>

            </div>
        </nav>
        <!-- Navbar End -->


        <!-- Carousel Start -->
        <div class="container-fluid p-0 mb-5">
            <div class="owl-carousel header-carousel position-relative">
                <div class="owl-carousel-item position-relative">
                    <img class="img-fluid" src="img/img1.jpg" alt="">
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center"
                        style="background: rgba(0, 0, 0, .2);">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-10 col-lg-8">
                                    <h1 class="display-2 text-white animated slideInDown mb-4">The Best Fuel For Your
                                        Car</h1>
                                    <p class="fs-5 fw-medium text-white mb-4 pb-2">Selecting the appropriate gasoline
                                        for your automobile may prolong its life,
                                        increase performance, and improve fuel efficiency. Our premium fuels are
                                        expertly blended to minimize emissions,
                                        clean your engine, and provide a strong and smooth driving experience.</p>
                                    <a href=""
                                        class="btn btn-primary rounded-pill py-sm-3 px-sm-5 me-3 animated slideInLeft">Learn
                                        More</a>
                                    <a href=""
                                        class="btn btn-dark rounded-pill py-sm-3 px-sm-5 animated slideInRight">Our
                                        Classes</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="owl-carousel-item position-relative">
                    <img class="img-fluid" src="img/img2.jpg" alt="">
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center"
                        style="background: rgba(0, 0, 0, .2);">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-10 col-lg-8">
                                    <h1 class="display-2 text-white animated slideInDown mb-4">Premium Fuel Solutions
                                    </h1>
                                    <p class="fs-5 fw-medium text-white mb-4 pb-2">Discover the power of our advanced
                                        fuel technology. Our premium fuels are designed to
                                        optimize engine performance, enhance fuel efficiency, and reduce emissions.
                                        Experience smoother rides and greater mileage with every tank.</p>
                                    <a href=""
                                        class="btn btn-primary rounded-pill py-sm-3 px-sm-5 me-3 animated slideInLeft">Learn
                                        More</a>
                                    <a href=""
                                        class="btn btn-dark rounded-pill py-sm-3 px-sm-5 animated slideInRight">Our
                                        Prodcus</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Carousel End -->


        <!-- Facilities Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h1 class="mb-3">Fuel Types</h1>
                    <p>Selecting the appropriate gasoline for your vehicle is
                        essential to preserving its peak efficiency and performance.
                        These are the primary fuel kinds that are accessible:</p>
                </div>
                <div class="row g-4">
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="facility-item">
                            <div class="facility-icon bg-primary">
                                <span class="bg-primary"></span>
                                <i class="fa fa-car-alt fa-3x text-primary"></i>
                                <span class="bg-primary"></span>
                            </div>
                            <div class="facility-text bg-primary">
                                <h3 class="text-primary mb-3">92 ROMS</h3>
                                <p class="mb-0">100% purify</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="facility-item">
                            <div class="facility-icon bg-success">
                                <span class="bg-success"></span>
                                <i class="fa fa-car-alt fa-3x text-success"></i>
                                <span class="bg-success"></span>
                            </div>
                            <div class="facility-text bg-success">
                                <h3 class="text-success mb-3">97 ROMS</h3>
                                <p class="mb-0">100% purify</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="facility-item">
                            <div class="facility-icon bg-warning">
                                <span class="bg-warning"></span>
                                <i class="fa fa-bus-alt fa-3x text-warning"></i>
                                <span class="bg-warning"></span>
                            </div>
                            <div class="facility-text bg-warning">
                                <h3 class="text-warning mb-3">PSD</h3>
                                <p class="mb-0">100 % purify</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                        <div class="facility-item">
                            <div class="facility-icon bg-info">
                                <span class="bg-info"></span>
                                <i class="fa fa-bus-alt fa-3x text-info"></i>
                                <span class="bg-info"></span>
                            </div>
                            <div class="facility-text bg-info">
                                <h3 class="text-info mb-3">HPSD</h3>
                                <p class="mb-0">100% purify</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Facilities End -->


        <!-- About Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                        <h1 class="mb-4">Learn More About Our Work And Our Activities</h1>
                        <p>We stand out in the automotive sector because to our dedication to quality and innovation.
                            Our commitment is in offering premium fuel options that boost vehicle efficiency, lessen
                            environmental impact, and increase vehicle performance.</p>
                        <p class="mb-4">Together with our premium fuels, we also take part in a number of community
                            service projects and sustainable practice advancements. Every action we do, from educational
                            seminars to environmental projects, aims to have a good influence. Come along on our journey
                            toward a future that is more efficient and greener.</p>
                        <div class="row g-4 align-items-center">
                            <div class="col-sm-6">
                                <a class="btn btn-primary rounded-pill py-3 px-5" href="">Read More</a>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle flex-shrink-0" src="img/user.jpg" alt=""
                                        style="width: 45px; height: 45px;">
                                    <div class="ms-3">
                                        <h6 class="text-primary mb-1">Kyaw Min Zaw</h6>
                                        <small>CEO & Founder</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 about-img wow fadeInUp" data-wow-delay="0.5s">
                        <div class="row">
                            <div class="col-12 text-center">
                                <img class="img-fluid w-75 rounded-circle bg-light p-3" src="img/img3.jpg" alt="">
                            </div>
                            <div class="col-6 text-start" style="margin-top: -150px;">
                                <img class="img-fluid w-100 rounded-circle bg-light p-3" src="img/img4.jpg" alt="">
                            </div>
                            <div class="col-6 text-end" style="margin-top: -150px;">
                                <img class="img-fluid w-100 rounded-circle bg-light p-3" src="img/img5.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->


        <!-- Call To Action Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="bg-light rounded">
                    <div class="row g-0">
                        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s" style="min-height: 400px;">
                            <div class="position-relative h-100">
                                <img class="position-absolute w-75 h-100 rounded" src="img/img6.jpg"
                                    style="object-fit: cover;">
                            </div>
                        </div>
                        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                            <div class="h-100 d-flex flex-column justify-content-center p-5">
                                <h1 class="mb-4">Become A Member</h1>
                                <p class="mb-4">Become a part of our community of enthusiastic professionals
                                    and car enthusiasts. You'll receive exclusive discounts, first access to new items,
                                    and
                                    invites to member-only events as a member, among other advantages. Our membership
                                    program is intended to improve your experience
                                    and provide you with up-to-date information on the newest developments in automobile
                                    maintenance and fuel technology.
                                </p>
                                <a class="btn btn-primary py-3 px-5" href="login.php">Get Started Now<i
                                        class="fa fa-arrow-right ms-2"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Call To Action End -->


        <!-- Classes Start -->
        <!-- <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h1 class="mb-3">School Classes</h1>
                    <p>Eirmod sed ipsum dolor sit rebum labore magna erat. Tempor ut dolore lorem kasd vero ipsum sit eirmod sit. Ipsum diam justo sed rebum vero dolor duo.</p>
                </div>
                <div class="row g-4">
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="classes-item">
                            <div class="bg-light rounded-circle w-75 mx-auto p-3">
                                <img class="img-fluid rounded-circle" src="img/classes-1.jpg" alt="">
                            </div>
                            <div class="bg-light rounded p-4 pt-5 mt-n5">
                                <a class="d-block text-center h3 mt-3 mb-4" href="">Art & Drawing</a>
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div class="d-flex align-items-center">
                                        <img class="rounded-circle flex-shrink-0" src="img/user.jpg" alt="" style="width: 45px; height: 45px;">
                                        <div class="ms-3">
                                            <h6 class="text-primary mb-1">Jhon Doe</h6>
                                            <small>Teacher</small>
                                        </div>
                                    </div>
                                    <span class="bg-primary text-white rounded-pill py-2 px-3" href="">$99</span>
                                </div>
                                <div class="row g-1">
                                    <div class="col-4">
                                        <div class="border-top border-3 border-primary pt-2">
                                            <h6 class="text-primary mb-1">Age:</h6>
                                            <small>3-5 Years</small>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="border-top border-3 border-success pt-2">
                                            <h6 class="text-success mb-1">Time:</h6>
                                            <small>9-10 AM</small>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="border-top border-3 border-warning pt-2">
                                            <h6 class="text-warning mb-1">Capacity:</h6>
                                            <small>30 Kids</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="classes-item">
                            <div class="bg-light rounded-circle w-75 mx-auto p-3">
                                <img class="img-fluid rounded-circle" src="img/classes-2.jpg" alt="">
                            </div>
                            <div class="bg-light rounded p-4 pt-5 mt-n5">
                                <a class="d-block text-center h3 mt-3 mb-4" href="">Color Management</a>
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div class="d-flex align-items-center">
                                        <img class="rounded-circle flex-shrink-0" src="img/user.jpg" alt="" style="width: 45px; height: 45px;">
                                        <div class="ms-3">
                                            <h6 class="text-primary mb-1">Jhon Doe</h6>
                                            <small>Teacher</small>
                                        </div>
                                    </div>
                                    <span class="bg-primary text-white rounded-pill py-2 px-3" href="">$99</span>
                                </div>
                                <div class="row g-1">
                                    <div class="col-4">
                                        <div class="border-top border-3 border-primary pt-2">
                                            <h6 class="text-primary mb-1">Age:</h6>
                                            <small>3-5 Years</small>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="border-top border-3 border-success pt-2">
                                            <h6 class="text-success mb-1">Time:</h6>
                                            <small>9-10 AM</small>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="border-top border-3 border-warning pt-2">
                                            <h6 class="text-warning mb-1">Capacity:</h6>
                                            <small>30 Kids</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="classes-item">
                            <div class="bg-light rounded-circle w-75 mx-auto p-3">
                                <img class="img-fluid rounded-circle" src="img/classes-3.jpg" alt="">
                            </div>
                            <div class="bg-light rounded p-4 pt-5 mt-n5">
                                <a class="d-block text-center h3 mt-3 mb-4" href="">Athletic & Dance</a>
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div class="d-flex align-items-center">
                                        <img class="rounded-circle flex-shrink-0" src="img/user.jpg" alt="" style="width: 45px; height: 45px;">
                                        <div class="ms-3">
                                            <h6 class="text-primary mb-1">Jhon Doe</h6>
                                            <small>Teacher</small>
                                        </div>
                                    </div>
                                    <span class="bg-primary text-white rounded-pill py-2 px-3" href="">$99</span>
                                </div>
                                <div class="row g-1">
                                    <div class="col-4">
                                        <div class="border-top border-3 border-primary pt-2">
                                            <h6 class="text-primary mb-1">Age:</h6>
                                            <small>3-5 Years</small>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="border-top border-3 border-success pt-2">
                                            <h6 class="text-success mb-1">Time:</h6>
                                            <small>9-10 AM</small>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="border-top border-3 border-warning pt-2">
                                            <h6 class="text-warning mb-1">Capacity:</h6>
                                            <small>30 Kids</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="classes-item">
                            <div class="bg-light rounded-circle w-75 mx-auto p-3">
                                <img class="img-fluid rounded-circle" src="img/classes-4.jpg" alt="">
                            </div>
                            <div class="bg-light rounded p-4 pt-5 mt-n5">
                                <a class="d-block text-center h3 mt-3 mb-4" href="">Language & Speaking</a>
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div class="d-flex align-items-center">
                                        <img class="rounded-circle flex-shrink-0" src="img/user.jpg" alt="" style="width: 45px; height: 45px;">
                                        <div class="ms-3">
                                            <h6 class="text-primary mb-1">Jhon Doe</h6>
                                            <small>Teacher</small>
                                        </div>
                                    </div>
                                    <span class="bg-primary text-white rounded-pill py-2 px-3" href="">$99</span>
                                </div>
                                <div class="row g-1">
                                    <div class="col-4">
                                        <div class="border-top border-3 border-primary pt-2">
                                            <h6 class="text-primary mb-1">Age:</h6>
                                            <small>3-5 Years</small>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="border-top border-3 border-success pt-2">
                                            <h6 class="text-success mb-1">Time:</h6>
                                            <small>9-10 AM</small>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="border-top border-3 border-warning pt-2">
                                            <h6 class="text-warning mb-1">Capacity:</h6>
                                            <small>30 Kids</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="classes-item">
                            <div class="bg-light rounded-circle w-75 mx-auto p-3">
                                <img class="img-fluid rounded-circle" src="img/classes-5.jpg" alt="">
                            </div>
                            <div class="bg-light rounded p-4 pt-5 mt-n5">
                                <a class="d-block text-center h3 mt-3 mb-4" href="">Religion & History</a>
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div class="d-flex align-items-center">
                                        <img class="rounded-circle flex-shrink-0" src="img/user.jpg" alt="" style="width: 45px; height: 45px;">
                                        <div class="ms-3">
                                            <h6 class="text-primary mb-1">Jhon Doe</h6>
                                            <small>Teacher</small>
                                        </div>
                                    </div>
                                    <span class="bg-primary text-white rounded-pill py-2 px-3" href="">$99</span>
                                </div>
                                <div class="row g-1">
                                    <div class="col-4">
                                        <div class="border-top border-3 border-primary pt-2">
                                            <h6 class="text-primary mb-1">Age:</h6>
                                            <small>3-5 Years</small>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="border-top border-3 border-success pt-2">
                                            <h6 class="text-success mb-1">Time:</h6>
                                            <small>9-10 AM</small>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="border-top border-3 border-warning pt-2">
                                            <h6 class="text-warning mb-1">Capacity:</h6>
                                            <small>30 Kids</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="classes-item">
                            <div class="bg-light rounded-circle w-75 mx-auto p-3">
                                <img class="img-fluid rounded-circle" src="img/classes-6.jpg" alt="">
                            </div>
                            <div class="bg-light rounded p-4 pt-5 mt-n5">
                                <a class="d-block text-center h3 mt-3 mb-4" href="">General Knowledge</a>
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div class="d-flex align-items-center">
                                        <img class="rounded-circle flex-shrink-0" src="img/user.jpg" alt="" style="width: 45px; height: 45px;">
                                        <div class="ms-3">
                                            <h6 class="text-primary mb-1">Jhon Doe</h6>
                                            <small>Teacher</small>
                                        </div>
                                    </div>
                                    <span class="bg-primary text-white rounded-pill py-2 px-3" href="">$99</span>
                                </div>
                                <div class="row g-1">
                                    <div class="col-4">
                                        <div class="border-top border-3 border-primary pt-2">
                                            <h6 class="text-primary mb-1">Age:</h6>
                                            <small>3-5 Years</small>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="border-top border-3 border-success pt-2">
                                            <h6 class="text-success mb-1">Time:</h6>
                                            <small>9-10 AM</small>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="border-top border-3 border-warning pt-2">
                                            <h6 class="text-warning mb-1">Capacity:</h6>
                                            <small>30 Kids</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- Classes End -->


        <!-- Appointment Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="bg-light rounded">
                    <div class="row g-0">
                        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                            <div class="h-100 d-flex flex-column justify-content-center p-5">
                                <h1 class="mb-4">Make Appointment</h1>
                                
                                <form action="index.php" method="post" >
                                    <div class="row g-3">
                                        <div class="col-sm-6">
                                            <div class="form-floating">
                                                <input type="date" class="form-control border-0" name="odate" id="gname"
                                                    required>
                                                <label for="gname">Order Date</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control border-0" name="cname" id="gname"
                                                required >
                                                <label for="gmail">Customer Name</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-floating">

                                                <input type="text" class="form-control border-0" name="txtVNumer"
                                                    id="gname" required>
                                                <label for="CAR NUMBER">Car Number</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6"> 
                                            <div class="form-floating">

                                                <select name="ptype" id="ptype" class="form-control border-0"  id="gname"
                                               >
                                                    <?php   
                                                    $select="SELECT * FROM paymenttype";
                                                    $query=mysqli_query($connect,$select);
                                                    $count=mysqli_num_rows($query);
                                                    for ($i=0; $i < $count ; $i++) { 
                                                        $fetch=mysqli_fetch_array($query);
                                                        $PCode=$fetch['PaymentTypeCode'];
                                                        $PName=$fetch['PaymentType'];

                                                        echo "<option value='$PCode'>$PName</option>";
                                        
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6"> <label for="">Branch </label>
                                            <div class="form-floating">

                                                <select name="cbobid" id="cbobid" class="form-control border-0"  id="gname">
                                                    <?php   
                                                    $select="SELECT * FROM branches";
                                                    $query=mysqli_query($connect,$select);
                                                    $count=mysqli_num_rows($query);
                                                    for ($i=0; $i < $count ; $i++) { 
                                                        $fetch=mysqli_fetch_array($query);
                                                        $BCode=$fetch['Branchid'];
                                                        $BName=$fetch['BranchName'];
                                                        echo "<option value='$BCode'>$BName</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-6"> <label for="cage">Promotion </label>
                                            <div class="form-floating">

                                                <select name="cbopro" id="cbopro" class="form-control border-0" id="gname"
                                               >
                                                    <?php   
                                                    $select="SELECT * FROM promotion";
                                                    $query=mysqli_query($connect,$select);
                                                    $count=mysqli_num_rows($query);
                                                    for ($i=0; $i < $count ; $i++) { 
                                                        $fetch=mysqli_fetch_array($query);
                                                        $PCode=$fetch['PromotionCode'];
                                                        $PName=$fetch['PromotionName'];
                                                        echo "<option value='$PCode'>$PName</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-6"><label for="">Vechicle Type :</label>
                                            <div class="form-floating">

                                                <select name='cbovtype' class="form-control border-0"  id="gname"
                                               >
                                                    <option value="Car">Car</option>
                                                    <option value="Cycle">Cycle</option>
                                                    <option value="3 wheels">3 wheels</option>
                                                    <option value="Generator">Generator</option>
                                                    <option value="Hospital">Hospital</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6"><label for="">Fuel Type :</label>
                                            <div class="form-floating">

                                                <select name='cboftype'  class="form-control border-0" required>
                                                    <?php   
                    $select="SELECT * FROM petrol";
                    $query=mysqli_query($connect,$select);
                    while($fetch=mysqli_fetch_array($query)){
                            $PetCode=$fetch['PetrolCode'];
                            $PetName=$fetch['PetrolName'];
                            $priper=$fetch['Priceperlitres'];
                            echo "<option value='$PetCode'>$PetName , $priper</option>";
                    }
                ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6"><label for="">litres</label>
                                            <div class="form-floating">
                                                <input type="number" class="form-control border-0"
                                                 name="txtlitres" id="litres" required>
                                                    
                                            </div>
                                        </div>
                                        <div class="col-6"><label for="">Total Amount</label>
                                            <div class="form-floating">

                                               
                                                <input type='number' name='txtamount' id='txtamount' class='form-control border-0' value='<?php echo $litres ?>' required>



                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <input class="btn btn-primary w-100 py-3" name="btnsubmit" type="submit"
                                                value="submit">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s" style="min-height: 400px;">
                            <div class="position-relative h-100">
                                <img class="position-absolute w-100 h-100 rounded" src="img/img1.jpg"
                                    style="object-fit: cover;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Appointment End -->


        <!-- Team Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h1 class="mb-3">Stakeholders</h1>
                    <p>Our stakeholders, which comprise a wide range of people and organizations,
                        are essential to our success. All of our stakeholders, from our devoted staff and devoted
                        clients to our reliable suppliers and community partners, are essential to our business
                        operations and expansion. Building trusting connections and making sure that everyone
                        benefits from our creative ideas and sustainable practices are our top priorities.</p>
                </div>
                <div class="row g-4">
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="team-item position-relative">
                            <img class="img-fluid rounded-circle w-75" src="img/team-1.jpg" alt="">
                            <div class="team-text">
                                <h3>Mrs. Credina Sown</h3>
                                <p>Main Holder</p>
                                <div class="d-flex align-items-center">
                                    <a class="btn btn-square btn-primary mx-1" href=""><i
                                            class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-square btn-primary  mx-1" href=""><i
                                            class="fab fa-twitter"></i></a>
                                    <a class="btn btn-square btn-primary  mx-1" href=""><i
                                            class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="team-item position-relative">
                            <img class="img-fluid rounded-circle w-75" src="img/team-2.jpg" alt="">
                            <div class="team-text">
                                <h3>Mr.Shein Nanda</h3>
                                <p>Main Holder</p>
                                <div class="d-flex align-items-center">
                                    <a class="btn btn-square btn-primary mx-1" href=""><i
                                            class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-square btn-primary  mx-1" href=""><i
                                            class="fab fa-twitter"></i></a>
                                    <a class="btn btn-square btn-primary  mx-1" href=""><i
                                            class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="team-item position-relative">
                            <img class="img-fluid rounded-circle w-75" src="img/team-3.jpg" alt="">
                            <div class="team-text">
                                <h3>Mr. Shiv Kumar</h3>
                                <p>Main Holder</p>
                                <div class="d-flex align-items-center">
                                    <a class="btn btn-square btn-primary mx-1" href=""><i
                                            class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-square btn-primary  mx-1" href=""><i
                                            class="fab fa-twitter"></i></a>
                                    <a class="btn btn-square btn-primary  mx-1" href=""><i
                                            class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Team End -->


        <!-- Testimonial Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h1 class="mb-3">Our Clients Say!</h1>
                    <p>e take pride in the positive feedback we receive from our clients. Their testimonials highlight
                        our commitment to quality, reliability, and customer satisfaction. Here are some of their kind
                        words</p>
                </div>
                <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
                    <div class="testimonial-item bg-light rounded p-5">
                        <p class="fs-5">I’ve been using their premium fuel for months now, and the difference it has
                            made in my vehicle's efficiency is remarkable. Great job, team!</p>
                        <div class="d-flex align-items-center bg-white me-n5" style="border-radius: 50px 0 0 50px;">
                            <img class="img-fluid flex-shrink-0 rounded-circle" src="img/testimonial-1.jpg"
                                style="width: 90px; height: 90px;">
                            <div class="ps-3">
                                <h3 class="mb-1">Soe Win</h3>
                                <span>Customer</span>
                            </div>
                            <i class="fa fa-quote-right fa-3x text-primary ms-auto d-none d-sm-flex"></i>
                        </div>
                    </div>
                    <div class="testimonial-item bg-light rounded p-5">
                        <p class="fs-5">The service and quality of the fuel here are exceptional. My car's performance
                            has noticeably improved, and I couldn't be happier. Highly recommend</p>
                        <div class="d-flex align-items-center bg-white me-n5" style="border-radius: 50px 0 0 50px;">
                            <img class="img-fluid flex-shrink-0 rounded-circle" src="img/testimonial-2.jpg"
                                style="width: 90px; height: 90px;">
                            <div class="ps-3">
                                <h3 class="mb-1">John Doe</h3>
                                <span>Customer</span>
                            </div>
                            <i class="fa fa-quote-right fa-3x text-primary ms-auto d-none d-sm-flex"></i>
                        </div>
                    </div>
                    <div class="testimonial-item bg-light rounded p-5">
                        <p class="fs-5">I’ve been using their premium fuel for months now, and the difference it has
                            made in my vehicle's efficiency is remarkable. Great job, team!</p>
                        <div class="d-flex align-items-center bg-white me-n5" style="border-radius: 50px 0 0 50px;">
                            <img class="img-fluid flex-shrink-0 rounded-circle" src="img/testimonial-3.jpg"
                                style="width: 90px; height: 90px;">
                            <div class="ps-3">
                                <h3 class="mb-1">Win Win</h3>
                                <span>Customer</span>
                            </div>
                            <i class="fa fa-quote-right fa-3x text-primary ms-auto d-none d-sm-flex"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Testimonial End -->


        <!-- Footer Start -->
        <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-3 col-md-6">
                        <h3 class="text-white mb-4">Get In Touch</h3>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>23 street , Yankin , Yangon</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i>denko@example.com</p>
                        <div class="d-flex pt-2">
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h3 class="text-white mb-4">Quick Links</h3>
                        <a class="btn btn-link text-white-50 " href="index.php">Home</a>
                        <a class="btn btn-link text-white-50" href="about.php">About Us</a>
                        <a class="btn btn-link text-white-50" href="contact.php">Contact Us</a>
                        <a class="btn btn-link text-white-50" href="booking.php">Book</a>
                        <a class="btn btn-link text-white-50" href="">Privacy Policy</a>
                        <a class="btn btn-link text-white-50" href="">Terms & Condition</a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                    <div id="google_translate_element"></div> 
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h3 class="text-white mb-4">Newsletter</h3>
                        <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                        <div class="position-relative mx-auto" style="max-width: 400px;">
                            <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="text"
                                placeholder="Your email">
                            <button type="button"
                                class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--  -->
        </div>
        <!-- Footer End -->
        <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElement">


</script>
        <script>
    // Google Translate
    function googleTranslateElement() {
        new google.translate.TranslateElement({
            pageLanguage: 'en'
        }, 'google_translate_element');

    }
    </script>

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>