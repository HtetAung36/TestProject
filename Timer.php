<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="Style.css">
</head>
<body>
    <div class="Tcontainer">
        <h1>Still Count Down ten Minute</h1>
    <p><p>
    <span id="countdown">5</span>sec</p>


    </div>
   
    <script>
var seconds=5;
function UpdateCountDown()

{
    document.getElementById('countdown').textContent=seconds;
    seconds--;
    if (seconds<0){
        window.location.href='login.php';
    }
}

setInterval(UpdateCountDown,1000);

</script>

</body>
</html>