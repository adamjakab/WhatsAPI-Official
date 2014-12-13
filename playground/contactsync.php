<?php
require_once "../src/whatsprot.class.php";
require_once "./WAAccountData.php";
//Change the time zone if you are in a different country
date_default_timezone_set('Europe/Rome');

$numbers = array();
foreach (WAAccountData::$phonebook as $name => $number) {
    if (substr($number, 0, 1) != "+") {
        $number = "+$number";
    }
    $numbers[] = $number;
}
var_dump($numbers);


/**
 * @param $result SyncResult
 */
function onSyncResult($result) {
    foreach ($result->existing as $number) {
        echo "$number exists<br />";
    }
    foreach ($result->nonExisting as $number) {
        echo "$number does not exist<br />";
    }
    die();//to break out of the while(true) loop
}


// Create a instance of WhastPort
$w = new WhatsProt(
    WAAccountData::$d["username"],
    WAAccountData::$d["identity"],
    WAAccountData::$d["nickname"],
    WAAccountData::$d["debug"]
);

//bind event handler
$w->eventManager()->bind('onGetSyncResult', 'onSyncResult');

$w->connect();
$w->loginWithPassword(WAAccountData::$d["password"]);
echo "[*]connected to WhatsApp\n\n";

//send dataset to server
$w->sendSync($numbers);

//wait for response
while (true) {
    $wa->pollMessage();
}
