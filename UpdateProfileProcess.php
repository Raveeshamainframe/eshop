<?php
session_start();

require "connection.php";

if (isset($_SESSION["u"])) {

    $fname = $_POST["f"];
    $lname = $_POST["l"];
    $mobile = $_POST["m"];
    $line1 = $_POST["a1"];
    $line2 = $_POST["a2"];
    $city = $_POST["c"];

    if (isset($_FILES["i"])) {
        $image = $_FILES["i"];
    } else {
    }
    // validate
    if (empty($fname)) {
        echo "Please Enter Your First Name";
    } elseif (empty($lname)) {
        echo "Please Enter Your Last Name";
    } else if (empty($mobile)) {
        echo "Please Enter Your Mobile Number";
    } else if (strlen($mobile) != 10) {
        echo "Please enter 10 digit mobile number";
    } else if (preg_match("/07[0,1,2,4,5,6,7,8][0-9]+/", $mobile) == 0) {
        echo "Invalid mobile number";
    } else {



        Database::iud("UPDATE `user` SET 
    `fname`='" . $fname . "',
    `lname`='" . $lname . "',
    `mobile`='" . $mobile . "'
     WHERE `email`='" . $_SESSION["u"]["email"] . "' ");

        $resultset = Database::search("SELECT * FROM `user` WHERE `email`='" . $_SESSION["u"]["email"] . "' ");

        $details = $resultset->fetch_assoc();
        $_SESSION["u"] = $details;

        // echo "User Table Update";

        $addressrs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $_SESSION["u"]["email"] . "' ");
        $nr = $addressrs->num_rows;

        if ($nr == 1) {

            Database::iud("UPDATE `user_has_address` SET `line1`='" . $line1 . "',`line2`='" . $line2 . "',`city_cid`='" . $city . "' WHERE `user_email`='" . $_SESSION["u"]["email"] . "'  ");
        } else {

            Database::iud("INSERT INTO `user_has_address` (`user_email`,`line1`,`line2`,`city_cid`) VALUES 
        ('" . $_SESSION["u"]["email"] . "','" . $line1 . "','" . $line1 . "','" . $city . "') ");
        }

        $resultProfileImg = Database::search("SELECT * FROM `prof_img` WHERE `user_email`='" . $_SESSION["u"]["email"] . "'  ");
        $pror = $resultProfileImg->num_rows;

        if ($pror == 1) {


            if (isset($_FILES["i"])) {
                $allowed_image_extention = array("image/jpeg", "image/jpg", "image/png", "image/svg");
                $file_extention = $image["type"];

                if (!in_array($file_extention, $allowed_image_extention)) {
                    echo "Please Select a valid image.";
                } else {

                    $newimgextention;
                    if ($file_extention = "image/jpeg") {
                        $newimgextention = ".jpeg";
                    } elseif ($file_extention = "image/jpg") {
                        $newimgextention = ".jpg";
                    } elseif ($file_extention = "image/png") {
                        $newimgextention = ".png";
                    } elseif ($file_extention = "image/svg") {
                        $newimgextention = ".svg";
                    }

                    $filename = "resources//profiles//" . uniqid() . $newimgextention;

                    move_uploaded_file($image["tmp_name"], $filename);

                    Database::iud("UPDATE `prof_img` SET `code`='" . $filename . "' WHERE `user_email`='" . $_SESSION["u"]["email"] . "'  ");
                }
            } else {
            }
        } else {

            if (isset($_FILES["i"])) {
                $allowed_image_extention = array("image/jpeg", "image/jpg", "image/png", "image/svg");
                $file_extention = $image["type"];

                if (!in_array($file_extention, $allowed_image_extention)) {
                    echo "Please Select a valid image.";
                } else {

                    $newimgextention;
                    if ($file_extention = "image/jpeg") {
                        $newimgextention = ".jpeg";
                    } elseif ($file_extention = "image/jpg") {
                        $newimgextention = ".jpg";
                    } elseif ($file_extention = "image/png") {
                        $newimgextention = ".png";
                    } elseif ($file_extention = "image/svg") {
                        $newimgextention = ".svg";
                    }

                    $filename = "resources//profiles//" . uniqid() . $newimgextention;

                    move_uploaded_file($image["tmp_name"], $filename);

                    Database::iud("INSERT INTO `prof_img` (`code`,`user_email`) VALUES ('" . $filename . "','" . $_SESSION["u"]["email"] . "') ");
                }
            } else {
            }
        }
        echo "Update SuccessFully";
    }
} else {

    echo "Update (Error) Please Check";
}
