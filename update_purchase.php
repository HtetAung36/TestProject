<?php
include('dbconnect.php');


if (isset($_GET['code'])) {
    $id = $_GET['code'];
    $selectQuery = "SELECT p.*, pd.* FROM purchasedetails pd JOIN purchases p ON pd.PurchaseCode = p.PurchaseCode WHERE pd.PurchaseDetailCode = '$id'";
    $selectResult = mysqli_query($connect, $selectQuery);

    if (mysqli_num_rows($selectResult) > 0) {
        $row = mysqli_fetch_assoc($selectResult);
        $PDCode= $row['PurchaseDetailCode'];
        $PurchaseCode= $row['PurchaseCode'];
        $PurchaseDate = $row['PurchaseDate'];
        $SupplierID = $row['SupplierID'];   
        $PetrolCode = $row['PetrolCode'];
        $StaffID = $row['StaffID'];
        $PurchaseLiters = $row['PurchaseLiters'];
        $PurchaseAmount = $row['PurchaseAmount'];
    }
}
if (isset($_POST['update'])) {
    $PdDCode = $_POST['txtpurchasedetailcode'];
    $PurchaseCode = $_POST['txtpurchasecode'];
    $PurchaseDate = $_POST['txtpurchasedate'];
    $SupplierID = $_POST['txtsuppliername'];
    $PetrolCode = $_POST['txtpetrolname'];
    $StaffID = $_POST['txtstaffname'];
    $PurchaseLiters = $_POST['txtpurchaseliters'];
    $PurchaseAmount = $_POST['txtpurchaseamount'];

   echo $updateQuery = "UPDATE purchases SET PurchaseDate = '$PurchaseDate', SupplierID = '$SupplierID' WHERE PurchaseCode = '$PurchaseCode'";
   echo $updateQuery1 = "UPDATE purchasedetails SET PetrolCode = '$PetrolCode', StaffID = '$StaffID', PurchaseLiters = '$PurchaseLiters', PurchaseAmount = '$PurchaseAmount' WHERE PurchaseDetailCode = '$PdDCode'";
    $updateResult = mysqli_query($connect, $updateQuery);
    $updateResult1 = mysqli_query($connect, $updateQuery1);

    if ($updateResult && $updateResult1) {
        echo "<script>alert('Successfully Updated')</script>";
        echo "<script>window.location='vdailysale.php'</script>";
    } else {
        echo "<script>alert('Error updating data')</script>";
    }
}
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Purchase</title>
    <link rel="stylesheet" href="Astyle.css">
</head>
<body>
    <form action="update_purchase.php" method="POST">
    <div class="container-form">
        <h2>Update Purchase</h2>
        <label for="">Purchase Detail Code</label>
        <input type="text" name="txtpurchasedetailcode" value="<?php echo $PDCode; ?>" readonly>
        <label for="">Purchase Code</label>
        <input type="text" name="txtpurchasecode" value="<?php echo $PurchaseCode; ?>" readonly>
        <label for="">Purchase Date</label>
        <input type="date" name="txtpurchasedate" value="<?php echo $PurchaseDate; ?>">
        <label for="">Supplier Name</label>
        <input type="hidden" name="txtsuppliername" value="<?php echo $SupplierID; ?>">
        <?php
            $supplierQuery = "SELECT SupplierName FROM suppliertb WHERE SupplierID = '$SupplierID'";
            $supplierResult = mysqli_query($connect, $supplierQuery);
            $supplierRow = mysqli_fetch_assoc($supplierResult);
        ?>
        <input type="text" name="txtsupplier" value="<?php echo $supplierRow['SupplierName']; ?>" readonly>
        <label for="">Petrol Name</label>
        <input type="text" name="txtpetrolname" value="<?php echo $PetrolCode; ?>" readonly>
        <?php
            $petrolQuery = "SELECT PetrolName FROM petrol WHERE PetrolCode = '$PetrolCode'";
            $petrolResult = mysqli_query($connect, $petrolQuery);
            $petrolRow = mysqli_fetch_assoc($petrolResult);
        ?>
        <input type="text" name="tpetrolname" value="<?php echo $petrolRow['PetrolName']; ?>" readonly>
        <label for="">Staff Name</label>
        <input type="hidden" name="txtstaffname" value="<?php echo $StaffID; ?>">
        <?php
            $staffQuery = "SELECT StaffName FROM stafftb WHERE StaffID = '$StaffID'";
            $staffResult = mysqli_query($connect, $staffQuery);
            $staffRow = mysqli_fetch_assoc($staffResult);
        ?>
        <input type="text" name="tstaffname" value="<?php echo $staffRow['StaffName']; ?>" readonly>
        <label for="">Purchase Litres</label>
        <input type="number" name="txtpurchaseliters" value="<?php echo $PurchaseLiters; ?>" required>
        <label for="">Purchase Amount</label>
        <input type="text" name="txtpurchaseamount" value="<?php echo $PurchaseAmount; ?>" required>
        <input type="submit" name="update" value="Update">
    </form>
    </div>
</body>
</html>
