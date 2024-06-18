<?php
require "connection.php";

$category = $_POST["c"];
$brand = $_POST["b"];
$model = $_POST["m"];
$title = $_POST["t"];
$condition = (int)$_POST["co"];
$colour = (int)$_POST["col"];
$qty = (int)$_POST["qty"];
$price = (int)$_POST["p"];
$dwc = (int)$_POST["dwc"];
$doc = (int)$_POST["doc"];
$description = $_POST["desc"];
// $imageFile = $_FILES["img"];

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

$state = 1;

$useremail = "vidhura.n.neethika@gmail.com";

if ($category == "0") {
    echo "Please Select a Category";
} else if ($brand == "0") {
    echo "Please Select a Brand";
} else if ($model == "0") {
    echo "Please Select a Model";
} else if (empty($title)) {
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
    $modelHasBrand = Database::search("SELECT `id` FROM `model_has_brand` WHERE `brand_id`='" . $brand . "' AND `model_id`='" . $model . "' ");

    if ($modelHasBrand->num_rows == 0) {
        echo "The Product Doesn't Exist";
    } else {
        $f = $modelHasBrand->fetch_assoc();
        $modelHasBrandID = $f["id"];

        Database::iud("INSERT INTO `product`(`category_id`,`model_has_brand_id`,`title`,`color_id`,`price`,`qty`,`description`,`condition_id`,`status_id`,`user_email`,`datetime_added`,`delivery_fee_colombo`,`delivery_fee_other`) VALUES('" . $category . "','" . $modelHasBrandID . "','" . $title . "','" . $colour . "','" . $price . "','" . $qty . "','" . $description . "','" . $condition . "','" . $state . "','" . $useremail . "','" . $date . "','" . $dwc . "','" . $doc . "')");

        echo "Product added successfully";

        $last_id = Database::$connection->insert_id;

        $imageFile = $_FILES["img"];

        if (isset($_FILES["img"])) {

            $fileName = "resources//products//" . uniqid() . ".png";
            move_uploaded_file($imageFile["tmp_name"], $fileName);
        } else {
            echo "Please select an image";
        }

        if (isset($_FILES["img2"])) {

            $imageFile2 = $_FILES["img2"];
            $fileName2 = "resources//products//" . uniqid() . ".png";
            move_uploaded_file($imageFile2["tmp_name"], $fileName2);
        } else {
            $fileName2 = "resources//singleproduct//cam.svg";
        }

        if (isset($_FILES["img3"])) {

            $imageFile3 = $_FILES["img3"];
            $fileName3 = "resources//products//" . uniqid() . ".png";
            move_uploaded_file($imageFile3["tmp_name"], $fileName3);
        } else {
            $fileName3 = "resources//singleproduct//cam.svg";
        }

        Database::iud("INSERT INTO `images`(`code`,`product_id`,`code2`,`code3`) VALUES('" . $fileName . "','" . $last_id . "','".$fileName2."','".$fileName3."' ) ");
        echo "Image Saved Successfully";


    }
}
