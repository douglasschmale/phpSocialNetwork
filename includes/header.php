<?php

require 'config/config.php';


if(isset($_SESSION['username'])) {
    $userloggedin = $_SESSION['username'];
    $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username = '$userloggedin'");
    $user = mysqli_fetch_array($user_details_query);
} else {
    header("Location: register.php");
}

?>
<html>
<head>
    <title>Welcome to Steel Pulse!</title>
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato|Oswald" rel="stylesheet">
    <!-- js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <!-- css -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class = "top_bar">
        <div class = "logo">

        
        <a href="index.php">Steel Pulse</a>
        </div>
        <nav>
            <a href="#"><?php echo $user['username']; ?></a>
            <a href="index.php"><i class="fas fa-dumbbell fa-lg"></i></a>
            <a href=""><i class="fas fa-envelope fa-lg"></i></a>
            <a href=""><i class="fas fa-concierge-bell fa-lg"></i></a>
            <a href=""><i class="fas fa-users fa-lg"></i></a>
            <a href=""><i class="fas fa-cog fa-lg"></i></a>
        </nav>
    </div>

    <div class = 'wrapper'>