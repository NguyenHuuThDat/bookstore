<?php 
    $host = "localhost";
    $dbname = "Bookstore";
    $user = "root";
    $pass = "";

    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Stripe Secret_Key
    $secret_key = "sk_test_51Q1r3U04BuTMBXtcv8Qnue4EuiIy32h04OI9TatLWLs0vgGIboC2dMqEcf1BgORgK3EOnYO620DXjeFn55tvgX8U004A4MoPvI";

/*
    if($conn) {
        echo "worked successfully";
    } else {
        echo "error in db connection";
    }
*/