<?php
include('dbconnect.php');

if (isset($_GET['PCode'])){


    $PCode=$_GET['PCode'];

        $query="select * from petrol where PetrolCode='$PCode'";
        $result=mysqli_query($connect,$query);
        $fetcharray=mysqli_fetch_array($result);
       $PCode= $fetcharray['PetrolCode'];
       $PName= $fetcharray['PetrolName'];
       $PPrice=$fetcharray['Priceperlitres'];
       

}
if (isset($_POST['btnupdate']))

{ 
    $PName=$_POST['txtPName'];
    $PCode=$_POST['PCode'];
   $PPrice=$_POST['txtPPrice'];
    $update="UPDATE petrol set PetrolName='$PName',Priceperlitres='$PPrice' where PetrolCode='$PCode'";
    $result=mysqli_query($connect,$update);
    if ($result){
        echo "<script>window.alert('Petrol price Successfully Update.')</script>";
        echo "<script>window.location='petrol.php'</script>";
    }
    else{
      
        echo "<script>window.alert('Something went wrong')</script>";
        
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Petrol</title>
    <link rel="stylesheet" type="text/css" href="Astyle.css">
</head>
<body>

<div class="container-form">
        <form action="UpdatePetrol.php" method="POST" >
            <h1>Update petrol info</h1>
            <div class="form-group">
            <label for="">Petrol Name :</label><br>
            
            <input type="text" name="txtPName" placeholder="Enter Petrol Name" required />

            <label for="">Petrol price :</label><br>
            
            <input type="text" name="txtPPrice" placeholder="Enter Petrol Price" required />

        </div>
           
<div class="form-group">
<input type="hidden" name="PCode" value="<?php echo $PCode; ?>">
</div>
            <button type="submit" name="btnupdate">Update</button>

        </form>

    </div>
    
</body>
</html>