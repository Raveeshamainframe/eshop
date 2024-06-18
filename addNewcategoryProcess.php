<?php

session_start();

require "connection.php";

if(isset($_SESSION["a"])){

    $text = $_GET["t"];

    if(empty($text)){
        echo "You must enter a category.";
    } else {
        $categoryrs = Database::search("SELECT * FROM `category` WHERE `name` = '%".$text."%' ");
        $n = $categoryrs->num_rows;

        if($n == 1){
            echo "The category already exists.";
        }else{
            Database::iud("INSERT INTO `category` (`name`) VALUES ('".$text."') ");
            echo "sucess";
        }
    }
}

?>