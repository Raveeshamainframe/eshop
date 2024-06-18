<?php

require "connection.php";

if(isset($_POST["e"])){
    $email = $_POST["e"];
    $userrs = Database::search("SELECT * FROM `user` WHERE `email`='".$email."' ");
    $num = $userrs->num_rows;

    if($num == 1){
        $row = $userrs->fetch_assoc();
        $us = $row["status_id"];

        if($us == "1"){
            Database::iud("UPDATE `user` SET `status_id`='2' WHERE `email`='".$email."' ");
            echo "success1";
        } else{
            Database::iud("UPDATE `user` SET `status_id`='1' WHERE `email`='".$email."' ");
            echo "success2";
        }
    }
}
