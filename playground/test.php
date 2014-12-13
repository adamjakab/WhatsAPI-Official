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
echo "[*]connected\n\n";

//$w->sendGetServerProperties();
//$w->sendClientConfig();

$w->sendPing();
$w->pollMessage();

$w->sendGetGroups();
$w->pollMessage();
$w->pollMessage();

$w->disconnect();
