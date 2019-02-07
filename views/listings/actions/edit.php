<?php require_once '../../../core/includes.php';

if( !empty($_POST) ){ //check url has id in it}

    $l = new Listing;
    $l->edit();
}

header("Location: /listings/manage.php");
exit();
