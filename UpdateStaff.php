<?php
include('dbconnect.php');
session_start();


if (isset($_GET['Stid'])) {
    $id = $_GET['Stid'];
    $selectQuery = "SELECT * FROM stafftb WHERE StaffID = '$id'";
    $selectResult = mysqli_query($connect, $selectQuery);

    if (mysqli_num_rows($selectResult) > 0) {
        $row = mysqli_fetch_assoc($selectResult);
        $StaffID= $row['StaffID'];
        $StaffName = $row['StaffName'];
        $position = $row['StaffPosition'];
        $address = $row['StaffAddress'];
        $phonenumber = $row['StaffPNumber'];
        $Email= $row['StaffEmail'];
        $DOB= $row['StaffDOB'];
        $gender= $row['StaffGender'];
        $hiredate= $row['StaffHireDate'];
        $Salary= $row['StaffSalary'];
        $Econtent= $row['StaffE_Contact'];
        $EPNumber= $row['StaffE_Phone'];
        $Username= $row['SUserName'];
        $Password= $row['SPassword'];
        $BCode= $row['branchid'];

    }
}

if (isset($_POST['update'])) {
    $updatedStaffName = $_POST['txtstaffname'];
    $updatedPosition = $_POST['txtposition'];
    $updatedPhoneNumber = $_POST['txtphonenumber'];
    $updatedAddress = $_POST['txtaddress'];
    $updatedEmail = $_POST['txtemail'];
    $updatedDOB = $_POST['txtdate'];
    $updatedGender = $_POST['txtgender'];
    $updatedHireDate = $_POST['txthiredate'];
    $updatedSalary = $_POST['txtsalary'];
    $updatedEContact = $_POST['txtEcontact'];
    $updatedEPNumber = $_POST['txtEPhone'];
    $updatedUsername = $_POST['txtUsername'];
    $updatedPassword = $_POST['txtPassword'];
    $updatedBCode = $_POST['cbobid'];
    $updatedStaffID = $_POST['txtstaffid'];
    
   echo $updateQuery = "UPDATE stafftb SET StaffName = '$updatedStaffName', StaffPosition = '$updatedPosition', StaffPNumber = '$updatedPhoneNumber', StaffAddress = '$updatedAddress', StaffEmail = '$updatedEmail', StaffDOB = '$updatedDOB', StaffGender = '$updatedGender', StaffHireDate = '$updatedHireDate', StaffSalary = '$updatedSalary', StaffE_Contact = '$updatedEContact', StaffE_Phone = '$updatedEPNumber', SUserName = '$updatedUsername', SPassword = '$updatedPassword', branchid = '$updatedBCode' WHERE StaffID = '$updatedStaffID'";
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
    <title>Update Staff</title>
    <link rel="stylesheet" href="Astyle.css">
</head>

<body>
    <div class="container-form">
        <h1>Update Staff info</h1>

        <form action="UpdateStaff.php" method="POST">
            <label for="txtstaffid">Staff ID</label>
            <input type="text" name="txtstaffid" id="txtstaffid" value="<?php echo $StaffID ?>" readonly><br><br>
            <label for="txtstaffname">Staff Name</label>
            <input type="text" name="txtstaffname" id="txtstaffname"
                value="<?php echo isset($StaffName) ? $StaffName : ''; ?>"><br><br>

            <label for="txtposition">Position</label><br>
            <select name="txtposition" id="txtposition">
                <option value="Admin" <?php echo isset($position) && $position == 'Admin' ? 'selected' : ''; ?>>Admin
                </option>
                <option value="Station Manager" <?php echo isset($position) && $position == 'Station Manager' ? 'selected' : ''; ?>>Station Manager</option>
                <option value="Supervisor" <?php echo isset($position) && $position == 'Supervisor' ? 'selected' : ''; ?>>Supervisor</option>
                <option value="Pump Staff" <?php echo isset($position) && $position == 'Pump Staff' ? 'selected' : ''; ?>>Pump Staff</option>
                <option value="Cashier" <?php echo isset($position) && $position == 'Cashier' ? 'selected' : ''; ?>>Cashier</option>
                <option value="Stock Checker" <?php echo isset($position) && $position == 'Stock Checker' ? 'selected' : ''; ?>>Stock Checker</option>
                <option value="Driver" <?php echo isset($position) && $position == 'Driver' ? 'selected' : ''; ?>>Driver</option>
                <option value="Customer Service" <?php echo isset($position) && $position == 'Customer Service' ? 'selected' : ''; ?>>Customer Service</option>
                <option value="Security Guard" <?php echo isset($position) && $position == 'Security Guard' ? 'selected' : ''; ?>>Security Guard</option>
            </select><br><br>

            <label for="txtphonenumber">Phone Number</label>
            <input type="text" name="txtphonenumber" id="txtphonenumber"
                value="<?php echo isset($phonenumber) ? $phonenumber : ''; ?>"><br><br>

            <label for="txtaddress">Address</label>
            <input type="text" name="txtaddress" id="txtaddress"
                value="<?php echo isset($address) ? $address : ''; ?>"><br><br>

            <label for="txtemail">Email</label>
            <input type="email" name="txtemail" id="txtemail"
                value="<?php echo isset($Email) ? $Email : ''; ?>"><br><br>

            <label for="txtdate">Date of Birth</label><br>
            <input type="number" name="txtdate" id="txtdate" value="<?php echo isset($dob) ? $dob : ''; ?>"><br><br>

            <label for="txtgender">Gender</label><br>
            <select name="txtgender" id="txtgender">
                <option value="<?php echo$gender ?>"
                    <?php echo isset($gender) && $gender == 'Male' ? 'selected' : ''; ?>>Male</option>
                <option value="<?php echo$gender ?>"
                    <?php echo isset($gender) && $gender == 'Female' ? 'selected' : ''; ?>>Female</option>
                <option value="<?php echo$gender ?>"
                    <?php echo isset($gender) && $gender == 'Other' ? 'selected' : ''; ?>>Other</option>
            </select><br><br>

            <label for="txthiredate">Hire Date</label>
            <input type="date" name="txthiredate" id="txthiredate"
                value="<?php echo isset($hiredate) ? $hiredate : ''; ?>"><br><br>

            <label for="txtsalary">Salary</label>
            <input type="number" name="txtsalary" id="txtsalary"
                value="<?php echo isset($Salary) ? $Salary : ''; ?>"><br><br>

            <label for="txtEcontent">Emergency Contact</label>
            <input type="text" name="txtEcontact" id="txtEcontent"
                value="<?php echo isset($Econtent) ? $Econtent : ''; ?>"><br><br>

            <label for="txtEPhone">Emergency Phone Number</label>
            <input type="text" name="txtEPhone" id="txtEPhone"
                value="<?php echo isset($EPNumber) ? $EPNumber : ''; ?>"><br><br>

            <label for="txtUsername">User Name</label>
            <input type="text" name="txtUsername" id="txtUsername"
                value="<?php echo isset($Username) ? $Username : ''; ?>"><br><br>

            <label for="txtPassword">Password</label>
            <input type="password" name="txtPassword" id="txtPassword"
                value="<?php echo isset($Password) ? $Password : ''; ?>"><br><br>

            <label for="cbobid">Branch ID</label><br>
            <select name="cbobid" id="cbobid">
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
            </select><br><br>
            <input type="submit" name="update" value="Submit">
                </form>

    </div>
</body>

</html>