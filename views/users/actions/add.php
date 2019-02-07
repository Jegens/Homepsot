<?php

require_once '../../../core/includes.php';


$_SESSION = array(); // Empty session and start fresh

if( !empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['password']) && !empty($_POST['email']) ){

    $u = new User;

    // CHECK TO SEE IF USER ALREADY EXISTS
    $exists = $u->exists();

    if( empty($exists) ){ // USER DOES NOT EXIST
        $new_user_id = $u->add();
        $_SESSION['user_logged_in'] = $new_user_id;

        header("Location: /users/edit.php");
        exit();

    }else{
        $_SESSION['create_acc_msg'] = '<p class="user-error-message">*** Email already in use ***</p>';
        $_SESSION['remember_first_name'] = $_POST['first_name']; // REMEMBERS FIRST NAME IN CASE OF SIGN UP ERROR
        $_SESSION['remember_last_name'] = $_POST['last_name']; // REMEMBERS LAST NAME IN CASE OF SIGN UP ERROR

        header("Location: /users/signup.php?signup_error=true");
        exit();
    }
}
