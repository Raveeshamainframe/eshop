<?php

session_start();

require "connection.php";

if (isset($_SESSION["u"])) {

    $oid = $_POST["oid"];
    $pid = $_POST["pid"];
    $email = $_POST["email"];
    $total = $_POST["total"];
    $qty = $_POST["qty"];

    $productrs = Database::search("SELECT * FROM `product` WHERE `id`='" . $pid . "'");
    $pn = $productrs->fetch_assoc();

    $nowQty =  $pn["qty"];

    $newQty = $nowQty - $qty;

    Database::iud("UPDATE `product` SET `qty`='" . $newQty . "' WHERE `id`='" . $pid . "' ");

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    Database::iud("INSERT INTO `invoice` (`order_id`,`product_id`,`user_email`,`date`,`qty`,`total`) VALUES ('" . $oid . "','" . $pid . "','" . $email . "','" . $date . "','" . $qty . "','" . $total . "')");

    echo "1";
}

?>