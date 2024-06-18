<?php

session_start();

require "connection.php";

if(isset($_SESSION["u"])){

    $mail = $_SESSION["u"]["email"];

    $id = $_POST["i"];
    $txt = $_POST["ft"];

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    Database::iud("INSERT INTO `feedback` (`user_email`,`product_id`,`feed`,`DATE`) VALUES ('".$mail."','".$id."','".$txt."','".$date."')");

    echo "1";

}


?>