<?php

require "connection.php";

if (isset($_GET["id"])) {
    $pid = $_GET["id"];

    $product = Database::search("SELECT * FROM `product` WHERE `id`= '" . $pid . "' ");
    $pn = $product->num_rows;

    if ($pn == 1) {
        $pd = $product->fetch_assoc();
    }

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>eShop | Single Product View</title>
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="singleproductview.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
        <link rel="icon" href="resources/logo.svg" />
    </head>

    <body>

        <div class="container-fluid">
            <div class="row">
                <?php
                require "header.php";
                ?>

                <div class="col-12 mt-0 singleproduct">
                    <div class="row">
                        <div class="bg-white" style="padding: 11px;">
                            <div class="row">
                                <div class="col-lg-2 order-lg-1 order-2">

                                    <ul>

                                        <?php
                                        $imagers = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $pid . "' ");
                                        $in = $imagers->num_rows;
                                        $img1;
                                        $d = $imagers->fetch_assoc();
                                        ?>

                                        <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary">
                                            <img src="<?php echo $d["code"] ?>" height="150px" width="200px" id="pimg<?php echo "1"; ?>" onclick="loadmainimg(<?php echo '1'; ?>);" class="mt-1 mb-1" />
                                        </li>
                                        <?php
                                        if ($d["code2"] == "resources//singleproduct//cam.svg") {
                                        ?>
                                            <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary">
                                                <img src="<?php echo $d["code2"] ?>" height="150px" class="mt-1 mb-1" />
                                            </li>
                                        <?php
                                        } else {
                                        ?>
                                            <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary">
                                                <img src="<?php echo $d["code2"] ?>" height="150px" width="200px" id="pimg<?php echo "2"; ?>" onclick="loadmainimg(<?php echo '2'; ?>);" class="mt-1 mb-1" />
                                            </li>
                                        <?php
                                        }
                                        if ($d["code2"] == "resources//singleproduct//cam.svg") {
                                        ?>
                                            <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary">
                                                <img src="<?php echo $d["code3"] ?>" height="150px" class="mt-1 mb-1" />
                                            </li>
                                        <?php
                                        } else {
                                        ?>
                                            <li class="d-flex flex-column justify-content-center align-items-center border border-1 border-secondary">
                                                <img src="<?php echo $d["code3"] ?>" height="150px" width="200px" id="pimg<?php echo "3"; ?>" onclick="loadmainimg(<?php echo '3'; ?>);" class="mt-1 mb-1" />
                                            </li>
                                        <?php
                                        }
                                        ?>

                                    </ul>
                                </div>
                                <div class="col-lg-4 order-2 order-lg-1 d-none d-lg-block">
                                    <div class="align-items-center border border-1 border-secondary p-3">
                                        <div id="mainimg" style="background-image: url('<?php echo $d["code"]; ?>'); background-repeat: no-repeat; background-size: contain; height: 420px;"></div>
                                    </div>
                                </div>

                                <div class="col-lg-6 order-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <nav>
                                                <ol class="d-flex flex-wrap mb-0 list-unstyled bg-white rounded">
                                                    <li class="breadcrumb-item">
                                                        <a href="#">Home</a>
                                                    </li>
                                                    <li class="breadcrumb-item">
                                                        <a href="#" class="text-black-50 text-decoration-none">Single View</a>
                                                    </li>
                                                </ol>
                                            </nav>

                                            <div class="row">
                                                <div class="col-12">
                                                    <lable class="form-lable fs-4 fw-bold mt-0"><?php echo $pd["title"] ?></lable>
                                                </div>
                                            </div>

                                            <div class="col-12 mt-1">
                                                <span class="badge badge-success">
                                                    <i class="fa fa-star mt-1 text-warning fs-6"></i>
                                                    <lable class="text-dark fs-6">4.5 star</lable>
                                                    <lable class="text-dark fs-6">35 | 35 Rating & Reviews</lable>
                                                </span>
                                            </div>

                                            <div class="col-12 d-inline-block">
                                                <?php
                                                $p1 = ($pd["price"] / 100) * 105;
                                                ?>
                                                <lable class=" fw-bold mt-1 fs-4">Rs.<?php echo $pd["price"] ?>.00</lable>
                                                <lable class=" fw-bold mt-1 fs-4 text-danger"><del>Rs. <?php echo $p1 ?></del></lable>
                                            </div>

                                            <hr class="hrbreak1" />

                                            <div class="col-12">
                                                <lable class="text-primary fs-6"><b>Warrenty : </b></lable><br />
                                                <lable class="text-primary fs-6"><b>Return Policy : </b> 01 months policy</lable><br />
                                                <lable class="text-primary fs-6"><b>In stock : </b><?php echo $pd["qty"] ?> items left</lable>
                                            </div>

                                            <hr class="hrbreak1" />

                                            <div class="col-12">
                                                <label class="text-dark fs-3 fw-bold">Seller Deatails</label><br />
                                                <?php
                                                $userrs = Database::search("SELECT * FROM `user` WHERE `email`='" . $pd["user_email"] . "' ");
                                                $userd = $userrs->fetch_assoc();
                                                ?>
                                                <label class="text-success fs-6"><?php echo $userd["fname"] . " " . $userd["lname"] ?></label><br />
                                                <label class="text-success fs-6"><?php echo $userd["email"] ?></label><br />
                                                <label class="text-success fs-6"><?php echo $userd["mobile"] ?></label>
                                            </div>

                                            <hr class="hrbreak1" />

                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-lg-8 rounded border border-1 border-success mt-1 pt-2">
                                                        <div class="row">
                                                            <div class="col-md-3 col-sm-3 col-lg-1">
                                                                <img src="resources/singleproduct/pricetag.png" height="70%" />
                                                            </div>
                                                            <div class="col-md-9 col-sm-9 mt-1 pe-4 col-lg-11">
                                                                <lable class="mt-2">Stand a chance to get instant 5% discount by isng VISA.</lable>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mt-2">
                                                        <a href="messages.php?email=<?php echo $userd["email"]; ?>" class="btn btn-secondary">Contact Seller</a>
                                                    </div>
                                                </div>
                                            </div>

                                            <hr class="hrbreak1" />

                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-md-6" style="margin-top: 15px;">
                                                        <div class="row">
                                                            <div class="border border-1 border-secondary rounded overflow-hidden float-start product_qty mt-1 position-relative">
                                                                <div class="col-12">
                                                                    <span>Qty :</span>
                                                                    <input id="qtyinput" class="border-0 fs-6 fw-bold text-start" type="text" pattern="[0-9]" value="1" />
                                                                    <div class="position-absolute qty_button">
                                                                        <div class="d-flex fles-column align-items-center border border-1 border-secondary qty_inc">
                                                                            <i class="fas fa-chevron-up" onclick='qty_inc(<?php echo $pd["qty"] ?>)'></i>
                                                                        </div>
                                                                        <div class="d-flex fles-column align-items-center border border-1 border-secondary qty_dec">
                                                                            <i class="fas fa-chevron-down" onclick="qty_dec()"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 mt-1">
                                                                <div class="row">

                                                                    <div class="col-4 col-lg-5 d-grid">
                                                                        <button class="btn btn-primary">Add to card</button>
                                                                    </div>

                                                                    <div class="col-4 col-lg-5 d-grid">
                                                                        <button class="btn btn-success" type="submit" id="payhere-payment" onclick="paynow(<?php echo $pid; ?>);">Buy Now</button>
                                                                    </div>

                                                                    <div class="col-4 col-lg-2 d-grid">
                                                                        <i class="fas fa-heart mt-1 fs-4"></i>
                                                                    </div>

                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-12 bg-white">
                            <div class="row d-block me-0 mt-4 mb-3 border border-1 border-start-0 border-end-0 border-top-0 border-primary">
                                <div class="col-md-6">
                                    <span class="fs-3 fw-bold">Related Items</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 bg-white">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row p2" style="text-align: justify;">
                                        <?php
                                        $number = 4;

                                        $brandrs = Database::search("SELECT * FROM `product` WHERE `model_has_brand_id`='" . $pd["model_has_brand_id"] . "' ");
                                        $bdn = $brandrs->num_rows;

                                        for ($x = 0; $x < $bdn; $x++) {
                                            $bd = $brandrs->fetch_assoc();
                                            $imageOfProduct = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $bd["id"] . "' ");
                                            $imagerow = $imageOfProduct->fetch_assoc();

                                        ?>
                                            <div class="card me-1" style="width: 18rem;">
                                                <img src="<?php echo $imagerow["code"] ?>" class="card-img-top" alt="..." style="width: 15rem; height:15rem;">
                                                <div class="card-body">
                                                    <h5 class="card-title"><?php echo $bd["title"] ?></h5>
                                                    <p class="card-text">Rs.<?php echo $bd["price"] ?>.00</p>
                                                    <a href="#" class="btn btn-primary fsm2">Add cart</a>
                                                    <a href="#" class="btn btn-primary fsm2">Buy Now</a>
                                                    <a href="#" class="mt-2 fs-6"><i class="fas fa-heart mt-1 fs-4 text-black-50"></i></a>
                                                </div>
                                            </div>
                                        <?php
                                        }

                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php

                        $deatails = Database::search("SELECT * FROM model_has_brand WHERE `id`='" . $pd["model_has_brand_id"] . "' ");
                        $dt = $deatails->num_rows;
                        if ($dt == 1) {
                            $dts = $deatails->fetch_assoc();
                            $bname = Database::search("SELECT * FROM brand WHERE `id`='" . $dts["brand_id"] . "' ");
                            $dts2 = $bname->fetch_assoc();

                            $mname = Database::search("SELECT * FROM model WHERE `id`='" . $dts["model_id"] . "' ");
                            $dts3 = $mname->fetch_assoc();
                        } else {
                        }

                        ?>


                        <div class="col-12 bg-white">
                            <div class="row d-block me-0 mt-4 mb-3 border border-1 border-start-0 border-end-0 border-top-0 border-primary">
                                <div class="col-md-6">
                                    <span class="fs-3 fw-bold">Product Details</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 bg-white">
                            <div class="row">

                                <div class="col-12">

                                    <div class="row">

                                        <div class="col-2 col-md-1">
                                            <lable class="form-lable fw-bold">Brand :</lable>
                                        </div>

                                        <div class="col-10 col-lg-11">
                                            <lable class="form-lable"><?php echo $dts2["name"] ?></lable>
                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-2 col-md-1">
                                            <lable class="form-lable fw-bold">Model :</lable>
                                        </div>

                                        <div class="col-10 col-lg-11">
                                            <lable class="form-lable"><?php echo $dts3["name"] ?></lable>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="row">

                                        <div class="col-12 col-md-1">
                                            <lable class="form-lable fw-bold">Description :</lable>
                                        </div>

                                        <div class="col-12 col-md-1">
                                            <textarea class="form-lable" disabled><?php echo $pd["description"] ?></textarea>
                                        </div>

                                    </div>
                                </div>


                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-12 bg-white">
                    <div class="row d-block me-0 mt-4 mb-3 border border-1 border-start-0 border-end-0 border-top-0 border-primary">
                        <div class="col-md-6">
                            <span class="fs-3 fw-bold">Feedbacks</span>
                        </div>
                    </div>
                </div>

                <?php

                $feedbackrs = Database::search("SELECT * FROM `feedback` WHERE `product_id`='" . $pid . "'");
                $feed = $feedbackrs->num_rows;

                if ($feed == 0) {
                ?>
                    <label class="form-lable fs-3 text-black-50 text-center">There are no feedbacks to view.</label>
                <?php
                } else {
                ?>
                    <div class="col-12">
                        <div class="row">

                            <?php
                            for ($a = 0; $a < $feed; $a++) {
                                $feedrow = $feedbackrs->fetch_assoc();
                            ?>

                                <div class="col-12 col-md-4 p-3">
                                    <div class="row">
                                        <div class="col-12  border border-1 border-danger rounded">
                                            <div class="row">

                                                <div class="col-12">
                                                    <span class="fs-5 text-primary fw-bold"><?php echo $feedrow["user_email"]  ?></span>
                                                </div>
                                                <div class="col-12">
                                                    <span class="text-dark"><?php echo $feedrow["feed"]  ?></span>
                                                </div>

                                                <div class="col-12 text-end">
                                                    <span class="fs-6 text-black-50"><?php echo $feedrow["date"]  ?></span>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php

                            }
                            ?>
                        </div>
                    </div>
                <?php
                }
                ?>

                <?php require "footer.php" ?>
            </div>

        </div>


        <script src="script.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="bootstrap.js"></script>
        <script src="bootstrap.bundle.js"></script>
        <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
    </body>

    </html>

<?php
}
?>