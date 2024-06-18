<?php
session_start();

require "connection.php";

$uid = $_SESSION["u"]["email"];

if (isset($_POST["id"])) {

    $pid = $_POST["id"];
    $category = $_POST["c"];
    $brand = $_POST["b"];
    $model = $_POST["m"];
    $title = $_POST["t"];
    $condition = $_POST["co"];
    $colour = $_POST["col"];
    $qty = (int)$_POST["qty"];
    $price = (int)$_POST["p"];
    $dwc = (int)$_POST["dwc"];
    $doc = (int)$_POST["doc"];
    $description = $_POST["desc"];

    if (isset($_FILES["img"])) {
        $image = $_FILES["img"];
    } else {
    }

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");


    if (empty($title)) {
        echo "Please Add a Title.";
    } else if (strlen($title) > 100) {
        echo "Title Must Contain 100 or Less than 100 Characters.";
    } else if ($qty == "0" || $qty == "e") {
        echo "Please Add the Quantity of Your Product.";
    } else if (!is_int($qty)) {
        echo "Please Add a Valid Quantity";
    } else if (empty($qty)) {
        echo "Please Add the Quantity of your Product";
    } else if ($qty < 0) {
        echo "Please Add a Valid Quantity";
    } else if (empty($price)) {
        echo "Please insert the price of your product";
    } else if (!is_int($price)) {
        echo "Please insert a valid price";
    } else if (empty($dwc)) {
        echo "Please  enter the delivery cost within Colombo";
    } else if (!is_int($dwc)) {
        echo "Please insert a valid price";
    } else if (empty($doc)) {
        echo "Please  enter the delivery cost out of Colombo";
    } else if (!is_int($doc)) {
        echo "Please insert a valid price";
    } else if (empty($description)) {
        echo "Please enter the description of your product";
    } else {

        $modelhasbrandId = Database::search("SELECT * FROM `product` WHERE `id`='" . $pid . "' ");
        $mhbi = $modelhasbrandId->fetch_assoc();

        Database::iud("UPDATE `model_has_brand` SET `brand_id`='" . $brand . "',`model_id`='" . $model . "' WHERE `id`='" . $mhbi["model_has_brand_id"] . "'  ");

        Database::iud("UPDATE `product` SET `category_id`='" . $category . "',`title`='" . $title . "' ,`color_id`='" . $colour . "',`price`='" . $price . "',`qty`='" . $qty . "',`description`='" . $description . "',`condition_id`='" . $condition . "',`datetime_added`='" . $date . "',`delivery_fee_colombo`='" . $dwc . "',`delivery_fee_other`='" . $doc . "' WHERE `id`='" . $pid . "' ");

        $product = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $uid . "' AND `id`='" . $pid . "' ");

        $n = $product->num_rows;

        if ($n == 1) {
            $row = $product->fetch_assoc();

            $_SESSION["p"] = $row;
            echo "Product updated successfully";
        } else {
            echo "Error";
        }

    }
} else {
    echo "Product Does not Exit";
}

if (isset($_FILES["img"])) {


    $allowed_image_extention = array("image/jpeg", "image/jpg", "image/png", "image/svg");
    $file_extention = $image["type"];

    if (!in_array($file_extention, $allowed_image_extention)) {
        echo "Please Select a valid image.";
    } else {
        // echo $imageFile["name"];

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

        $filename = "resources//products//" . uniqid() . $newimgextention;

        move_uploaded_file($image["tmp_name"], $filename);
        $resultProfileImg = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $pid . "'  ");
        $pror = $resultProfileImg->num_rows;

        if ($pror == 1) {

            Database::iud("UPDATE `images` SET `code`='" . $filename . "' WHERE `product_id`='" .  $pid . "'  ");

            echo "Image Saved Successfully.";
        } else {
            Database::iud("INSERT INTO `images` (`code`,`product_id`) VALUES ('" . $filename . "','" . $last_product_id . "') ");
        }
    }
}
