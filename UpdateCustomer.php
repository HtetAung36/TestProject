<?php

session_start();
    include('dbconnect.php');
    if(!isset($_SESSION['CID']) ){

        echo "<script>window.alert('Please login first.You can again book and recent book will be deleted.')</script>";
        echo "<script>window.location='login.php'</script>";
       
    }
  $CID= $_SESSION['CID'];
 $CName = mysqli_fetch_assoc(mysqli_query($connect, "SELECT CustomerName FROM customer WHERE CustomerID='$CID'"))['CustomerName'];
       $CUName = $_SESSION['CUName'] ; 
     $CPass =  $_SESSION['CPass'];
     $CPNum = mysqli_fetch_assoc(mysqli_query($connect, "SELECT CustomerPNumber FROM customer WHERE CustomerID='$CID'"))['CustomerPNumber'];
      $CTypeID = $_SESSION['CTypeID'];
    
if (isset($_POST['update'])) {
   
    $CusName = $_POST['txtCusName'];
   
    $CUName = $_POST['txtCUName'];
    $CPass = $_POST['txtCPass'];
    $CPNum = $_POST['txtCPNum'];
    $CTypeID = $_POST['txtCTypeID'];
    


    $updateQuery = "UPDATE customer SET CustomerName = '$CusName', CustomerUsername = '$CUName', CustomerPassword = '$CPass', CustomerPNumber = '$CPNum', CustomerTypeID = '$CTypeID' WHERE CustomerID = '$CID'";

    $updateResult = mysqli_query($connect, $updateQuery);

    if ($updateResult) {
        echo "<script>alert('Successfully Updated')</script>";
        echo "<script>window.location='index.php'</script>";
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
    <title>Update Customer</title>
</head>
    <link rel="stylesheet" href="css/UCus.css">

<body>




<div class="container-form">
    <form action="UpdateCustomer.php" method="POST" >
        <h1>Update Customer Info</h1>
        <div class="form-group">
            <label for="txtCusID">Customer ID :</label>
            <input type="text"readonly name="txtCusID" id="txtCusID" placeholder="Enter Customer ID" value="<?php echo $CID; ?>" required class="form-control" />

            <label for="txtCusName">Customer Name :</label>
            <input type="text" name="txtCusName" id="txtCusName" placeholder="Enter Customer Name" value="<?php echo $CName; ?>" required class="form-control" />

            <label for="txtCUName"> User Name :</label>
            <input type="text" name="txtCUName" id="txtCUName" placeholder="Enter User Name" value="<?php echo $CUName; ?>" required class="form-control" />

            <label for="txtCPass">Password :</label>
            <input type="text" name="txtCPass" id="txtCPass" placeholder="Enter Password" value="<?php echo $CPass; ?>" required class="form-control" />

            <label for="txtCPNum">Phone Number :</label>
            <input type="text" name="txtCPNum" id="txtCPNum" placeholder="Enter Phone Number" value="<?php echo $CPNum; ?>" required class="form-control" />

            <label for="txtCTypeID">Customer Type :</label>
            <input type="text"readonly name="txtCTypeID" id="txtCTypeID" value="<?php echo $CTypeID; ?>" class="form-control" />
        </div>
        <button type="submit" name="update"class="button" >Update</button>
    </form>
</div>
</body>
</html>