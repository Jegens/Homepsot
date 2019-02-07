<?php require_once '../../../core/includes.php';

$l = new Listing;
$listings = $l->get_all();

echo json_encode($listings);
exit();
