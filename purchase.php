<?php
include('dbconnect.php');
session_start(); 
if(!isset($_SESSION['SID'])){
    echo "<script>window.alert('login fail')</script>" ;
    echo "<script>window.location='login.php'</script>" ;
}

$SName=$_SESSION['SName'];
$SID=$_SESSION['SID'];
if (isset($_POST['btnsubmit'])) {
 $date = date('Y-m-d');
$PurchaseID = 'P_' . str_pad(mysqli_fetch_assoc(mysqli_query($connect, "SELECT MAX(CAST(RIGHT(PurchaseCode, 3) AS UNSIGNED)) AS LastID FROM purchases"))['LastID'] + 1, 3, '0', STR_PAD_LEFT);
 $cbossname = $_POST['cbossname'];
 
  $pinsert="INSERT INTO purchases(PurchaseCode, PurchaseDate, SupplierID) VALUES ('$PurchaseID', '$date',' $cbossname' )";
  mysqli_query($connect, $pinsert);
  if (mysqli_affected_rows($connect) > 0) {
    $_SESSION['PurchaseID'] = $PurchaseID;
    echo "<script>alert('Data inserted successfully')</script>";
    echo "<script>window.location='purchase.php'</script>";
}
}
if (isset($_POST['btnadd'])) {
    $PurchaseDID = 'PD_' . str_pad(mysqli_fetch_assoc(mysqli_query($connect, "SELECT MAX(CAST(RIGHT(PurchaseDetailCode, 3) AS UNSIGNED)) AS LastID FROM purchasedetails"))['LastID'] + 1, 3, '0', STR_PAD_LEFT);
    $PurchaseID = $_SESSION['PurchaseID'];
    $txtlitres = $_POST['txtlitres'];
    $cboftype = $_POST['cboftype'];
    $txtpamount = $_POST['txtpamount'];
   
    $cbosname = $_POST['cbosname'];
   
   
    $pdinsert = "INSERT INTO purchasedetails(PurchaseDetailCode,PurchaseCode,PurchaseLiters,PetrolCode,StaffID,PurchaseAmount)
                    VALUES ('$PurchaseDID','$PurchaseID', '$txtlitres', '$cboftype', '$cbosname','$txtpamount')"; 
    mysqli_query($connect, $pdinsert);
    if (mysqli_affected_rows($connect) > 0) {
        echo "<script>alert('Data inserted successfully')</script>";
        echo "<script>window.location='purchase.php'</script>";
    }
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
        <form action="purchase.php" method="POST">
            <h1>Daily Purchase Entry</h1>
            <div class="form-group">
            
            <label for="">Supplier Name : </label>
                <select name="cbossname" id="">
                    <?php   
                    $select="SELECT * FROM suppliertb";
                    $query=mysqli_query($connect,$select);
                    $count=mysqli_num_rows($query);
                    for ($i=0; $i < $count ; $i++) { 
                            $fetch=mysqli_fetch_array($query);
                            $SCode=$fetch['SupplierID'];
                            $SName=$fetch['SupplierName'];
                            
                                echo "<option value='$SCode'>$SName</option>";
                            
                            
                    }
                ?>
                </select><br><br>
                <input type="submit" name="btnsubmit" value="Submit">
                </form>
                <form action="purchase.php" method="post">

              <label for="">Purchase Litres :</label>
                <input type="number" name="txtlitres" id="" required><br><br>
                <label for="">Fuel Type :</label><br>
                <select name='cboftype'  class='cbosale'>
                <?php   
                    $select="SELECT * FROM petrol";
                    $query=mysqli_query($connect,$select);
                    while($fetch=mysqli_fetch_array($query)){
                            $PetCode=$fetch['PetrolCode'];
                            $PetName=$fetch['PetrolName'];
                            $priper=$fetch['Priceperlitres'];
                            echo "<option value='$PetCode'>$PetName</option>";
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
               
               <label for="">Purchase Amount</label>
                <input type="number" name="txtpamount" id="" placeholder="Enter Purchase Amount" required /><br>
                
            </div>


            <input type="submit" name="btnadd" value="Submit">
               

        </form>

    </div>
                </div>
            </div>
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