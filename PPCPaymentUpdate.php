<?php
include('dbconnect.php');
session_start();

if (isset($_GET['PTCode'])){
    $PPCCode = $_GET['PTCode'];
    $selectQuery = "SELECT * FROM paymenttype WHERE PaymentTypeCode = '$PPCCode'";
    $selectResult = mysqli_query($connect, $selectQuery);
    if (mysqli_num_rows($selectResult) > 0) {
        $row = mysqli_fetch_assoc($selectResult);
        $PaymentTypeCode = $row['PaymentTypeCode'];
        $PaymentType = $row['PaymentType'];
        $tax= $row['Taxpercentage'];
    }

}
if (isset($_POST['btnupdate'])){
    $updatedPaymentTypeID = $_POST['bPaymentTypeCode'];
    $updatedPaymentType = $_POST['txtPaymentType'];
    $tax = $_POST['txttax'];
    $updateQuery = "UPDATE paymenttype SET PaymentType = '$updatedPaymentType', Taxpercentage = '$tax' WHERE PaymentTypeCode = '$updatedPaymentTypeID'";
    $updateResult = mysqli_query($connect, $updateQuery);
    if ($updateResult) {
        echo "<script>alert('Payment Type updated successfully')</script>";
        echo "<script>window.location='vdailysale.php'</script>";
    } else {
        echo "<script>alert('Error updating promotion')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update Payment Type</title>
</head>
<link rel="stylesheet" href="css/UCus.css">
<link rel="stylesheet" href="Astyle.css">
<body>
<div class="container-form">
    <h1>Update Payment Type</h1>
    <form action="PPCPaymentUpdate.php" method="POST">
    <div class="form-group">
        <label for="txtPaymentType">Payment Type:</label>
        <input type="text" name="txtPaymentType"  value="<?php echo $PaymentType; ?>" required><br><br>
        <label for="">Tax %:</label>
        <input type="number" name="txttax" id="txtPaymentType" value="<?php echo $tax; ?>" required><br><br> 
        <input type="text" name="bPaymentTypeCode" value="<?php echo $PaymentTypeCode; ?>" readonly><br><br>
        <button type="submit" name="btnupdate">Update</button>
</div>
    </form>

</div>
</body>
</html>
