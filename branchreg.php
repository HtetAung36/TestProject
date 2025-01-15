<?php
include('dbconnect.php');

session_start();
if(isset($_POST['submit'])){

    $branchname = $_POST['txtbrachname'];
    $location = $_POST['txtlocation'];
    
    $branchid = 'Br_';
    $last_id = mysqli_query($connect, "SELECT MAX(RIGHT(Branchid, LENGTH(Branchid)-3)) AS LastID FROM branches");
    $row = mysqli_fetch_assoc($last_id);
    $last_id = $row['LastID'];
    $new_id = (int)$last_id + 1;
    $branchid = $branchid.(str_pad($new_id, 3, '0', STR_PAD_LEFT));
    
    $sql = "INSERT INTO branches(Branchid,BranchName,BranchLocation) VALUES('$branchid','$branchname','$location')";
    $result=mysqli_query($connect,$sql);
    if($result){
        echo "<script>alert('Data inserted successfully')</script>";
} 
}  
?>
dfdfd
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Branch Registration</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="brbody">
    <div class="srcontainer">

        <div class="srcontent">
            <img src="images/denko.png" alt="header-image" class="cld-responsive">

            <h1 class="srheading">Branch Register</h1>
            <form action="branchreg.php" method="post">




                <input type="text" name="txtbrachname" required placeholder="Enter Branch Name">

                <input type="text" name="txtlocation" id="" placeholder="Location"><br>



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
            </form>
        </div>
    </div>
</body>

</html>