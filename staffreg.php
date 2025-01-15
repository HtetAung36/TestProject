<?php
include('dbconnect.php');

session_start();
if(isset($_POST['submit'])){

    $staffname = $_POST['txtstaffname'];
    $position = $_POST['txtposition'];
    $phonenumber = $_POST['txtphonenumber'];
    $address = $_POST['txtaddress'];
    
    $email=$_POST['txtemail'];
    $dob=$_POST['txtdate'];
    $gender=$_POST['txtgender'];
    $hiredate=$_POST['txthiredate'];
    $salary=$_POST['txtsalary'];
    $Econtent=$_POST['txtEcontent'];
    $EPNumber=$_POST['txtEPhone'];
    $Username=$_POST['txtUsername'];
    $Password=$_POST['txtPassword'];
    $BCode=$_POST['cbobid'];

    $staffid = 'St_';
    $last_id = mysqli_query($connect, "SELECT MAX(RIGHT(StaffID, LENGTH(StaffID)-3)) AS LastID FROM stafftb");
    $row = mysqli_fetch_assoc($last_id);
    $last_id = $row['LastID'];
    $new_id = (int)$last_id + 1;
    $staffid = $staffid.(str_pad($new_id, 3, '0', STR_PAD_LEFT));


    
    $number=preg_match('@[0-9]@',$Password);
    $Upper=preg_match('@[A-Z]@',$Password);
    $Lower=preg_match('@[a-z]@',$Password);
    $SpeCha=preg_match('@[^\w]@',$Password);
        //    Check Email
  $checkUserName="SELECT * FROM stafftb where SUserName='$Username'";
  $answer= mysqli_query($connect,$checkUserName);
 $count= mysqli_num_rows($answer);
 if ($count>0)
{
    if($answer){
    echo "<script>window.alert('User Name Already exist')</script>" ;
    echo "<script>window.location='staffreg.php'</script>" ;
    }

}
else if(strlen($Password)<8 || !$number || !$Upper || !$Lower || !$SpeCha)
{

    echo "<script>window.alert('Password must be at least 8 characters logn and contain at least uppercase , lower case and special character.')</script>" ;
    echo "<script>window.location='staffreg.php'</script>" ;
}
else
{
   
    $sql = "INSERT INTO stafftb(StaffID,StaffName,StaffPosition,StaffPNumber,StaffAddress,StaffEmail,StaffDOB,StaffGender,StaffHireDate,StaffSalary,StaffE_Contact,StaffE_Phone,SUserName,SPassword,branchid)
     VALUES('$staffid','$staffname','$position','$phonenumber','$address','$email','$dob','$gender','$hiredate','$salary','$Econtent','$EPNumber','$Username','$Password','$BCode')";
    $result=mysqli_query($connect,$sql);
    if($result){
        echo "<script>alert('Data inserted successfully')</script>";
        echo "<script>window.location='login.php'</script>" ;
} 
}
}  
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Registration</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="srbody">
    <div class="srcontainer">

        <div class="srcontent">

            <div class="staffcon">
                <div class="staffreg">
                    <h1 class="srheading">Staff Register</h1>
                    <form action="staffreg.php" method="post">




                        <input type="text" name="txtstaffname" required placeholder="Enter Staff Name">
                        <div class="srbeside">
                            <input type="number" name="txtphonenumber" required placeholder="Phone Number">
                                <label for="">Position</label>
                            <select name="txtposition" id="">
                                <option value="Admin">Admin</option>
                                <option value="Station Manager">Station Manager</option>
                                <option value="Supervisor">Supervisor</option>
                                <option value="Pump Staff">Pump Staff</option>
                                <option value="Cashier">Cashier</option>
                                <option value="Stock Checker">Stock Checker</option>
                                <option value="Driver">Driver</option>
                                <option value="Customer Service">Customer Service</option>
                                <option value="Security Guard"></option>
                            </select>
                        </div><br>
                        <input type="email" name="txtemail" id="" placeholder="Email"><br>

                        <input type="text" name="txtaddress" id="" placeholder="Address" required><br>
                        <label for="">Date of Birth</label><br>
                        <input type="date" name="txtdate" id="" placeholder="Date Of Birth" required><br><br>
                        <label for="txtgender">Gender</label><br>
<select name="txtgender" id="">
  <option value="Male">Male</option>
  <option value="Female">Female</option>
  <option value="Other">Other</option>
</select><br><br>

                        <label for="">Hire Date : </label><br>
                        <input type="date" name="txthiredate" id="" placeholder="Hire Date" required><br><br>
                        <input type="text" name="txtsalary" id="" placeholder="Salary" required><br>
                        <input type="text" name="txtEcontent" id="" placeholder="Emergency Content" required><br>
                        <input type="text" name="txtEPhone" id="" placeholder="Emergency Phone" required><br>
    <br>
                        <label for="">Branch Name</label><br>
                        <select name="cbobid" id="">
                            <?php   
                    $select="SELECT * FROM branches";
                    $query=mysqli_query($connect,$select);
                    $count=mysqli_num_rows($query);
                    for ($i=0; $i < $count ; $i++) { 
                            $fetch=mysqli_fetch_array($query);
                            $BCode=$fetch['Branchid'];
                            $BName=$fetch['BranchName'];
                            echo "<option value='$BCode'>$BName</option>";
                            
                    }
                ?>
                        </select>
                        <input type="hidden" name="cid" value="<?php echo $CID; ?>">
                </div>
                <hr>
                <div class="accreg">

                    <h1 class="srheading">Register Account</h1>
                    <input type="text" name="txtUsername" id="" placeholder="User Name" required><br><br>
                    <input type="text" name="txtPassword" id="" placeholder="Password" required><br><br>
                    <div class="tacbox">
                        <input id="checkbox" type="checkbox" />
                        <label for="checkbox"> I agree to these <a href="#">Terms and Conditions</a>.</label>
                    </div>


                    <button type="submit" name="submit" value="Submit" class="srbt">
                        <div class="svg-wrapper-1">
                            <div class="svg-wrapper">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                    <path fill="none" d="M0 0h24v24H0z"></path>
                                    <path fill="currentColor"
                                        d="M1.946 9.315c-.522-.174-.527-.455.01-.634l19.087-6.362c.529-.176.832.12.684.638l-5.454 19.086c-.15.529-.455.547-.679.045L12 14l6-8-8 6-8.054-2.685z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <span>Submit</span>
                    </button>
                </div>
            </div>
            </form>
        </div>
    </div>
</body>

</html>