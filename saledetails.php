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
    $SaleID = isset($_SESSION['SaleID']) ? $_SESSION['SaleID'] : $_GET['SaleID'];
$_SESSION['SaleID'] = $SaleID;
    $cboftype = $_POST['cboftype'];
    $txtlitres = $_POST['txtlitres'];

  echo  $saleinsert = "INSERT INTO saledetailstb(SaleID,PetrolCode,SaleLitres) VALUES ('$SaleID', '$cboftype', '$txtlitres')";
    $insertquery = mysqli_query($connect, $saleinsert);
    if ($insertquery) {
        echo "<script>alert('Data inserted successfully')</script>";
        echo "<script>window.location='saledetails.php'</script>";
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
            <form action="saledetails.php" method="POST">
                <h1>Daily Sale Entry</h1>
                <div class="form-group">

                    <label for="">Fuel Type :</label><br>
                    <select name='cboftype' class='cbosale'>
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
                    </select><br><br>
                    <label for="">litres</label>
                    <input type="number" name="txtlitres" id="" required><br>
                    <?php
                if(isset($_POST['cboftype']) && isset($_POST['txtlitres']) && is_numeric($_POST['txtlitres'])){
                    $priper = mysqli_query($connect, "SELECT Priceperlitres FROM petrol WHERE PetrolCode='$_POST[cboftype]'")->fetch_assoc()['Priceperlitres'];
                    $total = $_POST['txtlitres'] * $priper;
                    echo "<input type='number' name='txtamount' id='' value='$total' readonly>";
                }else{
                    echo "<input type='number' name='txtamount' id='' value='0' readonly>";
                }
                ?>

                </div>

                <!-- <div class="form-group">
                <input type="hidden" name="UCTID" value="<?php echo $UCTID; ?>">
            </div> -->
                <button type="submit" name="btnadd">Save</button>

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