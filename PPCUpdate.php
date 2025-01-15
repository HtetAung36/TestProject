<?php

include('dbconnect.php');
session_start();

if (isset($_GET['ProCode'])){
    $PPCCode = $_GET['ProCode'];
    $selectQuery = "SELECT * FROM promotion WHERE PromotionCode = '$PPCCode'";
    $selectResult = mysqli_query($connect, $selectQuery);
    if (mysqli_num_rows($selectResult) > 0) {
        $row = mysqli_fetch_assoc($selectResult);
        $PPCCode= $row['PromotionCode'];
        $PromotionName = $row['PromotionName'];
        $PromotionCode = $row['PromotionCode'];
        $Discountpercent = $row['Discountpercent'];
        $PSDate= $row['PStartDate'];
        $PEDate= $row['PEndDate'];
    }
  
}  if (isset($_POST['btnupdate'])) {
        $PromotionCode = $_POST['txtpromotioncode'];
        $PromotionName = $_POST['txtpromotionname'];
        $Discountpercent = $_POST['txtpromotiondiscount'];
        $PSDate = $_POST['txtpromotionstartdate'];
        $PEDate = $_POST['txtpromotionenddate'];
        $updateQuery = "UPDATE promotion SET PromotionName='$PromotionName', Discountpercent='$Discountpercent', PStartDate='$PSDate', PEndDate='$PEDate' WHERE PromotionCode='$PromotionCode'";
        $updateResult = mysqli_query($connect, $updateQuery);
        if ($updateResult) {
            echo "<script>alert('Promotion updated successfully')</script>";
            echo "<script>window.location='vdailysale.php'</script>";

        } else {
            echo "<script>alert('Error updating promotion')</script>";
        }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Promotion</title>
    <link rel="stylesheet" href="css/UCus.css">
    <link rel="stylesheet" href="Astyle.css">
</head>
<body>
    
<div class="container-form">
<form action="PPCUpdate.php" method="POST">
    <h1>Update Promotion</h1>
    <div class="form-group">
        <label for="">Promotion Name :</label><br>
        <input type="text" name="txtpromotionname" placeholder="Enter Promotion Name" required value="<?php echo $PromotionName; ?>" readonly/><br><br>

        <label for="">Promotion Code :</label><br>
        <input type="text" name="txtpromotioncode" placeholder="Enter Promotion Code" required value="<?php echo $PromotionCode; ?>" readonly/><br><br>

        <label for="">Promotion Discount (%) :</label><br>
        <input type="number" name="txtpromotiondiscount" placeholder="Enter Promotion Discount" required value="<?php echo $Discountpercent; ?>"/><br><br>

        
        <label for="">Promotion Start Date </label><br>
        <input type="date" name="txtpromotionstartdate" placeholder="Enter Promotion Start Date" required value="<?php echo $PSDate; ?>"/><br><br>

        <label for="">Promotion End Date </label><br>
        <input type="date" name="txtpromotionenddate" placeholder="Enter Promotion End Date" required value="<?php echo $PEDate; ?>"/><br><br>

        <button type="submit" name="btnupdate">Update</button>
    </div>
</form>
</div>
</body>
</html>