<?php
session_start();
include('dbconnect.php');
if(isset($_POST['btnsubmit'])){

    $cname = $_POST['txtcusname'];
    $username = $_POST['txtusername'];
    $password = $_POST['txtpassword'];
    $pnumber = $_POST['txtphone'];
    $custype=$_POST['cbocustype'];
    $cid = 'CS_0000';
    $last_id = mysqli_query($connect, "SELECT MAX(RIGHT(CustomerID, LENGTH(CustomerID)-3)) AS LastID FROM customer");
    $row = mysqli_fetch_assoc($last_id);
    $last_id = $row['LastID'];
    $new_id = (int)$last_id + 1;
    $cid = $cid.(str_pad($new_id, 3, '0', STR_PAD_LEFT));
    $number=preg_match('@[0-9]@',$password);
    $Upper=preg_match('@[A-Z]@',$password);
    $Lower=preg_match('@[a-z]@',$password);
    $SpeCha=preg_match('@[^\w]@',$password);
        //    Check Email
  $checkUserName="SELECT * FROM customer where CustomerUsername='$username'";
  $answer= mysqli_query($connect,$checkUserName);
 $count= mysqli_num_rows($answer);
 if ($count>0)
{
    if($answer){
    echo "<script>window.alert('User Name Already exist')</script>" ;
    echo "<script>window.location='cusreg.php'</script>" ;
    }

}
else if(strlen($password)<8 || !$number || !$Upper || !$Lower || !$SpeCha)
{

    echo "<script>window.alert('Password must be at least 8 characters login and contain at least uppercase , lower case and special character.')</script>" ;
    echo "<script>window.location='cusreg.php'</script>" ;
}
else{
    $sql = "INSERT INTO customer(CustomerID,CustomerName,CustomerUsername,CustomerPassword,CustomerPNumber,CustomerTypeID) VALUES('$cid','$cname','$username','$password','$pnumber','$custype')";
    if(mysqli_query($connect,$sql)){
        echo "<script>alert('Data inserted successfully')</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connect);
    }
}  
} 

?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Customer Registration</title>
  <link rel="stylesheet" href="css/stylelogin.css">

</head>
<body>
<!-- partial:index.partial.html -->
<body>
    <section class="container">
        <div class="login-container">
            <div class="circle circle-one"></div>
            <div class="form-container">
                <img src="https://raw.githubusercontent.com/hicodersofficial/glassmorphism-login-form/master/assets/illustration.png" alt="illustration" class="illustration" />
                <h1 class="opacity">Register</h1>
                <form action="cusreg.php" method="post" >
                    <input type="text" placeholder="Customer Name" name="txtcusname" required/>
                    <input type="text" placeholder="User Name" name="txtusername" required/>
                    <input type="password"placeholder="Password" name="txtpassword" id="">
                    <input type="text" name="txtphone" placeholder="Phone Number" id=""required/>
                    <select name="cbocustype" id="">Customer Type :

                    <?php   
                    $select="SELECT * FROM customertypetb";
                    $query=mysqli_query($connect,$select);
                    $count=mysqli_num_rows($query);
                    for ($i=0; $i < $count ; $i++) { 
                            $fetch=mysqli_fetch_array($query);
                            $CusTID=$fetch['CustomerTypeID'];
                            $TypeName=$fetch['TypeName'];
                            

                            echo "<option value='$CusTID'>$TypeName</option>";
                            
                    }
                ?>
                    </select>
                    <button  name="btnsubmit">SUBMIT</button>
                </form>
               
            </div>
            <div class="circle circle-two"></div>
        </div>
        <div class="theme-btn-container"></div>
    </section>
</body>
<!-- partial -->
  <script  src="js/scriptlogin.js"></script>

</body>
</html>