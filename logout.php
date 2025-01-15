<?php
 
session_start();
 
unset($_SESSION['SID']);
 
session_destroy();
 
if (isset($_SESSION['SID'])) {
	echo "Error";
}
else{
	echo "<script>window.alert('Logout Successful')</script>";
echo "<script>window.location='index.php'</script>";
}
 
 
?>