<?php
include('dbconnect.php');
session_start();
$SName=$_SESSION['SName'];
$SID=$_SESSION['SID'];
if(isset($_POST['btnaddpromo'])){
    $promotioncode = 'P_' . str_pad(mysqli_fetch_assoc(mysqli_query($connect, "SELECT MAX(CAST(RIGHT(PromotionCode, 3) AS UNSIGNED)) AS LastID FROM promotion"))['LastID'] + 1, 3, '0', STR_PAD_LEFT);
    $pname=$_POST['pname'];
    $pdis=$_POST['pdis'];
$sdate=$_POST['sdate'];
$edate=$_POST['edate'];
    $promotioninsert="INSERT INTO promotion (PromotionCode,PromotionName,DiscountPercent,PStartDate,PEndDate) VALUES ('$promotioncode','$pname','$pdis','$sdate','$edate')";

    $promotionresult=mysqli_query($connect,$promotioninsert);
   

    if($promotionresult){
        echo "<script>alert('Promotion added successfully')</script>";
        echo "<script>window.location='PPC.php'</script>";
    }
    else{
        echo "Error!!";
    }
}
if(isset($_POST['btnaddpayment'])){
    $promotioncode = 'PT_' . str_pad(mysqli_fetch_assoc(mysqli_query($connect, "SELECT MAX(CAST(RIGHT(PaymentTypeCode, 3) AS UNSIGNED)) AS LastID FROM paymenttype"))['LastID'] + 1, 3, '0', STR_PAD_LEFT);
    $patype=$_POST['patype'];
    $ptax=$_POST['ptax'];


    $paymentinsert="INSERT INTO paymenttype (PaymentTypeCode,PaymentType,TaxPercentage) VALUES ('$promotioncode','$patype','$ptax')";

  
    $paymentresult=mysqli_query($connect,$paymentinsert);

    if( $paymentresult){
        echo "<script>alert('Payment type added successfully')</script>";
        echo "<script>window.location='PPC.php'</script>";
    }
    else{
        echo "Error!!";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control Pro and Payment</title>
    <link rel="stylesheet" href="css/UCus.css">
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
          
            <div class="user">
                <img src="photo/logo.png" alt="">
            </div>
        </div>

<div class="container-form">
    <form action="PPC.php" method="POST">
        <h1>Promotion Form</h1>
        <div class="form-group">
            <label for="pname">Promotion Name :</label><br>
            <input type="text" name="pname" placeholder="Enter Promotion Name" required />
        </div>
        <div class="form-group">
            <label for="pdis">Discount Percent :</label><br>
            <input type="text" name="pdis" placeholder="Enter Discount Percent" required />
        </div>
        <div class="form-group">
            <label for="pdis">Start Date :</label><br>
            <input type="date" name="sdate" placeholder="Enter Discount Percent" required />
        </div>
        <div class="form-group">
            <label for="pdis">End Date :</label><br>
            <input type="date" name="edate" placeholder="Enter Discount Percent" required />
        </div>
        <input type="submit" name="btnaddpromo" value="Submit">
    </form>
    
    
</div><br><br>
<div class="container-form">
    <form action="PPC.php" method="POST">
        <h1>Payment Type Form</h1>
        <div class="form-group">
            <label for="ptype">Payment Type :</label><br>
            <input type="text" name="patype" placeholder="Enter Payment Type" required />
        </div>
        <div class="form-group">
            <label for="ptype">Tax percentage % :</label><br>
            <input type="text" name="ptax" placeholder="Enter Payment Type" required />
        </div>
        <input type="submit" name="btnaddpayment" value="Submit">
    </form>
    
    
</div><br><br>
    <h2>Promotion list</h2><br><br>
<table border="1" >
        <tr>
            <th>Promotion Code</th>
            <th>Promotion Name</th>
            <th>Discount Percent</th>
            <th>Update</th>
        </tr>
        <?php
        $select="SELECT * FROM promotion";
        $query=mysqli_query($connect,$select);
        $count=mysqli_num_rows($query);
        for ($i=0; $i < $count ; $i++) { 
                $fetch=mysqli_fetch_array($query);
                $ProCode=$fetch['PromotionCode'];
                $ProName=$fetch['PromotionName'];
                $Disper=$fetch['Discountpercent'];

                echo "<tr>";
                echo "<td>$ProCode</td>";
                echo "<td>$ProName</td>";
                echo "<td>$Disper</td>";
                echo "<td><a href='PPCUpdate.php?ProCode=$ProCode'>Update</a></td>";
                echo "</tr>";
            
        }
        ?>
        
    </table><br><br>
    <h2>Payment type list</h2><br><br>
    <table border="1" >
        <tr>
            <th>PaymentTypeCode</th>
            <th>PaymentTypeName</th>
            <th>TaxPercent</th>
            <th>Update</th>
        </tr>
        <?php
        $select="SELECT * FROM paymenttype";
        $query=mysqli_query($connect,$select);
        $count=mysqli_num_rows($query);
        for ($i=0; $i < $count ; $i++) { 
                $fetch=mysqli_fetch_array($query);
                $PTCode=$fetch['PaymentTypeCode'];
                $PTName=$fetch['PaymentType'];
                $Taxper=$fetch['Taxpercentage'];

                echo "<tr>";
                echo "<td>$PTCode</td>";
                echo "<td>$PTName</td>";
                echo "<td>$Taxper</td>";
                echo "<td><a href='PPCPaymentUpdate.php?PTCode=$PTCode'>Update</a></td>";
                echo "</tr>";
            
        }
        ?>
        
    </table>
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