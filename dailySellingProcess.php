<?php

require "connection.php";
session_start();

$from = $_GET["f"];
$to = $_GET["t"];

$f = strtotime($from);
$t = strtotime($to);

$s = "00:00:00";
$e = "23:59:59";

$fromdate = $from . " " . $s;
$todate = $to . " " . $e;

if (empty($from)) {
    echo "1";
} else if (empty($to)) {
    echo "2";
} else if ($from > $to) {
    echo "2";
} else {



    $invoicers = Database::search("SELECT * FROM `invoice` WHERE `date` BETWEEN '" . $fromdate . "' AND '" . $todate . "' ");
    $in = $invoicers->num_rows;

    if ($in > 1) {
        // $data = $invoicers->fetch_assoc();
        $_SESSION["i1"] = $fromdate;
        $_SESSION["i2"] = $todate;
    }
}
