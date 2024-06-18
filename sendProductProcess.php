<?php

session_start();

require "connection.php";

$uid = $_SESSION["u"]["email"];

$id = $_GET["id"];


$product = Database::search("SELECT * FROM `product` WHERE `user_email`='".$uid."' AND `id`='".$id."' ");

$n =$product->num_rows;

if($n == 1){
    $row = $product->fetch_assoc();

    $_SESSION["p"] = $row;

    echo "success";

} else {
    echo "Error";
}

?>