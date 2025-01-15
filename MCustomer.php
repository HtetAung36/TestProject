<?php

include('dbconnect.php');
session_start();
if(!isset($_SESSION['SID'])){
    echo "<script>window.alert('login fail')</script>" ;
    echo "<script>window.location='login.php'</script>" ;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Customer</title>
    <link rel="stylesheet" href="css/UCus.css">
</head>  

<body>

    <?php
    $sql = "SELECT * FROM customer";
    $result = mysqli_query($connect, $sql);
    ?>
        <h2>Customer List</h2>
    <table>
        <tr>
            <th>Customer ID</th>
            <th>Customer Name</th>
            <th>Customer Username</th>
            <th>Customer Type</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['CustomerID']; ?></td>
                <td><?php echo $row['CustomerName']; ?></td>
                <td><?php echo $row['CustomerUsername']; ?></td>
                <?php
                $customerTypeID = $row['CustomerTypeID'];
                $sql = "SELECT TypeName FROM customertypetb WHERE CustomerTypeID = '$customerTypeID'";
                $result2 = mysqli_query($connect, $sql);
                $row2 = mysqli_fetch_assoc($result2);
                echo "<td>" . $row2['TypeName'] . "</td>";
                ?>
            </tr>
        <?php } ?>
    </table>
    
    <h2>Order List</h2>
    <table>
        <tr>
            <th>Order ID</th>
            <th>Order Date</th>
            <th>Car Number</th>
            <th>Customer ID</th>
            <th>Car Type</th>
            <th>Promotion</th>
            <th>Payment Type</th>
            <th>Branches</th>
        </tr>
        <?php
        $sql = "SELECT * FROM orders";
        $result = mysqli_query($connect, $sql);

        while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['OrderID']; ?></td>
                <td><?php echo $row['OrderDate']; ?></td>
                <td><?php echo $row['CarNumber']; ?></td>
                <td><?php echo $row['CustomerID']; ?></td>
                <td><?php echo $row['CarType']; ?></td>
                <td><?php
                    $promotionNameSql = "SELECT PromotionName FROM promotion WHERE PromotionCode = '$row[PromotionCode]'";
                    $promotionNameResult = mysqli_query($connect, $promotionNameSql);
                    $promotionNameRow = mysqli_fetch_assoc($promotionNameResult);
                    echo $promotionNameRow['PromotionName'];
                    ?></td>
                <td><?php
                    $paymentTypeNameSql = "SELECT PaymentType FROM paymenttype WHERE PaymentTypeCode = '$row[PaymentTypeCode]'";
                    $paymentTypeNameResult = mysqli_query($connect, $paymentTypeNameSql);
                    $paymentTypeNameRow = mysqli_fetch_assoc($paymentTypeNameResult);
                    echo $paymentTypeNameRow['PaymentType'];
                    ?></td>
                <td>
                    <?php
                    $branchNameSql = "SELECT BranchName FROM branches WHERE Branchid = '$row[Branchid]'";
                    $branchNameResult = mysqli_query($connect, $branchNameSql);
                    $branchNameRow = mysqli_fetch_assoc($branchNameResult);
                    echo $branchNameRow['BranchName'];
                    ?>
                </td>

               
            </tr>
        <?php } ?>
    </table>
    
    <h2>Order Details List</h2>
    <table>
        <tr>
            <th>Order Detail ID</th>
            <th>Order Code</th>
            
            <th>Order Litres</th>
            <th>Order Amount</th>
            <th>Petrol Code</th>
        </tr>
        <?php
        $sql = "SELECT * FROM orderdetails";
        $result = mysqli_query($connect, $sql);

        while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['OrderdetailsCode']; ?></td>
                <td><?php echo $row['OrderID']; ?></td>
                
                <td><?php echo $row['OrderLitres']; ?></td>
                <td><?php echo $row['OrderAmount']; ?></td>
                <?php
                $petrolCode = $row['PetrolCode'];
                $sql = "SELECT PetrolName FROM petrol WHERE PetrolCode = '$petrolCode'";
                $result2 = mysqli_query($connect, $sql);
                $row2 = mysqli_fetch_assoc($result2);
                echo "<td>" . $row2['PetrolName'] . "</td>";
                ?>
            </tr>
        <?php } ?>
    </table>
    
</body>
</html>