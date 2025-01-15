<?php

include('dbconnect.php');
$PCode=$_GET['PCode'];

    $Delete="DELETE FROM petrol where PetrolCode='$PCode'";
    $query=mysqli_query($connect,$Delete);

    if ($query){
       
        echo "<script>window.alert('Successfully Deleted')</script>";
        echo "<script>window.location='petrol.php'</script>";
    }
    else{
      
            echo "<script>window.alert('Something went wrong')</script>";
            echo "<script>window.location='petrol.php'</script>";
        }
    


?>