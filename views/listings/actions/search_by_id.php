<?php require_once '../../../core/includes.php';

$l = new Listing;
$listings = $l->get_all_by_user_id($_SESSION['user_logged_in']);

echo json_encode($listings);
exit();
