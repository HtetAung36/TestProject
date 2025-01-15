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
    <title>Booking </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@600&family=Lobster+Two:wght@700&display=swap" rel="stylesheet">
    
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
        <!-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
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
                    <a href="index.php" class="nav-item nav-link ">Home</a>
                    <a href="about.php" class="nav-item nav-link">About Us</a>
                    <a href="booking.php" class="nav-item nav-link active">Booking</a>
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



        <!-- Page Header End -->
        <div class="container-xxl py-5 page-header position-relative mb-5">
            <div class="container py-5">
                <h1 class="display-2 text-white animated slideInDown mb-4">Booking</h1>
                <nav aria-label="breadcrumb animated slideInDown">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        
                        <li class="breadcrumb-item text-white active" aria-current="page">Booking Page</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Page Header End -->


       
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
                                                    placeholder="Gurdian Name">
                                                <label for="gname">Order Date</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control border-0" name="cname" id="gname"
                                                    placeholder="Gurdian Email">
                                                <label for="gmail">Customer Name</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-floating">

                                                <input type="text" class="form-control border-0" name="txtVNumer"
                                                    id="gname" placeholder="Gurdian Email">
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

                                               
                                                <input type='number' name='txtamount' id='txtamount' class='form-control border-0' value='<?php echo $litres ?>'>



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
        <!-- Branch Lists Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <h1 class="mb-3 text-center">Our Branch List</h1>
                <table class="table table-striped table-responsive">
                    <thead>
                        <tr>
                            <th scope="col">Branch Name</th>
                            <th scope="col">Branch Location</th>
                            <th scope="col">92 ROMS</th>
                            <th scope="col">95 ROMS</th>
                            <th scope="col">97 ROMS</th>
                            <th scope="col">HSD</th>
                            <th scope="col">PHSD</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM branches";
                        $result = $connect->query($sql);

                        if ($result->num_rows > 0) {
                            // output data of each row
                            while ($row = $result->fetch_assoc()) {
                                $sql = "SELECT Priceperlitres FROM petrol WHERE PetrolCode = 'P_002'";
                                $petrol95Result = $connect->query($sql);
                                $petrol95Row = $petrol95Result->fetch_assoc();
                                $petrol95Price = $petrol95Row['Priceperlitres'];

                                $sql1 = "SELECT Priceperlitres FROM petrol WHERE PetrolCode = 'P_001'";
                                $petrol92Result = $connect->query($sql1);
                                $petrol92Row = $petrol92Result->fetch_assoc();
                                $petrol92Price = $petrol92Row['Priceperlitres'];

                                $sql2 = "SELECT Priceperlitres FROM petrol WHERE PetrolCode = 'P_005'";
                                $petrol97Result = $connect->query($sql2);
                                $petrol97Row = $petrol97Result->fetch_assoc();
                                $petrol97Price = $petrol97Row['Priceperlitres'];

                                $sql3 = "SELECT Priceperlitres FROM petrol WHERE PetrolCode = 'P_003'";
                                $petrolhsdResult = $connect->query($sql3);
                                $petrolhsdRow = $petrolhsdResult->fetch_assoc();
                                $petrolhsdPrice = $petrolhsdRow['Priceperlitres'];

                                $sql4 = "SELECT Priceperlitres FROM petrol WHERE PetrolCode = 'P_004'";
                                $petrolphsdResult = $connect->query($sql4);
                                $petrolphsdRow = $petrolphsdResult->fetch_assoc();
                                $petrolphsdPrice = $petrolphsdRow['Priceperlitres'];
                                echo "<tr>
                                    <td>" . $row["BranchName"]. "</td>
                                    <td>" . $row["BranchLocation"]. "</td>
                                    <td>MMK" . $petrol92Price . ".00</td>
                                    <td>MMK." . $petrol95Price . ".00</td>
                                    <td>MMK." . $petrol97Price . ".00</td>
                                    <td>MMK." . $petrolhsdPrice .".00</td>
                                    <td>MMK." . $petrolphsdPrice  . ".00</td>
                                  </tr>";
                            }
                        } else {
                            echo "<tr>
                                <td colspan='5'>No data</td>
                              </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Branch Lists End -->

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