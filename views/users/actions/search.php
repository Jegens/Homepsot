<?php require_once '../../../core/includes.php';

$u = new User;
$users = $u->get_all();

echo json_encode($users);
exit();
