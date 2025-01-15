<?php
    session_start();
    include('dbconnect.php');
    if(!isset($_SESSION['CID']) ){

      echo "<script>window.alert('Please login first.You can again book and recent book will be deleted.')</script>";
      echo "<script>window.location='login.php'</script>";
     
  }
$CID= $_SESSION['CID'];
      $CUName =$_SESSION['CUName'] ; 
     
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account information</title>
    <link rel="stylesheet" href="css/Usytle.css">
</head>
<body>

  <div id="phone">
    <p id="phone-speaker"></p>
    <div id="phone-screen">
      <header>
        <p id="menu">
          <svg class="pointer" width="24px" height="24px" viewBox="0 0 24 24" fill="none">
            <defs>
              <linearGradient id="MenuGradient">
                <stop offset="5%" stop-color="#AEDD9A" />
                <stop offset="95%" stop-color="#44B973" />
              </linearGradient>
            </defs>
            <path d="M3 12H15M3 6H21M3 18H21" stroke="url(#MenuGradient)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
          </svg>
        </p>
        <p id="title">Profile</p>
        <p id="settings">
          <svg class="pointer" width="24px" height="24px" fill="none" viewBox="0 0 24 24" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
          </svg>
          <span></span>
        </p>
      </header>
      <div id="content">
        <img id="avatar" width="100" height="100" src="img/img1.jpg" alt="Brad Pitt">
        <svg width="142px" height="142px" viewBox="0 0 24 24" fill="none" id="avatar-svg">
          <defs>
            <linearGradient id="AvatarGradient">
              <stop offset="5%" stop-color="#AEDD9A" />
              <stop offset="95%" stop-color="#44B973" />
            </linearGradient>
          </defs>
          <path d="M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C14.8273 3 17.35 4.30367 19 6.34267" stroke="url(#AvatarGradient)" stroke-width="0.5" stroke-linecap="round"></path>
        </svg>
        <p id="user-name"><?php echo $CUName; ?></p>
        <p id="user-profession">Welcome</p>
        <div id="user-general-values">
          <p class="pointer">
            <?php
            $sql = "SELECT COUNT(*) FROM orders WHERE CustomerID = '$CID'";
            $result = mysqli_query($connect, $sql);
            $row = mysqli_fetch_row($result);
            echo "<span>".$row[0]."</span>";
            ?>
            <span>Orders</span>
	    	  </p>
          
        </div>
        <div id="group-btn">
          <a href="UpdateCustomer.php"><p class="btn pointer" id="follow-btn">Update</p></a>
          
        </div>
        <div id="socials">
          <svg class="pointer" width="40px" height="40px" viewBox="-20 0 190 190" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M90.62 147.24H88.87C88.68 139.97 88.44 129.53 88.31 120.85L99.97 120.62L102.19 107.62L88.25 108.62C88.5 97.9998 90.47 95.9998 97.37 95.9998C99.53 95.9998 101.75 95.9998 103.22 95.9998V82.4798C99.3782 81.9721 95.5049 81.7415 91.63 81.7898C77.43 81.7898 73 90.6598 73 108.25V109.59L65.83 110.08L65.73 121.28L72.97 121.14C72.97 130.38 72.89 140.14 72.86 146.98C66.75 146.85 60.72 146.72 55.86 146.72C37.55 146.72 32.58 135.89 32.58 122.12C32.58 108.35 32.85 93.1198 32.85 87.8998C32.85 72.4298 39.7 63.8398 56.68 63.8398C62.96 63.8398 86.58 63.7798 94.62 63.7798C110.07 63.7798 117.48 70.1598 117.48 88.8398C117.48 93.4498 117.14 102.08 117.14 126.01C117.11 141.06 110 147.24 90.62 147.24Z"></path>
          </svg>
          
          <svg class="pointer" width="40px" height="40px" viewBox="-20 0 190 190" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M90.62 147.24C80.3 147.24 65.62 146.72 55.83 146.72C37.52 146.72 32.55 135.89 32.55 122.12C32.55 108.35 32.82 93.1198 32.82 87.8998C32.82 72.4298 39.67 63.8398 56.65 63.8398C62.93 63.8398 86.55 63.7798 94.59 63.7798C110.04 63.7798 117.45 70.1598 117.45 88.8398C117.45 93.4498 117.11 102.08 117.11 126.01C117.11 141.06 110 147.24 90.62 147.24ZM75.12 83.6898C46.3 83.6898 44.91 127.55 75.61 127.55C103.65 127.55 103.83 83.6898 75.12 83.6898ZM101.17 74.9998C92.84 74.9998 92.44 87.6098 101.32 87.6098C109.42 87.5898 109.48 74.9998 101.17 74.9998Z"></path>
          </svg>
          
          <svg class="pointer" width="40px" height="40px" viewBox="-20 0 190 190" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M75.67 137.53C29.59 137.53 28.87 136.41 28.87 104.6C28.87 74.1802 29.18 73.4902 74.74 73.4902C120.3 73.4902 121.13 74.1302 121.13 105.59C121.13 137.05 121.74 137.53 75.67 137.53ZM63 90.3902L63.48 123.22L93.06 105.6L63 90.3902Z"></path>
          </svg>
        </div>
      </div>
    </div>
    <p id="phone-btn"></p>
  </div>

</body>
</html>