<?php

require_once '../../../core/includes.php';

    // Add new reno to db
    $l = new Listing;
    $l->add();

header("Location: /listings/view.php");
