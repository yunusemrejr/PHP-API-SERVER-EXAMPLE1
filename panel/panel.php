<?php

 
/**
 * Copyright (c) 2024 by YUNUS EMRE VURGUN
 * Programmed in January 2024, this is the GITHUB FREE EDITION of this software, some parts are modified.
 */


 
// strt the session (if not already started)
session_start();

// chk if the session token is set
if (isset($_SESSION['session_token'])) {
    $sessionToken = $_SESSION['session_token'];
    $sessionToken2 = $_SESSION['session_token2'];


    // validate the user based on the session token
    if ($sessionToken === str_replace("seed:3333", "", $sessionToken2)) {
        // User is valid, proceed with displaying the panel
     } else {
        // BAD session token, redirect or show an error message
         header('Location: ../index/index.php');

    }
} else {
    // sess token not set, redirect or show an error message
     header('Location: ../index/index.php');

}
?>


<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="panel.js"></script>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IndustroServe API | ASP - OPCTurkey</title>
     <link rel="icon" type="image/png" href="../assets/icon.png">

     <link rel="stylesheet" type="text/css" href="panel.css">

 </head>
<body>

<div id="loading-screen">
        <img id="loading-icon" src="../assets/icon.png" alt="Loading...">
    </div>
    <header>
        <img src='../assets/panellogo.png'>
</header>
<div class="login-container">
        <h2><i class="fa-solid fa-gear"></i> Service Options:</h2><br><br>

        <section class='radios'>
   <h3><i class="fa-solid fa-filter"></i> Data Content Type</h3>
   <input type="radio" id="Topic1" name="options" checked>
    <label class='radio-label' for="Topic1" ><i class="fa-solid fa-gears"></i>Topic1</label>

    <input type="radio" id="Topic2" name="options">
    <label class='radio-label' for="Topic2"><i class="fa-solid fa-cloud-showers-heavy"></i>Topic2</label>

    <input type="radio" id="Topic3" name="options">
    <label class='radio-label' for="Topic3"><i class="fa-solid fa-solar-panel"></i>Topic3</label>
    
</section><br><br>

        <section class='toggles'>
   <h3><i class="fa-solid fa-clock"></i> Fast Update (ON/OFF)<span style='font-size:12px;'> *only for GET</span></h3>
        <div class="toggle-container">
        <label class="toggle-label" for="toggle-checkbox">
            <input type="checkbox" id="toggle-checkbox">
            <div class="toggle-switch"></div>
        </label>
    </div>
</section><br><br>

   <section class='toggles'>
   <h3><i class="fa-solid fa-power-off"></i> API Engine (ON/OFF)</h3>
        <div class="toggle-container">
        <label class="toggle-label" for="toggle-checkbox2">
            <input type="checkbox" id="toggle-checkbox2">
            <div class="toggle-switch"></div>
        </label>
    </div>
</section>

<section id="url-output">
<textarea readonly="readonly" onfocus="this.blur()">
   
</textarea>
<button class="copy-button" onclick="copyText()">Copy</button>

</section>

    </div>
</body>
</html>