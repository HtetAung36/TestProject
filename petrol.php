<?php
session_start();
include('dbconnect.php');

if(!isset($_SESSION['SID'])){
    echo "<script>window.alert('login fail')</script>" ;
    echo "<script>window.location='login.php'</script>" ;
}

$SName=$_SESSION['SName'];
$SID=$_SESSION['SID'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petrol</title>
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

        <fieldset>
            <legend>Price Listing </legend>
            <table>
                <tr>
                    <th>Petrol Code</th>
                    <th>Petrol Name</th>
                    <th>Petrol Price</th>
                    <th>Action</th>



                </tr>


                <?php
        $petrolselect="Select * from petrol";
        $result=mysqli_query($connect,$petrolselect);

        $count=mysqli_num_rows($result);
        for ($i=0; $i<$count ; $i++)
                {
                    $array=mysqli_fetch_array($result);
                       $PCode= $array['PetrolCode'];
                       $PName= $array['PetrolName'];
                       $PLitres=$array['Priceperlitres'];

                       echo "<tr>";


                        echo "<td>$PCode</td>";
                        echo "<td>$PName</td>";
                        echo "<td>$PLitres</td>";

                            echo " <td>
                            <a href='UpdatePetrol.php?PCode=$PCode'>Update</a>
                            
                            </td>";


                       echo "</tr>";

                }
?>

            </table>


        </fieldset>
         <h2>Fuel Type and Litres List</h2> <fieldset>
            <table>
               
                <tr>
                    <th>Fuel Type</th>
                    <th>Total Litres</th>
                </tr>
                <?php
                $sql = "SELECT p.PetrolName, SUM(pd.PurchaseLiters) AS TotalLitres
                FROM petrol p
                JOIN purchasedetails pd ON p.PetrolCode = pd.PetrolCode
                GROUP BY p.PetrolCode";

                $result = mysqli_query($connect, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>".$row['PetrolName']."</td>";
                    echo "<td>".$row['TotalLitres']."</td>";
                    echo "</tr>";
                }
                ?>
       
            </table>
 </fieldset>
             <h2>Available Litres</h2> <fieldset>
            <table>
               
                <tr>
                    <th>Fuel Type</th>
                    <th>Available Litres</th>
                </tr>
                <?php
                $sql = "SELECT p.PetrolName, SUM(pd.PurchaseLiters - (IFNULL((SELECT SUM(od.OrderLitres) FROM orderdetails od WHERE od.PetrolCode = p.PetrolCode),0) + IFNULL((SELECT SUM(sd.SaleLitres) FROM saledetailstb sd WHERE sd.PetrolCode = p.PetrolCode),0))) AS AvailableLitres
                FROM petrol p
                LEFT JOIN purchasedetails pd ON p.PetrolCode = pd.PetrolCode
                GROUP BY p.PetrolCode";

                $result = mysqli_query($connect, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>".$row['PetrolName']."</td>";
                    echo "<td>".$row['AvailableLitres']."</td>";
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

