<?php
include('dbconnect.php');

session_start();
if(isset($_POST['submit'])){
    
    $staffname = $_POST['txtsuppliername'];
    $nrc = $_POST['txtnrc'];
    $phonenumber = $_POST['txtphonenumber'];
    $address = $_POST['txtaddress'];
    $img1 = $_FILES['photo1']['name'];
    $folder = 'Images/';
    $photo = $folder ."_". $img1;
    $copy=move_uploaded_file($_FILES['photo1']['tmp_name'], $photo);
     if (!$copy){
         echo "<p>Cannot Upload</p>";
     }
    $checkNRC="SELECT * FROM suppliertb where SupplierNRC='$nrc'";
    $answer= mysqli_query($connect,$checkNRC);
   $count= mysqli_num_rows($answer);
   if ($count>0)
  {
      if($answer){
      echo "<script>window.alert('NRC Already exist')</script>" ;
      echo "<script>window.location='SupplierReg.php'</script>" ;
      }
  
  }
  else
  {
    $sql = "INSERT INTO suppliertb(SupplierName,SupplierNRC,SupplierAddress,SupplierPNumber,SupplierPhoto) VALUES('$staffname','$nrc','$address','$phonenumber','$photo')";
    $result=mysqli_query($connect,$sql);
    if($result){
        echo "<script>alert('Data inserted successfully')</script>";
}
}  
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register of suppliers</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="srbody">
    <div class="srcontainer">

        <div class="srcontent">

            <div class="staffcon">
                <div class="staffreg">
                    <h1 class="srheading">Supplier Register</h1>
                    <form action="SupplierReg.php" method="post" enctype="multipart/form-data">



                        <input type="text" name="txtsuppliername" placeholder="Enter Supplier Name" required><br>



                        <input type="text" name="txtnrc" placeholder=" Supplier NRC" required><br>

                        <input type="text" name="txtaddress" placeholder=" Supplier Address" required><br>





                        <input type="number" name="txtphonenumber" placeholder=" Supplier Number" required>



                        <input type="file" name="photo1" required>


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