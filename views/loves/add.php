<?php require_once '../../core/includes.php';
// header('Content-Type: application/json'); //converts data to JsonSerializable
$love_data = array(
    'error' => true
);

if( !empty($_POST['listing_id']) ){ //listing_id sent

    //Add new love to db
    $l = new Love;
    $love_data = $l->add($love_data);
}

echo json_encode($love_data);

die();
