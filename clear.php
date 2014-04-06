<?php

include('vendor/autoload.php');

$database = new \ChatApp\Database();

$database->clearAllRecords('messages');

header( "Location: ./" );