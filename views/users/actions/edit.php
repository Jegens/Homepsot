<?php require_once '../../../core/includes.php';

$u = new User;

if( !empty($_POST) ){ // Form was submitted
    $u->edit();
    $user = $u->get_by_id($_SESSION['user_logged_in']);
}

header('Location: /users/edit.php');
exit();
