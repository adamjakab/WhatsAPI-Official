<?php
require_once "../src/whatsprot.class.php";
require_once "./WAAccountData.php";
//Change the time zone if you are in a different country
date_default_timezone_set('Europe/Rome');

// Create a instance of WhastPort
$w = new WhatsProt(
    WAAccountData::$d["username"],
    WAAccountData::$d["identity"],
    WAAccountData::$d["nickname"],
    WAAccountData::$d["debug"]
);
$w->connect();
$w->loginWithPassword(WAAccountData::$d["password"]);
echo "[*]connected to WhatsApp\n\n";

$w->sendGetServerProperties();
$w->sendClientConfig();

$target = WAAccountData::$phonebook["ERIKA"];

for ($i=1; $i<=5; $i++) {
    $message = 'TEST #'.$i;
    $w->sendMessage($target , $message);
}
