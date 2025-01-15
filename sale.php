<?php
include('dbconnect.php');
session_start();

if(!isset($_SESSION['SID'])){
    echo "<script>window.alert('login fail')</script>" ;
    echo "<script>window.location='login.php'</script>" ;
}

$SName=$_SESSION['SName'];
$SID=$_SESSION['SID'];
if (isset($_POST['btnadd'])) {
    $SaleID = 'SL_' . str_pad(mysqli_fetch_assoc(mysqli_query($connect, "SELECT MAX(CAST(RIGHT(SaleID, 3) AS UNSIGNED)) AS LastID FROM sale"))['LastID'] + 1, 3, '0', STR_PAD_LEFT);
    $date = date('Y-m-d');
    $SaVNum = $_POST['txtVNumer'];
    $cbopt = $_POST['cbopt'];
    $cbovtype = $_POST['cbovtype'];
    $cbopro = $_POST['cbopro'];
    $cbosname = $_POST['cbosname'];
    $cbocid = $_POST['cbocname'];

    $saleinsert = "INSERT INTO sale(SaleID, SaleDate, CarNumber, CarType, PromotionCode, PaymentTypeCode, StaffID, CustomerID) 
                    VALUES ('$SaleID', '$date', '$SaVNum', '$cbovtype', '$cbopro', '$cbopt', '$cbosname', '$cbocid')";
    mysqli_query($connect, $saleinsert);

    echo "<script>alert('Data inserted successfully')</script>";
    echo "<script>window.location='saledetails.php?SaleID=".$SaleID."'</script>";

    $_SESSION['SaleID'] = $SaleID;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sale</title>
    <link rel="stylesheet" href="Astyle.css">
</head>

<body>
    <div class="navigation">
    <ul>
                <li>
                    <div class="head">

                        <div class="user-details">

                            <p class="title">Welcome</p>
                            <p class="name"><?php echo  $SName ?></p>

                        </div>

                    </div>
                </li>
                <li> <a href="petrol.php">
                        <span class="icon">
                            <ion-icon name="golf-outline"></ion-icon>
                        </span>
                        <span class="title">Price SetUp</span>
                    </a>
                </li>
                <li>
                    <a href="sale.php">
                        <span class="icon">
                            <ion-icon name="megaphone-outline"></ion-icon>
                        </span>
                        <span class="title">Daily Sale Entry</span>
                    </a>
                </li>
                <li>
                    <a href="SupplierReg.php">
                        <span class="icon">
                            <ion-icon name="logo-apple-ar"></ion-icon>
                        </span>
                        <span class="title">Register Suppliers</span>
                    </a>
                </li>
                <li>
                    <a href="staffreg.php">
                        <span class="icon">
                            <ion-icon name="planet-outline"></ion-icon>
                        </span>
                        <span class="title">Register Staff</span>
                    </a>
                </li>
                <li>
                    <a href="vdailysale.php">
                        <span class="icon">
                            <ion-icon name="filter-outline"></ion-icon>
                        </span>
                        <span class="title">Listing</span>
                    </a>
                </li>
                <li>
                    <a href="purchase.php">
                        <span class="icon">
                            <ion-icon name="people-circle-outline"></ion-icon>
                        </span>
                        <span class="title">Purchase Petrol</span>
                    </a>
                </li>
                <li>
                    <a href="index.php">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Log Out</span>



                    </a>
                </li>
            </ul>
    </div>
    <div class="main">
        <div class="topbar">
            <div class="toggle">
                <ion-icon name="grid-outline"></ion-icon>
            </div>
            <!-- search -->
            <div class="search">
                <label for="">
                    <input type="text" placeholder="Serch here">
                    <ion-icon name="search-outline"></ion-icon>
                </label>
            </div>
            <!-- user img -->
            <div class="user">
                <img src="photo/logo.png" alt="">
            </div>
        </div>


   
    <div class="container-form">
        <form action="sale.php" method="POST">
            <h1>Daily Sale Entry</h1>
            <div class="form-group">
            
                <label for="">Vechicle Number :</label><br>

                <input type="text" name="txtVNumer" placeholder="Enter Vechicle Number" required /><br>
                <label for="">Vechicle Type :</label>
                <select name='cbovtype'  class='cbosale'>
                    <option value="Car">Car</option>
                    <option value="Cycle">Cycle</option>
                    <option value="3 wheels">3 wheels</option>
                    <option value="Generator">Generator</option>
                    <option value="Hospital">Hospital</option>
                </select><br><br>
                <label for="">Promotion  : </label>
                <select name="cbopro" id="">
                    <?php   
                    $select="SELECT * FROM promotion";
                    $query=mysqli_query($connect,$select);
                    $count=mysqli_num_rows($query);
                    for ($i=0; $i < $count ; $i++) { 
                            $fetch=mysqli_fetch_array($query);
                            $ProCode=$fetch['PromotionCode'];
                            $ProName=$fetch['PromotionName'];
                            $Disper=$fetch['Discountpercent'];

                            echo "<option value='$ProCode'>$ProName</option>";
                            
                    }
                ?>
                </select><br><br>
                <label for="">Payment Type : </label>
                <select name="cbopt" id="">
                    <?php   
                    $select="SELECT * FROM paymenttype";
                    $query=mysqli_query($connect,$select);
                    $count=mysqli_num_rows($query);
                    for ($i=0; $i < $count ; $i++) { 
                            $fetch=mysqli_fetch_array($query);
                            $PCode=$fetch['PaymentTypeCode'];
                            $PName=$fetch['PaymentType'];
                            $Ptage=$fetch['Taxpercentage'];

                            echo "<option value='$PCode'>$PName</option>";
                            
                    }
                ?>
                </select><br><br>
                <label for="">Cashier Name : </label>
                <select name="cbosname" id="">
                    <?php   
                    $select="SELECT * FROM stafftb";
                    $query=mysqli_query($connect,$select);
                    $count=mysqli_num_rows($query);
                    for ($i=0; $i < $count ; $i++) { 
                            $fetch=mysqli_fetch_array($query);
                            $SCode=$fetch['StaffID'];
                            $SName=$fetch['StaffName'];
                            if($fetch['StaffPosition'] == 'Cashier'){
                                echo "<option value='$SCode'>$SName</option>";
                            }
                            
                    }
                ?>
                </select><br><br>
                <label for="">Customer Name : </label>
                <select name="cbocname" id="">
                    <?php   
                    $select="SELECT * FROM customer";
                    $query=mysqli_query($connect,$select);
                    $count=mysqli_num_rows($query);
                    for ($i=0; $i < $count ; $i++) { 
                            $fetch=mysqli_fetch_array($query);
                            $CCode=$fetch['CustomerID'];
                            $CName=$fetch['CustomerName'];
                            if($fetch['CustomerName'] == 'Guest'){
                                echo "<option value='$CCode'>$CName</option>";
                            }
                            
                    }
                ?>
                </select><br><br>
                
            </div>


            <input type="submit" name="btnadd" value="Submit">
               

        </form>

    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script>
    // Menutoggle
    let toggle = document.querySelector('.toggle')
    let navigation = document.querySelector('.navigation')
    let main = document.querySelector('.main')
    toggle.onclick = function() {
        navigation.classList.toggle('active')
        main.classList.toggle('active')
    }
    // add hovered class 
    let list = document.querySelectorAll('.navigation li');

    function activeLink() {
        list.forEach((item) =>
            item.classList.remove('hovered'));
        this.classList.add('hovered');
    }
    list.forEach((item) =>
        item.addEventListener('mouseover', activeLink));
    </script>
</body>

</html>