<?php

session_start();
require "connection.php";

if (isset($_SESSION["u"])) {
    $uemail = $_SESSION["u"]["email"];

    $total = "0";
    $subTotal = " 0";
    $shipping = "0";
?>

    <!DOCTYPE html>

    <html>

    <head>
        <title>eShop| Cart</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="resources/logo.svg">
        <link rel="stylesheet" href="bootstrap.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="watchlist.css">
    </head>

    <body>
        <div class="container-fluid">
            <div class="row">
                <?php require "headerforWishlist.php"; ?>

                <div class="col-12 pt-2" style="background-color: #E3E5E4;">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Cart</li>
                        </ol>
                    </nav>
                </div>

                <div class="col-12 border border-1 border-secondary rounded mb-3">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label fs-1 fw-bold">Basket <i class="fs-2 bi bi-cart3"></i></label>
                        </div>
                        <div class="col-12 col-lg-6">
                            <hr class="hrbreak">
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 col-lg-6 offset-0 offset-lg-2 mb-3">
                                    <input type="text" class="form-control" placeholder="Search in Cart">
                                </div>
                                <div class="col-12 col-lg-2 d-grid mb-3">
                                    <button class="btn btn-outline-primary">Search</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6">
                            <hr class="hrbreak">
                        </div>

                        <?php

                        $catrs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $uemail . "'");
                        $cn = $catrs->num_rows;

                        if ($cn == 0) {
                        ?>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 emptycart"></div>
                                    <div class="col-12 text-center mb-2">
                                        <label class="form-label fs-1 ">You have no items in your cart</label>
                                    </div>
                                    <div class="offset-0 offset-lg-4 col-lg-4 col-12 d-grid mb-4">
                                        <a href="#" class="btn btn-primary fs-3">Start Shopping</a>
                                    </div>
                                </div>
                            </div>
                        <?php

                        } else {
                        ?>

                            <div class="col-12 col-lg-9">
                                <div class="row">

                                    <?php

                                    for ($i = 0; $i < $cn; $i++) {
                                        $cr = $catrs->fetch_assoc();

                                        $productrs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $cr["product_id"] . "'");
                                        $pr = $productrs->fetch_assoc();

                                        $total = $total + ($pr["price"] * $cr["qty"]);

                                        $addressrs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $uemail . "'");
                                        $ar = $addressrs->fetch_assoc();
                                        $cityid = $ar["city_cid"];

                                        $districtrs = Database::search("SELECT * FROM `city` WHERE `cid`='" . $cityid . "'");
                                        $xr = $districtrs->fetch_assoc();
                                        $districtid = $xr["district_did"];

                                        $ship = "0";

                                        if ($districtid == 2) {
                                            $ship = $pr["delivery_fee_colombo"];
                                            $shipping = $shipping + $pr["delivery_fee_colombo"];
                                        } else {
                                            $ship = $pr["delivery_fee_other"];
                                            $shipping = $shipping + $pr["delivery_fee_other"];
                                        }

                                        // echo $total
                                        $sellers = Database::search("SELECT * FROM `user` WHERE `email`='" . $pr["user_email"] . "' ");
                                        $sn = $sellers->fetch_assoc()

                                    ?>

                                        <!-- card start -->
                                        <div class="card mb-3 mx-0 col-12">
                                            <div class="row g-0">
                                                <div class="col-md-12 mt-3 mb-3">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <span class="fw-bold text-black-50 fs-5">Seller :</span>&nbsp;
                                                            <span class="fw-bold text-black fs-5"><?php echo $sn["fname"] . " " . $sn["lname"] ?></span>&nbsp;
                                                        </div>
                                                    </div>
                                                </div>

                                                <hr>

                                                <?php
                                                $imagers = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $pr["id"] . "' ");
                                                $in = $imagers->num_rows;

                                                $arr;

                                                for ($x = 0; $x < $in; $x++) {
                                                    $ir = $imagers->fetch_assoc();
                                                    $arr[$x] = $ir["code"];
                                                }

                                                ?>

                                                <div class="col-md-4">
                                                    <img style="height: 15rem;" src="<?php echo $ir["code"]?>" class="img-fluid rounded-start d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" title="<?php echo $pr["title"]; ?>" data-bs-content="<?php echo $pr["description"]; ?>" />
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="card-body">
                                                        <h3 class="card-title fw-bold"><?php echo $pr["title"]; ?></h3>
                                                        <?php
                                                        $colur = Database::search("SELECT * FROM `color` WHERE `id`='" . $pr["color_id"] . "' ");
                                                        $c = $colur->fetch_assoc();
                                                        $cond = Database::search("SELECT * FROM `condition` WHERE `id`='" . $pr["condition_id"] . "' ");
                                                        $co = $cond->fetch_assoc();
                                                        ?>
                                                        <span class="fw-bold text-black-50">Colour : <?php echo $c["name"]; ?></span> &nbsp; |
                                                        &nbsp; <span class="fw-bold text-black-50">Condition : <?php echo $co["name"]; ?></span>
                                                        <br>
                                                        <span class="fw-bold text-black-50 fs-5">Price :</span>&nbsp;
                                                        <span class="fw-bold text-black fs-5">Rs.<?php echo $pr["price"]; ?>.00</span>
                                                        <br>
                                                        <span class="fw-bold text-black-50 fs-5">Quantity :</span>&nbsp;
                                                        <input type="number" id="qtyinput" value="<?php echo $cr["qty"] ?>" class="mt-3 border border-2 border-secondary fs-4 fw-bold px-3 cardqtytext">
                                                        <br><br>
                                                        <span class="fw-bold text-black-50 fs-5">Delivery Fee :</span>&nbsp;
                                                        <span class="fw-bold text-black fs-5">Rs.<?php echo $ship ?>.00</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="card-body d-grid">
                                                        <a class="btn btn-outline-success mb-2" onclick="paynow(<?php echo $pr['id'] ?>);">Buy Now</a>
                                                        <a class="btn btn-outline-danger mb-2" onclick="deleteformcart(<?php echo $cr['id']; ?>);">Remove</a>
                                                    </div>
                                                </div>

                                                <hr>

                                                <div class="col-md-12 mt-3 mb-3">
                                                    <div class="row">
                                                        <div class="col-6 col-md-6">
                                                            <span class="fw-bold fs-5 text-black-50">Requested Total <i class="bi bi-info-circle"></i></span>
                                                        </div>
                                                        <div class="col-6 col-md-6 text-end">
                                                            <span class="fw-bold fs-5 text-black-50">Rs.<?php echo ($pr["price"] * $cr["qty"]) + $ship ?>.00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Modal title</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Modal body text goes here.</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- card end -->
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>

                        <?php
                        }

                        ?>

                        <div class="col-12 col-lg-3">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label fw-bold fs-3">Summary</label>
                                </div>
                                <div class="col-12">
                                    <hr>
                                </div>
                                <div class="col-6">
                                    <span class="fs-6 fw-bold">Items (<?php echo $cn; ?>)</span>
                                </div>
                                <div class="col-6 text-end">
                                    <span class="fs-6 fw-bold">Rs.<?php echo $total; ?>.00</span>
                                </div>
                                <div class="col-6">
                                    <span class="fs-6 fw-bold">Shipping</span>
                                </div>
                                <div class="col-6 text-end">
                                    <span class="fs-6 fw-bold">Rs.<?php echo $shipping; ?>.00</span>
                                </div>
                                <div class="col-12 mt-3">
                                    <hr>
                                </div>
                                <div class="col-6 mt-2">
                                    <span class="fs-4 fw-bold">Total</span>
                                </div>
                                <div class="col-6 text-end">
                                    <span class="fs-4 fw-bold">Rs.<?php echo $shipping + $total ?>.00</span>
                                </div>
                                <div class="col-12 mt-3 mb-3 d-grid">
                                    <button class="btn btn-primary fs-5 fw-bold">CHECKOUT</button>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>


                <?php require "footer.php"; ?>

            </div>
        </div>
        <script src="script.js"></script>
        <script src="home.js"></script>
        <script src="https://unpkg.com/@popperjs/core@2"></script>
        <script src="bootstrap.bundle.js"></script>
        <script src="bootstrap.bundle.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript">
            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
            var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
                return new bootstrap.Popover(popoverTriggerEl)
            })
        </script>
        <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
    </body>

    </html>



<?php
}

?>