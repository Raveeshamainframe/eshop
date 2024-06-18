<?php

session_start();
require "connection.php";

if (isset($_SESSION["u"])) {

    $id = $_GET["id"];
    $qty = $_GET["qty"];
    $umail  = $_SESSION["u"]["email"];

    $array;

    $orderId = uniqid();

    $productrs = Database::search("SELECT * FROM `product` WHERE `id`='" . $id . "'");
    $pr = $productrs->fetch_assoc();

    $cityrs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $umail . "' ");
    $cn = $cityrs->num_rows;

    // $cityid;
    // $add;

    if ($cn == 1) {

        $cr = $cityrs->fetch_assoc();


        $cityid = $cr["city_cid"];
        $add = $cr["line1"] . " , " . $cr["line1"];

        $districtrs = Database::search("SELECT * FROM `city` WHERE `cid`='" . $cityid . "' ");
        $dr = $districtrs->fetch_assoc();

        $districtid = $dr["district_did"];
        $delivery = "0";

        if ($districtid == "2") {
            $delivery = $pr["delivery_fee_colombo"];
        } else {
            $delivery = $pr["delivery_fee_other"];
        }

        $item = $pr["title"];
        $amount = (int) $pr["price"] * (int)$qty + (int)$delivery;

        $fname = $_SESSION["u"]["fname"];
        $lname = $_SESSION["u"]["lname"];
        $mobile = $_SESSION["u"]["mobile"];
        $address = $add;
        $city = $dr["cname"];

        $array['id']=$orderId;
        $array['item']=$item;
        $array['amount']=$amount;
        $array['fname']=$fname;
        $array['lname']=$lname;
        $array['email']=$umail;
        $array['mobile']=$mobile;
        $array['address']=$address;
        $array['city']=$city;

        echo json_encode($array);

    } else {
        echo "2";
    }

} else {

    echo "1";

}

?>