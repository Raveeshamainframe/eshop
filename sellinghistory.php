<?php

session_start();

require "connection.php";

$from = $_GET["f"];
$to = $_GET["t"];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>eShop | Product Selling History </title>

    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
</head>

<body style="background-color: #74EBD5; background-image: linear-gradient(90deg,#74EBD5 0%,#9FACE6 100%);">

    <div class="container-fluid">
        <div class="row">

            <div class="col-12 bg-light text-center rounded ">
                <label for="" class="form-label fs-2 fw-bold text-primary">Product Selling History</label>
            </div>

            <div class="col-12 mt-3 mb-2">
                <div class="row">

                    <div class="col-4 col-lg-2 bg-primary pt-2 pb-2 text-end">
                        <span class="fs-4 fw-bold text-white">Order ID</span>
                    </div>

                    <div class="col-5 col-lg-3 bg-light pt-2 pb-2 d-lg-block">
                        <span class="fs-4 fw-bold">Product</span>
                    </div>

                    <div class="col-3 bg-primary pt-2 pb-2  d-none d-lg-block">
                        <span class="fs-4 fw-bold text-white">Buyer</span>
                    </div>

                    <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block">
                        <span class="fs-4 fw-bold">Price</span>
                    </div>

                    <div class="col-3 col-lg-2 bg-primary pt-2 pb-2 d-lg-block">
                        <span class="fs-4 fw-bold">Quantity</span>
                    </div>


                </div>
            </div>
            <?php
            if (!empty($from) && empty($to)) {
                $fromrs = Database::search("SELECT * FROM `invoice`");
                $fn = $fromrs->num_rows;

                if ($fn > 0) {
                    for ($x = 0; $x < $fn; $x++) {
                        $srow = $fromrs->fetch_assoc();
                        $fromdate = $srow["date"];

                        $splitdate = explode(" ", $fromdate);
                        $date = $splitdate[0];

                        if ($from == $date) {
            ?>
                            <div class="col-12 mb-2">
                                <div class="row">

                                    <div class="col-4 col-lg-2 bg-primary pt-2 pb-2 text-end">
                                        <span class="fs-5 fw-bold text-white"><?php echo $srow["order_id"] ?></span>
                                    </div>

                                    <?php
                                    $productdetails = Database::search("SELECT * FROM `product` WHERE `id`='" . $srow["product_id"] . "' ");
                                    $data = $productdetails->fetch_assoc();

                                    $udetails = Database::search("SELECT * FROM `user` WHERE `email`='" . $srow["user_email"] . "' ");
                                    $udata = $udetails->fetch_assoc();
                                    ?>

                                    <div class="col-5 col-lg-3 bg-light p-2 d-lg-block">
                                        <span class="fs-5 fw-bold"><?php echo $data["title"]; ?></span>
                                    </div>

                                    <div class="col-6 col-lg-3 bg-primary d-none d-lg-block pt-2 pb-2">
                                        <span class="fs-5 fw-bold text-white"><?php echo $udata["fname"] . " " . $udata["lname"]; ?></span>
                                    </div>

                                    <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block">
                                        <span class="fs-5 fw-bold">Rs. <?php echo $srow["total"]; ?>.00</span>
                                    </div>

                                    <div class="col-3 col-lg-2 bg-primary pt-2 pb-2 d-lg-block">
                                        <span class="fs-5 fw-bold text-white"><?php echo $srow["qty"]; ?></span>
                                    </div>

                                </div>
                            </div>


                        <?php
                        }
                    }
                } else {
                    echo "You haven't sell anything today";
                }
            } else if (!empty($from) && !empty($to)) {
                $betweenrs = Database::search("SELECT * FROM `invoice`");
                $bn = $betweenrs->num_rows;

                if ($bn > 0) {

                    for ($x = 0; $x < $bn; $x++) {
                        $srow = $betweenrs->fetch_assoc();

                        $betweendate = $srow["date"];

                        $splitdate = explode(" ", $betweendate);
                        $date = $splitdate[0];

                        if ($from <= $date && $to >= $date) {
                        ?>
                            <div class="col-12 mb-2">
                                <div class="row">

                                    <div class="col-4 col-lg-2 bg-primary pt-2 pb-2 text-end">
                                        <span class="fs-5 fw-bold text-white"><?php echo $srow["order_id"] ?></span>
                                    </div>

                                    <?php
                                    $productdetails = Database::search("SELECT * FROM `product` WHERE `id`='" . $srow["product_id"] . "' ");
                                    $data = $productdetails->fetch_assoc();

                                    $udetails = Database::search("SELECT * FROM `user` WHERE `email`='" . $srow["user_email"] . "' ");
                                    $udata = $udetails->fetch_assoc();
                                    ?>

                                    <div class="col-5 col-lg-3 bg-light p-2 d-lg-block">
                                        <span class="fs-5 fw-bold"><?php echo $data["title"]; ?></span>
                                    </div>

                                    <div class="col-6 col-lg-3 bg-primary d-none d-lg-block pt-2 pb-2">
                                        <span class="fs-5 fw-bold text-white"><?php echo $udata["fname"] . " " . $udata["lname"]; ?></span>
                                    </div>

                                    <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block">
                                        <span class="fs-5 fw-bold">Rs. <?php echo $srow["total"]; ?>.00</span>
                                    </div>

                                    <div class="col-3 col-lg-2 bg-primary pt-2 pb-2 d-lg-block">
                                        <span class="fs-5 fw-bold text-white"><?php echo $srow["qty"]; ?></span>
                                    </div>

                                </div>
                            </div>
                        <?php

                        }
                    }
                } else {
                    echo "You haven't sell anything today";
                }
            } else if (empty($from) && empty($to)) {
                $todayrs = Database::search("SELECT * FROM `invoice`");
                $tn = $todayrs->num_rows;

                if ($tn > 0) {

                    for ($x = 0; $x < $tn; $x++) {
                        $srow = $todayrs->fetch_assoc();

                        $nodate = $srow["date"];

                        $splitdate = explode(" ", $nodate);
                        $date = $splitdate[0];

                        $today = date("Y-m-d");

                        if ($date == $today) {
                        ?>
                            <div class="col-12 mb-2">
                                <div class="row">

                                    <div class="col-4 col-lg-2 bg-primary pt-2 pb-2 text-end">
                                        <span class="fs-5 fw-bold text-white"><?php echo $srow["order_id"] ?></span>
                                    </div>

                                    <?php
                                    $productdetails = Database::search("SELECT * FROM `product` WHERE `id`='" . $srow["product_id"] . "' ");
                                    $data = $productdetails->fetch_assoc();

                                    $udetails = Database::search("SELECT * FROM `user` WHERE `email`='" . $srow["user_email"] . "' ");
                                    $udata = $udetails->fetch_assoc();
                                    ?>

                                    <div class="col-5 col-lg-3 bg-light p-2 d-lg-block">
                                        <span class="fs-5 fw-bold"><?php echo $data["title"]; ?></span>
                                    </div>

                                    <div class="col-6 col-lg-3 bg-primary d-none d-lg-block pt-2 pb-2">
                                        <span class="fs-5 fw-bold text-white"><?php echo $udata["fname"] . " " . $udata["lname"]; ?></span>
                                    </div>

                                    <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block">
                                        <span class="fs-5 fw-bold">Rs. <?php echo $srow["total"]; ?>.00</span>
                                    </div>

                                    <div class="col-3 col-lg-2 bg-primary pt-2 pb-2 d-lg-block">
                                        <span class="fs-5 fw-bold text-white"><?php echo $srow["qty"]; ?></span>
                                    </div>

                                </div>
                            </div>

            <?php

                        }
                    }
                } else {
                    echo "You haven't sell anything today";
                }
            }

            ?>




            <!-- <div class="col-12 justify-content-center d-flex mt-3 mb-3">
                <div class="pagination">
                    <a href="#">&laquo;</a>
                    <a href="#">1</a>
                    <a href="#" class="active">2</a>
                    <a href="#">3</a>
                    <a href="#">4</a>
                    <a href="#">5</a>
                    <a href="#">6</a>
                    <a href="#">&raquo;</a>
                </div>
            </div> -->

            <?php require "footer.php" ?>
        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>