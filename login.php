<?php
session_start();
include('dbconnect.php');
    if (isset($_POST['btnsubmit'])){

                    $username=mysqli_real_escape_string($connect,$_POST['txtusername']);
                    $password=mysqli_real_escape_string($connect,$_POST['txtpassword']);

                    $check="SELECT * FROM customer WHERE CustomerUsername='$username' AND CustomerPassword='$password'";
                    $result = mysqli_query($connect, $check);
                    $count = mysqli_num_rows($result);
                    if ($count > 0) {

                            $array=mysqli_fetch_array($result);
                            $CID=$array['CustomerID'];
                            $CName=$array['CustomerName'];
                            $CUName=$array['CustomerUsername'];
                            $CPass=$array['CustomerPassword'];
                            $CPNum=$array['CustomerPNumber'];
                            $CTypeID=$array['CustomerTypeID'];
                            
                            $_SESSION['CID']=$CID;
                              $_SESSION['CName']=$CName;
                              $_SESSION['CUName'] = $CUName; 
                          
                            $_SESSION['CPass']=$CPass;
                            $_SESSION['CPNum']=$CPNum;
                            $_SESSION['CTypeID']=$CTypeID;
                            setcookie("Customer", $CUName, time() + 10, '/');
                    
                            echo "<script>window.alert('Welcome');</script>";
                            echo "<script>window.location='index.php';</script>"; 

                    }

                    else {
                        $_SESSION['LoginError'] = isset($_SESSION['LoginError']) ? $_SESSION['LoginError'] + 1 : 1;
                        if ($_SESSION['LoginError'] >= 3) {
                            echo "<script>window.alert('Login locked.');</script>";
                            echo "<script>window.location='Timer.php';</script>";
                            $_SESSION['LoginError'] = 0; // Reset counter after lock
                        } else {
                            $chancesLeft = 3 - $_SESSION['LoginError'];
                            echo "<script>window.alert('You have " . $chancesLeft . " chances left. Please type your password or email correctly.');</script>";
                        }
                    }

    }
    if (isset($_POST['btnsubmit'])){

        $username=mysqli_real_escape_string($connect,$_POST['txtusername']);
        $password=mysqli_real_escape_string($connect,$_POST['txtpassword']);

        $check="SELECT * FROM stafftb WHERE SUserName='$username' AND SPassword='$password'";
        $result = mysqli_query($connect, $check);
        $count = mysqli_num_rows($result);
        if ($count > 0) {

                $array=mysqli_fetch_array($result);
                $SID=$array['StaffID'];
                $SName=$array['StaffName'];
                $SUName=$array['SUserName'];
                $SPass=$array['SPassword'];
                $SPNum=$array['StaffPNumber'];
                
                
                $_SESSION['SID']=$SID;
                $_SESSION['SName'] = $SName; 
                $_SESSION['SUName'] = $SUName; 
                $_SESSION['SPass']=$SPass;
              
        
                echo "<script>window.alert('Welcome');</script>";
                echo "<script>window.location='adminside.php';</script>"; 

        }
    }

?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Login</title>
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
                <h1 class="opacity">LOGIN</h1>
                <form action="login.php" method="post" >
                    <input type="text" placeholder="USERNAME" name="txtusername" />
                    <input type="password" placeholder="PASSWORD" name="txtpassword" />
                    <button  name="btnsubmit">SUBMIT</button>
                </form>
                <div class="register-forget opacity">
                    <a href="cusreg.php">REGISTER</a>
                    <a href="">FORGOT PASSWORD</a>
                </div>
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
