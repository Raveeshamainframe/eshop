<?php

session_start();

require "connection.php";

if (isset($_SESSION["u"])) {
    $umail = $_SESSION["u"];
    $oid = $_GET["id"];
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>eShop | Invoice</title>
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="singleproductview.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
        <link rel="icon" href="resources/logo.svg" />
    </head>

    <body class="mt-2" style="background-color: #f7f7ff;">

        <div class="container-fluid">
            <div class="row">

                <?php require "headerforWishlist.php" ?>

                <div class="col-12">
                    <hr />
                </div>

                <div class="col-12 btn-toolbar justify-content-end">
                    <button class="btn btn-dark me-2" onclick="printinvoice();"><i class="bi bi-printer-fill"></i> Print</button>
                    <button class="btn btn-danger me-2"><i class="bi bi-file-earmark-pdf-fill"></i> Save as PDF</button>
                </div>

                <div class="col-12">
                    <hr />
                </div>

                <div class="col-12" id="page">
                    <div class="row">
                        <div class="col-6">
                            <div class="invoiceheaderimg"></div>
                        </div>

                        <div class="col-6">
                            <div class="row">
                                <div class="col-12 text-end text-decoration-underline text-primary">
                                    <h2>eShop</h2>
                                </div>

                                <div class="col-12 text-end fw-bold">
                                    <span>Maradana, Colombo 10, Sri Lanka</span><br />
                                    <span>+94 7601821354</span><br />
                                    <span>eShop@gmail.com</span>
                                </div>

                            </div>
                        </div>

                        <div class="col-12">
                            <hr class="border border-1 border-primary" />
                        </div>

                        <div class="col-12 mb-4">
                            <div class="row">

                                <div class="col-6">
                                    <?php

                                    $addressrs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $umail["email"] . "'");
                                    $ar = $addressrs->fetch_assoc();

                                    ?>
                                    <h5>INVOICE TO : </h5>
                                    <h2><?php echo $_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"]; ?></h2>
                                    <span><?php echo $ar["line1"] . "," . $ar["line2"] ?></span>
                                    <br />
                                    <span><?php echo $umail["email"] ?></span>
                                </div>

                                <?php
                                $invoicers = Database::search("SELECT * FROM `invoice` WHERE `order_id`='".$oid."'");
                                $in = $invoicers->num_rows;
                                $ir = $invoicers->fetch_assoc();
                                ?>

                                <div class="col-6 text-end mt-4">
                                    <h1 class="text-primary">INVOICE <?php echo $ir["id"] ?></h1>
                                    <span class="fw-bold">Date and Time of Invoice &nbsp; :</span> &nbsp;
                                    <span class="fw-bold"><?php echo $ir["date"] ?></span>
                                </div>


                            </div>
                        </div>

                        <div class="col-12">

                            <table class="table">

                                <thead>
                                    <tr class="border border-1 border-white">

                                        <th>#</th>
                                        <th>Order Id & Product</th>
                                        <th class="text-end">Unit Price</th>
                                        <th class="text-end">Qty</th>
                                        <th class="text-end">Total</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php

                                    $subtotal="0";

                                    for ($i = 0; $i < $in; $i++) {

                                        $irs = $invoicers->fetch_assoc();
                                        $pid = $ir["product_id"];

                                        $subtotal = $subtotal + $ir["total"];

                                        $productrs = Database::search("SELECT * FROM `product` WHERE `id` ='" . $pid . "'");
                                        $pr = $productrs->fetch_assoc();

                                    ?>

                                        <tr style="height: 72px;">

                                            <td class="bg-primary text-white fs-3"><?php echo $ir["id"]; ?></td>

                                            <td>

                                                <span class="fw-bold p-2"><?php echo $ir["order_id"]; ?></span>
                                                <br />
                                                <span class="fw-bold fs-3 p-2"><?php echo $pr["title"]; ?></span>

                                            </td>
                                            <td class="fs-6 text-end pt-3" style="background-color: ggb(199,199,199);"> <?php echo $pr["price"]; ?> </td>

                                            <td class="fs-6 text-end pt-3"><?php echo $ir["qty"]; ?></td>

                                            <td class="fs-6 text-end bg-primary text-white">Rs. <?php echo $ir["total"]; ?>.00</td>

                                        </tr>
                                    <?php
                                    }
                                    ?>



                                </tbody>

                                <tfoot>
                                    <tr>

                                        <td colspan="2" class="border-0"></td>
                                        <td colspan="2" class="FS-5 text-end">SUBTOTAL</td>
                                        <td colspan="2" class="text-end">Rs.<?php echo $subtotal ?>.00</td>

                                    </tr>
                                    <tr>

                                        <td colspan="2" class="border-0"></td>
                                        <td colspan="2" class="FS-5 text-end border-primary">Discount</td>
                                        <td colspan="2" class="text-end fs-5 border-primary">Rs . 00 . 00</td>

                                    </tr>

                                    <tr>

                                        <td colspan="2" class="border-0"></td>
                                        <td colspan="2" class="FS-5 text-end border-primary">GRAND TOTAL</td>
                                        <td colspan="2" class="text-end fs-5 border-primary">Rs. <?php echo $ir["total"]; ?>.00</td>

                                    </tr>

                                </tfoot>

                            </table>

                        </div>

                        <div class="col-4 text-center" style="margin-top: -100px; margin-bottom : 50px;">
                            <span class="fs-1">Thank You !</span>
                        </div>

                        <div class="col-12 mt-3 mb-3 border border-start border-end-0 border-top-0 border-bottom-0 border-5 border-primary rounded" style="background-color: #e7f2ff;">

                            <div class="row">
                                <div class="col-12 mt-3 mb-3">
                                    <lable class="form-lable fs-5 fw-bold">NOTICE :</lable>
                                    <lable class="form-lable fs-5">Purchased items can return befor 7 days of delivery</lable>
                                </div>
                            </div>

                        </div>

                        <div class="col-12">
                            <hr class="border border-1 border-primary" />
                        </div>

                        <div class="col-12 mb-3 text-center">
                            <lable class="form-lable fs-6 text-black-50">
                                Invoice was created on a computer and is valid without the Signature and Seal
                            </lable>
                        </div>

                    </div>
                </div>

                <?php require "footer.php" ?>

            </div>
        </div>

        <script src="script.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="bootstrap.js"></script>
        <script src="bootstrap.bundle.js"></script>
    </body>

    </html>

<?php
}
?>