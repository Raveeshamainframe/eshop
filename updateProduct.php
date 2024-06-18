<?php

session_start();

require "connection.php";

$product = $_SESSION["p"];

if (isset($product)) {
?>

    <!DOCTYPE html>

    <html>

    <head>

        <title>eShop|Update Product</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="resources/logo.svg" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="addproduct.css" />

    </head>


    <body>

        <div class="container-fluid">
            <div class="row gy-3">

                <!-- heading -->
                <div id="addproductbox">
                    <div class="col-12 mb-2">
                        <h3 class="h2 text-center text-primary">Update Product</h3>
                    </div>
                    <!-- heading -->

                    <!-- category,brand,nodel -->

                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-12 col-lg-4">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label lbl1">Select Product Category</label>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <select class="form-select" id="ca">
                                            <?php
                                            $rs1 = Database::search("SELECT * FROM `category` WHERE `id`='" . $product["category_id"] . "'  ");
                                            $cat = $rs1->fetch_assoc();
                                            ?>
                                            <option value="<?php echo $cat["id"] ?>"><?php echo $cat["name"] ?></option>
                                            <?php
                                            $rss1 = Database::search("SELECT * FROM `category` WHERE `id`!='" . $product["category_id"] . "'  ");
                                            $n1 = $rss1->num_rows;

                                            for ($i = 1; $i <= $n1; $i++) {
                                                $catt = $rss1->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $catt["id"] ?>"><?php echo $catt["name"] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label lbl1">Select Product Brand</label>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <select class="form-select" id="br">
                                            <?php
                                            $r2 = Database::search("SELECT * FROM `model_has_brand` WHERE `id`='" . $product["model_has_brand_id"] . "'  ");
                                            $mhb = $r2->fetch_assoc();
                                            $rss2 = Database::search("SELECT * FROM `brand` WHERE `id`='" . $mhb["brand_id"] . "'  ");
                                            $brand = $rss2->fetch_assoc();
                                            ?>
                                            <option value="<?php echo $brand["id"] ?>"><?php echo $brand["name"] ?></option>
                                            <?php

                                            $rs2 = Database::search("SELECT * FROM `brand` WHERE `id`!='" . $mhb["brand_id"] . "' ");
                                            $n2 = $rs2->num_rows;

                                            for ($i = 1; $i <= $n2; $i++) {
                                                $br = $rs2->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $br["id"] ?>"><?php echo $br["name"] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label lbl1">Select Product Model</label>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <select class="form-select" id="mo">
                                            <?php
                                            $rs3 = Database::search("SELECT * FROM `model` WHERE `id`='" . $mhb["model_id"] . "'  ");
                                            $model = $rs3->fetch_assoc();
                                            ?>
                                            <option value="<?php echo $model["id"] ?>"><?php echo $model["name"] ?></option>
                                            <?php
                                            $rss3 = Database::search("SELECT * FROM `model` WHERE `id`!='" . $mhb["model_id"] . "'  ");
                                            $n3 = $rss3->num_rows;

                                            for ($i = 1; $i <= $n3; $i++) {
                                                $mod = $rss3->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $mod["id"] ?>"><?php echo $mod["name"] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- category,brand,nodel -->

                    <hr class="hrbreak1" />

                    <!-- title -->

                    <div class="col-12">
                        <div class="row">
                            <div class="col-12">
                                <label class="form-label lbl1">Add a Title to your Product</label>
                            </div>
                            <div class="offset-lg-2 col-12 col-lg-8">
                                <input class="form-control" type="text" id="ti" value="<?php echo $product["title"]  ?>" />
                            </div>
                        </div>
                    </div>

                    <!-- title -->

                    <hr class="hrbreak1" />

                    <!-- condition,color,qtv -->

                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 col-lg-4">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-lable lbl1">Select Product Condition</label>
                                    </div>
                                    <?php
                                    $cond = $product["condition_id"];
                                    $rs4 = Database::search("SELECT * FROM `condition` WHERE `id`='" . $cond . "'  ");
                                    $cond = $rs4->fetch_assoc();
                                    ?>
                                    <div class="offset-1 col-11 col-lg-3 ms-5 form-check">
                                        <input class="form-check-input" type="radio" value="<?php echo $cond["id"] ?>" name="flexRadioDefault" id="bn" checked>
                                        <label class="form-check-label" for="bn">
                                            <?php echo $cond["name"] ?>
                                        </label>
                                    </div>
                                    <?php
                                    $cond = $product["condition_id"];
                                    $rss4 = Database::search("SELECT * FROM `condition` WHERE `id`!='" . $cond . "'  ");
                                    $n4 = $rss4->num_rows;

                                    for ($i = 1; $i <= $n4; $i++) {
                                        $cond2 = $rss4->fetch_assoc();
                                    ?>
                                        <div class="offset-1 col-11 col-lg-3 ms-5 form-check">
                                            <input class="form-check-input" type="radio" value="<?php echo $cond2["id"] ?>" name="flexRadioDefault" id="us">
                                            <label class="form-check-label" for="us">
                                                <?php echo $cond2["name"] ?>
                                            </label>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-lable lbl1">Select Product Colour</label>
                                    </div>
                                    <?php
                                    $colorId = $product["color_id"];
                                    $rs5 = Database::search("SELECT * FROM `color` WHERE `id`='" . $colorId . "'  ");
                                    $colr = $rs5->fetch_assoc();
                                    $aid = 1;
                                    ?>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                <input class="form-check-input" type="radio" name="clorRadio" value="<?php echo $colr["id"] ?>" id="<?php echo "clr" . $aid; ?>" checked>
                                                <label class="form-check-label" for="<?php echo "clr" . $aid; ?>">
                                                    <?php echo $colr["name"] ?>
                                                </label>
                                            </div>

                                            <?php
                                            $colorId = $product["color_id"];
                                            $rss5 = Database::search("SELECT * FROM `color` WHERE `id`!='" . $colorId . "'  ");
                                            $n5 = $rss5->num_rows;

                                            $aid = $aid + 1;

                                            for ($i = 1; $i <= $n5; $i++) {
                                                $colr2 = $rss5->fetch_assoc();
                                            ?>

                                                <div class="offset-1 offset-lg-0 col-5 col-lg-4 form-check">
                                                    <input class="form-check-input" type="radio" name="clorRadio" value="<?php echo $colr2["id"] ?>" id="<?php echo "clr" . $aid; ?>">
                                                    <label class="form-check-label" for="<?php echo "clr" . $aid; ?>">
                                                        <?php echo $colr2["name"] ?>
                                                    </label>
                                                </div>

                                            <?php
                                                $aid = $aid + 1;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-lable lbl1">Add Product Quantity</label>
                                        <input class="form-control" type="number" value="<?php echo $product["qty"] ?>" min="" id="qty" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- condition,color,qtv -->

                    <hr class="hrbreak1" />

                    <!-- cost,payment method -->

                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label lbl1">Cost per Item</label>
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Rs.</span>
                                        <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" value="<?php echo $product["price"] ?>" id="cost">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label lbl1">Approved Payment Methods</label>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="offset-2 col-2 pm1"></div>
                                            <div class="col-2 pm2"></div>
                                            <div class="col-2 pm3"></div>
                                            <div class="col-2 pm4"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- cost,payment method -->

                    <hr class="hrbreak1" />

                    <!-- delivery cost -->

                    <div class="col-12 col-lg-6">
                        <div class="row">
                            <div class="col-12">
                                <label class="form-label lbl1">Delivery Cost</label>
                            </div>
                            <div class="offset-lg-1 col-12 col-lg-3 mt-lg-3">
                                <label class="form-label">Delivery Cost Within Colombo</label>
                            </div>
                            <div class="col-12 col-lg-7 mt-lg-3">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Rs.</span>
                                    <input type="text" class="form-control" value="<?php echo $product["delivery_fee_colombo"] ?>" aria-label="Amount (to the nearest dollar)" id="dwc">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="row">
                            <div class="col-12">
                                <label class="form-label lbl1"></label>
                            </div>
                            <div class="offset-lg-1 col-12 col-lg-3 mt-lg-3">
                                <label class="form-label">Delivery Cost Out of Colombo</label>
                            </div>
                            <div class="col-12 col-lg-7 mt-lg-3">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Rs.</span>
                                    <input type="text" value="<?php echo $product["delivery_fee_other"] ?>" class="form-control" aria-label="Amount (to the nearest dollar)" id="doc">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- delivery cost -->

                    <hr class="hrbreak1" />

                    <!-- description -->

                    <div class="col-12">
                        <div class="row">
                            <div class="col-12">
                                <label class="form-label lbl1">Product Description</label>
                            </div>
                            <div class="col-12">
                                <textarea class="form-control" cols="100" rows="30" style="background-color: ghostwhite;" id="desc"><?php echo $product["description"] ?></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- description -->

                    <!-- product img -->



                    <div class="col-12">
                        <div class="row">
                            <div class="col-12">
                                <label class="form-label lbl1">Add Product Image</label>
                            </div>
                            <?php
                            $rs6 = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $product["id"] . "'  ");
                            $n6 = $rs6->num_rows;
                            $imge = $rs6->fetch_assoc();
                            if ($n6 == 1) {
                            ?>
                                <img class="col-4 col-lg-2 ms-2 img-thumbnail" id="prev" src="<?php echo $imge["code"] ?>" />
                            <?php
                            } else {
                            ?>
                                <img class="col-4 col-lg-2 ms-2 img-thumbnail" id="prev" src="resources/addproductimg.svg" />
                            <?php
                            }
                            ?>
                            <div class="col-12 mb-3">
                                <div class="row">
                                    <div class="col-12 col-lg-6 mt-2">
                                        <div class="row">
                                            <div class="col-12 col-lg-6">
                                                <input class="d-none" type="file" accept="img/*" id="imguploader" />
                                                <label class="btn btn-primary col-4 col-lg-8" for="imguploader" onclick="changeImage();">Upload</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- product img -->

                    <hr class="hrbreak1" />

                    <!-- notice -->

                    <div class="col-12">
                        <label class="form-label lbl1">Notice...</label>
                        <br />
                        <label class="form-label">We are taking 5% of the product price from every product as a service charge</label>
                    </div>

                    <!-- notice -->

                    <!-- save btn -->
                    <div class="col-12">
                        <div class="row">
                            <!-- <div class="offset-0 offset-lg-4 col-12 col-lg-4 d-grid">
                                <button class="btn btn-success searchbtn" onclick="changeproductview();">Add Product</button>
                            </div> -->
                            <div class="col-12 col-lg-4 mt-2 mt-lg-0 d-grid">
                                <button class="btn btn-dark searchbtn" onclick='updateproduct(<?php echo $product["id"] ?>);'>Update Product</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script src="updateproduct.js"></script>
        <script src="bootstrap.bundle.js"></script>
    </body>

    </html>

<?php
} else {
}
?>