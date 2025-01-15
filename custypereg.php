<?php
include('dbconnect.php');
session_start();
if(isset($_POST['btnsubmit'])){

    $ctname = $_POST['ctname'];
    $desc = $_POST['desc'];
    $plevel = $_POST['plevel'];
    $CDate = $_POST['CDate'];
    
    $ctid = 'CT_';
    $last_id = mysqli_query($connect, "SELECT MAX(RIGHT(CustomerTypeID, LENGTH(CustomerTypeID)-3)) AS LastID FROM customertypetb");
    $row = mysqli_fetch_assoc($last_id);
    $last_id = $row['LastID'];
    $new_id = (int)$last_id + 1;
    $ctid = $ctid.(str_pad($new_id, 3, '0', STR_PAD_LEFT));


    $sql = "INSERT INTO customertypetb(CustomerTypeID,TypeName,CTDescription,PriorityLevel,CreatedDate) VALUES('$ctid','$ctname','$desc','$plevel','$CDate')";
    if(mysqli_query($connect,$sql)){
        echo "<script>alert('Data inserted successfully')</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connect);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Type Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="cusreg">
        <h1>Customer Type Registration</h1>
        <form action="custypereg.php" method="post">
            <label for="ctname">Customer Type Name</label><br>
            <input type="text" name="ctname" id="ctname"><br>
            <label for="desc">Description</label><br>
            <input type="text" name="desc" id="desc"><br>
            <label for="plevel">Priority Level</label><br>
            <input type="text" name="plevel" id="plevel"><br>
            <label for="CDate">Created Date</label><br>
            <input type="date" name="CDate" id="CDate"><br>
            <input type="submit" value="Submit" name="btnsubmit"><br>
        </form>
    </div>
</body>
</html>
