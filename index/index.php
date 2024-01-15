<!DOCTYPE html>
<html>
<head>
<script src="index.js"></script>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IndustroServe API | ASP - OPCTurkey</title>
     <link rel="icon" type="image/png" href="../assets/icon.png">

     <link rel="stylesheet" type="text/css" href="index.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

<?php   

if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    if (isset($_POST['username']) && isset($_POST['password'])) {
        include '../db/database.php';
        if (check_credentials($_POST['username'], $_POST['password'])) {
            session_start();
            
            function generateSessionToken() {
                return bin2hex(random_bytes(32));  
            }
            $sessionToken = generateSessionToken();
            $_SESSION['session_token'] = $sessionToken;
            $_SESSION['session_token2'] = $sessionToken."seed:3333";

            header('Location: ../panel/panel.php');
            exit;
        } else {
            echo "<script>display_error();</script>";           
        }
    }
} 
?>


<div id="loading-screen">
        <img id="loading-icon" src="../assets/icon.png" alt="Loading...">
    </div>
    <header>
        <img src='../assets/logo.gif'>
</header>
<div class="login-container">
        <h2><i class="fa-solid fa-right-to-bracket"></i> Login</h2>
         
    </div>
</body>
</html>