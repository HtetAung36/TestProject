<?php
include('dbconnect.php');
session_start();
if(!isset($_SESSION['SID'])){
    echo "<script>window.alert('login fail')</script>" ;
    echo "<script>window.location='login.php'</script>" ;
}

$SName=$_SESSION['SName'];
$SID=$_SESSION['SID'];

if(isset($_POST['submit']))
{
    $fromdate = $_POST['fromdate'];
    $todate = $_POST['todate'];

    $query = "SELECT * FROM sale WHERE SaleDate BETWEEN '$fromdate' AND '$todate'";
    $result = mysqli_query($connect, $query);

   
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Daily Sales</title>
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
        <a href="#purchase">Petrol Purchase Details list</a> <br>
        <a href="#staff">Staff Lists</a><br>
        <a href="#supplier">Supplier Lists</a><br>
        <a href="MCustomer.php">Customer and Order Lists</a><br>
        <a href="PPC.php">Promotion & Payment type Control</a>
        
        <form action="vdailysale.php" method="post">
            From Date: <input type="date" name="fromdate" required>
            To Date: <input type="date" name="todate" required>
            <input type="submit" name="submit" value="Search">
            <?php
            if(isset($result)){
                echo "<table border='1' width='100%'>";
            echo "<tr><th>Date</th><th>Car Number</th><th>Staff Name</th><th>Car Type</th></tr>";
        
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>".$row['SaleDate']."</td>";
                echo "<td>".$row['CarNumber']."</td>";
                $staff_id = $row['StaffID'];
                $staff_name_query = "SELECT StaffName FROM stafftb WHERE StaffID = '$staff_id'";
                $staff_name_result = mysqli_query($connect, $staff_name_query);
                $staff_name_row = mysqli_fetch_assoc($staff_name_result);
                $staff_name = $staff_name_row['StaffName'];
                echo "<td>".$staff_name."</td>";
                echo "<td>".$row['CarType']."</td>";
                echo "</tr>";
            }
        
            echo "</table>";
            }
            ?>

        </form>
        </form>
        <form action="vdailysale.php" method="post">
            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>View Daily Sales</h2>
                        <button type="submit" name="btnsearch">View All</button>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Car Number</th>
                                <th>Car Type</th>
                                <th>Sale Date</th>
                                <th>Litres</th>
                                <th>Gallons</th>
                                <th>Staff Name</th>
                                <th>Customer Name</th>
                                <th>Promotion </th>
                                <th>Payment Type</th>
                                <th>Fuel Type</th>
                                <th>Price </th>
                                <th>Amount</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        $total_litres = 0;
                        $total_gallons = 0;
                        $total_amount = 0;
                        if(isset($_POST['btnsearch'])){
                            $query="SELECT * FROM sale";
                            $result = mysqli_query($connect, $query);
                            if(mysqli_num_rows($result) > 0){
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $row['CarNumber'] . "</td>";
                                    echo "<td>" . $row['CarType'] . "</td>";
                                    echo "<td>" . $row['SaleDate'] . "</td>";
                                    $sale_id = $row['SaleID'];
                                    $sale_details_query = "SELECT SaleLitres FROM saledetailstb WHERE SaleID = '$sale_id'";
                                    $sale_details_result = mysqli_query($connect, $sale_details_query);
                                    $sale_details_row = mysqli_fetch_assoc($sale_details_result);
                                    $price_per_litre = $sale_details_row['SaleLitres'];
                                    echo "<td>" . $price_per_litre . "</td>";
                                    $total_litres += $price_per_litre;
                                    echo "<td>" . $price_per_litre / 4 . " gal</td>";
                                    $total_gallons += $price_per_litre / 4;
                                    $staff_id = $row['StaffID'];
                                    $staff_name_query = "SELECT StaffName FROM stafftb WHERE StaffID = '$staff_id'";
                                    $staff_name_result = mysqli_query($connect, $staff_name_query);
                                    $staff_name_row = mysqli_fetch_assoc($staff_name_result);
                                    $staff_name = $staff_name_row['StaffName'];
                                    echo "<td>" . $staff_name . "</td>";
                                    $customer_id = $row['CustomerID'];
                                    $customer_name_query = "SELECT CustomerName FROM customer WHERE CustomerID = '$customer_id'";
                                    $customer_name_result = mysqli_query($connect, $customer_name_query);
                                    $customer_name_row = mysqli_fetch_assoc($customer_name_result);
                                    $customer_name = $customer_name_row['CustomerName'];
                                    echo "<td>" . $customer_name . "</td>";
                                    $promotion_id = $row['PromotionCode'];
                                    $promotion_name_query = "SELECT PromotionName FROM promotion WHERE PromotionCode = '$promotion_id'";
                                    $promotion_name_result = mysqli_query($connect, $promotion_name_query);
                                    $promotion_name_row = mysqli_fetch_assoc($promotion_name_result);
                                    $promotion_name = $promotion_name_row['PromotionName'];
                                    echo "<td>" . $promotion_name . "</td>";
                                    $payment_id = $row['PaymentTypeCode'];
                                    $payment_name_query = "SELECT PaymentType FROM paymenttype WHERE PaymentTypeCode = '$payment_id'";
                                    $payment_name_result = mysqli_query($connect, $payment_name_query);
                                    $payment_name_row = mysqli_fetch_assoc($payment_name_result);
                                    $payment_name = $payment_name_row['PaymentType'];
                                    echo "<td>" . $payment_name . "</td>";
                                    $fuel_id = $row['SaleID'];
                                    $fuel_name_query = "SELECT PetrolName FROM petrol INNER JOIN saledetailstb ON petrol.PetrolCode=saledetailstb.PetrolCode WHERE saledetailstb.SaleID = '$fuel_id'";
                                    $fuel_name_result = mysqli_query($connect, $fuel_name_query);
                                    $fuel_name_row = mysqli_fetch_assoc($fuel_name_result);
                                    $fuel_name = $fuel_name_row['PetrolName'];
                                    echo "<td>" . $fuel_name . "</td>";
                                    $fuel_id = $row['SaleID'];
                                    $fuel_name_query = "SELECT Priceperlitres FROM petrol INNER JOIN saledetailstb ON petrol.PetrolCode=saledetailstb.PetrolCode WHERE saledetailstb.SaleID = '$fuel_id'";
                                    $fuel_name_result = mysqli_query($connect, $fuel_name_query);
                                    $fuel_name_row = mysqli_fetch_assoc($fuel_name_result);
                                    $fuel_price= $fuel_name_row['Priceperlitres'];
                                    echo "<td>" . $fuel_price . "</td>";
                                    $amount = $fuel_price * $sale_details_row['SaleLitres'];
                                    echo "<td>" . $amount . "</td>";
                                    $total_amount += $amount;
                                    
                                    echo "</tr>";
                                    

                                }
                            }
                        }
                        ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3">Total</td>
                                <td><?php echo $total_litres; ?></td>
                                <td><?php echo $total_gallons; ?> gal</td>
                                <td colspan="6"></td>
                                <td><?php echo $total_amount; ?></td>
                            </tr>
                        </tfoot>
                    </table>
                    <h2>Supplier List</h2>
                    <table border="1" id="supplier" width="100%">
                        <tr>
                            <th>Supplier Name</th>
                            <th>Supplier NRC</th>
                            <th>Supplier Address</th>
                            <th>Supplier Number</th>
                            <th>Supplier Photo</th>
                            <th>Update</th>

                        </tr>
                        <?php
                    $supplier_query = "SELECT * FROM suppliertb";
                    $supplier_result = mysqli_query($connect, $supplier_query);
                    while ($supplier_row = mysqli_fetch_assoc($supplier_result)) {
                        echo "<tr>";
                        
                        echo "<td>" . $supplier_row['SupplierName'] . "</td>";
                        echo "<td>" . $supplier_row['SupplierNRC'] . "</td>";
                        echo "<td>" . $supplier_row['SupplierAddress'] . "</td>";
                        echo "<td>" . $supplier_row['SupplierPNumber'] . "</td>";
                        echo "<td><img src='" . $supplier_row['SupplierPhoto'] . "' width='50' height='50'></td>";
                        echo "<td><a href='SupplierUpdate.php?Sid=$supplier_row[SupplierID]'>Update</a></td>";
                       
                        echo "</tr>";
                    }
                    ?>
                    </table>
                    <h2> Staff Lists</h2>
                    <table border="1" id="staff" width="100%">
                        <tr>
                            <th>Staff Name</th>
                            <th>Staff Position</th>
                            <th>Staff Number</th>
                            <th>Staff Address</th>
                            <th>Staff Email</th>
                            <th>Staff DOB</th>
                            <th>Staff Gender</th>
                            <th>Staff Hire Date</th>
                            <th>Staff Salary</th>
                            <th>Staff E_Contact</th>
                            <th>Staff E_Phone</th>
                            <th>User Name</th>
                            <th>Password</th>
                            <th>Brand Name</th>
                            <th>Update</th>

                        </tr>
                        <?php
                    $supplier_query = "SELECT * FROM stafftb";
                    $supplier_result = mysqli_query($connect, $supplier_query);
                    while ($supplier_row = mysqli_fetch_assoc($supplier_result)) {
                        echo "<tr>";
                        
                        echo "<td>" . $supplier_row['StaffName'] . "</td>";
                        echo "<td>" . $supplier_row['StaffPosition'] . "</td>";
                        echo "<td>" . $supplier_row['StaffPNumber'] . "</td>";
                        echo "<td>" . $supplier_row['StaffAddress'] . "</td>";
                        echo "<td>" . $supplier_row['StaffEmail'] . "</td>";
                        echo "<td>" . $supplier_row['StaffDOB'] . "</td>";
                        echo "<td>" . $supplier_row['StaffGender'] . "</td>";
                        echo "<td>" . $supplier_row['StaffHireDate'] . "</td>";
                        echo "<td>" . $supplier_row['StaffSalary'] . "</td>";
                        echo "<td>" . $supplier_row['StaffE_Contact'] . "</td>";
                        echo "<td>" . $supplier_row['StaffE_Phone'] . "</td>";
                        echo "<td>" . $supplier_row['SUserName'] . "</td>";
                        echo "<td>" . $supplier_row['SPassword'] . "</td>";
                        echo "<td>" . $supplier_row['branchid'] . "</td>";
                        
                        echo "<td><a href='UpdateStaff.php?Stid=$supplier_row[StaffID]'>Update</a></td>";
                       
                        echo "</tr>";
                    }
                    ?>
                    </table>
                    <h3>Purchases Lists</h3>
                    <table id="purchase" border="1" width="100%">
                        <tr>
                            <th>Purchase Detail</th>
                            <th>Purchase Code</th>
                            <th>Purchase Date</th>
                            <th>Supplier Name</th>
                            <th>Litres</th>
                            <th>Petrol Type</th>

                            <th>Staff Name</th>
                            <th>Purchase Amount</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                        <?php
                    $purchase_query = "SELECT * FROM purchases";
                    $purchase_result = mysqli_query($connect, $purchase_query);
                    while ($purchase_row = mysqli_fetch_assoc($purchase_result)) {
                        $purchase_details_query = "SELECT PurchaseDetailCode, PurchaseLiters, PetrolCode, StaffID, PurchaseAmount FROM purchasedetails WHERE PurchaseCode = '{$purchase_row['PurchaseCode']}'";
                        $purchase_details_result = mysqli_query($connect, $purchase_details_query);
                        while ($purchase_details_row = mysqli_fetch_assoc($purchase_details_result)) {
                            echo "<tr>";
                            echo "<td>" . $purchase_details_row['PurchaseDetailCode'] . "</td>";
                            echo "<td>" . $purchase_row['PurchaseCode'] . "</td>";
                            echo "<td>" . $purchase_row['PurchaseDate'] . "</td>";
                            $supplier_id = $purchase_row['SupplierID'];
                            $supplier_name_query = "SELECT SupplierName FROM suppliertb WHERE SupplierID = '$supplier_id'";
                            $supplier_name_result = mysqli_query($connect, $supplier_name_query);
                            $supplier_name_row = mysqli_fetch_assoc($supplier_name_result);
                            $supplier_name = $supplier_name_row['SupplierName'];
                            echo "<td>" . $supplier_name . "</td>";
                            echo "<td>" . $purchase_details_row['PurchaseLiters'] . "</td>";
                            $petrol_code = $purchase_details_row['PetrolCode'];
                            $petrol_name_query = "SELECT PetrolName FROM petrol WHERE PetrolCode = '$petrol_code'";
                            $petrol_name_result = mysqli_query($connect, $petrol_name_query);
                            $petrol_name_row = mysqli_fetch_assoc($petrol_name_result);
                            $petrol_name = $petrol_name_row['PetrolName'];
                            echo "<td>" . $petrol_name . "</td>";
                            
                            $staff_id = $purchase_details_row['StaffID'];
                            $staff_name_query = "SELECT StaffName FROM stafftb WHERE StaffID = '$staff_id'";
                            $staff_name_result = mysqli_query($connect, $staff_name_query);
                            $staff_name_row = mysqli_fetch_assoc($staff_name_result);
                            
                                $staff_name = $staff_name_row['StaffName'];
                            echo "<td>" . $staff_name . "</td>";
                            echo "<td>" . $purchase_details_row['PurchaseAmount'] . "</td>";
                            
                            echo "<td><a href='update_purchase.php?code=".$purchase_details_row['PurchaseDetailCode']."'>Update</a></td>";
                            echo "<td><form  method='post'>
                                        <input type='hidden' name='code' value='".$purchase_details_row['PurchaseDetailCode']."'>
                                        <input type='submit' name='btn_delete' value='Delete'>
                                    </form></td>";
                                    if(isset($_POST['btn_delete'])){
                                        $code = $_POST['code'];
                                        $delete_query = "DELETE FROM purchasedetails WHERE PurchaseDetailCode = '$code'";
                                        $delete_result = mysqli_query($connect, $delete_query);
                                        if($delete_result){
                                            echo "<script>alert('Successfully Deleted')</script>";
                                            echo "<script>window.location='vdailysale.php'</script>";
                                        } else {
                                            echo "<script>alert('Error Deleting Data')</script>";
                                        }
                                    }

                            
                            echo "</tr>";
                        }
                    }
                    ?>
                    </table>
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