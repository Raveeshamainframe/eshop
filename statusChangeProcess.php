<?php

require "connection.php";

// $productId = $_GET["p"];
$id = $_GET["p"];

$statusrs = Database::search("SELECT* FROM `product` WHERE `id`='".$id."'");
$sn = $statusrs->num_rows;

if($sn==1){

    $sd = $statusrs->fetch_assoc();

    $statusid = $sd["status_id"];

    if($statusid == 1){
        Database::iud("UPDATE `product` SET `status_id`=2 WHERE `id`='".$id."' ");
        echo "deactive";

    } else if($statusid == 2){
        Database::iud("UPDATE `product` SET `status_id`=1 WHERE `id`='".$id."' ");
        echo "active";
    }
   
}else{

    echo "Cannot Connetc to database";
}

?>