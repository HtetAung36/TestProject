<?php
include('dbconnect.php');


if (isset($_GET['Sid'])) {
    $id = $_GET['Sid'];
    $selectQuery = "SELECT * FROM suppliertb WHERE SupplierID = '$id'";
    $selectResult = mysqli_query($connect, $selectQuery);

    if (mysqli_num_rows($selectResult) > 0) {
        $row = mysqli_fetch_assoc($selectResult);
        $SupplierID= $row['SupplierID'];
        $suppliername = $row['SupplierName'];
        $nrc = $row['SupplierNRC'];
        $address = $row['SupplierAddress'];
        $phonenumber = $row['SupplierPNumber'];
        $photo = $row['SupplierPhoto'];

    }
}

if (isset($_POST['update'])) {
    
    $updatedSupplierName = $_POST['txtsuppliername'];
    $updatedNRC = $_POST['txtnrc'];
    $updatedAddress = $_POST['txtaddress'];
    $updatedPhoneNumber = $_POST['txtphonenumber'];
    $updatedSupplierID = $_POST['txtsupplierid'];
    
    $updateQuery = "UPDATE suppliertb SET SupplierName = '$updatedSupplierName', SupplierNRC = '$updatedNRC', SupplierAddress = '$updatedAddress', SupplierPNumber = '$updatedPhoneNumber'  WHERE SupplierID = '$updatedSupplierID'";
    $updateResult = mysqli_query($connect, $updateQuery);

    if ($updateResult) {
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
    <title>Update Supplier</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="srbody">
        <div class="srcontainer">
        <h1>Update Supplier info</h1>
        <div class="form-group">
            <form action="SupplierUpdate.php" method="POST" >
                <label for="">Supplier ID</label>
                <input type="text" name="txtsupplierid" value="<?php echo $SupplierID; ?>" id="" readonly><br><br>
                <label for="txtsuppliername">Supplier Name</label>
                <input type="text" name="txtsuppliername" id="txtsuppliername" value="<?php echo $suppliername; ?>"><br><br>

                <label for="txtnrc">Supplier NRC</label>
                <input type="text" name="txtnrc" id="txtnrc" value="<?php echo $nrc; ?>"><br><br>

                <label for="txtaddress">Supplier Address</label>
                <input type="text" name="txtaddress" id="txtaddress" value="<?php echo $address; ?>"><br><br>

                <label for="txtphonenumber">Supplier Phone Number</label>
                <input type="text" name="txtphonenumber" id="txtphonenumber" value="<?php echo $phonenumber; ?>"><br><br>

                <input type="submit" name="update" value="Update">
            </form>
</div>
        </div>
    </div>
</body>

</html>
