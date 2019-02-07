<?php

// For functionality like checking if a user is an admin before page is loaded

if( empty($_SESSION['user_logged_in']) ){ // If not logged in

    $util = new Util;

    // Allowed logged out functionality
    $allowed_urls = array(
        '/',
        '/listings/index.php',
        '/users/index.php',
        '/users/signup.php',
        '/users/login.php'
    );

    $allowed = false;
    $message = "You must be logged in to access this page";

    foreach($allowed_urls as $allowed_url) {
        if( $_SERVER['REQUEST_URI'] == $allowed_url || $_SERVER['REQUEST_URI'] == $util->startsWith($_SERVER['REQUEST_URI'], '/listings') || $_SERVER['REQUEST_URI'] == $util->startsWith($_SERVER['REQUEST_URI'], '/users') ){
            $allowed = true;
            break;
        }
    }

    if( $allowed === false ){
        echo "<script type='text/javascript'>alert('$message');;
        window.location.href='/users/login.php';</script>";
    }

}else{ // If user is logged in

    // Set users TimeZone
    $u = new User;
    $user = $u->get_by_id($_SESSION['user_logged_in']);

}
