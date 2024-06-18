<?php
require "connection.php";
$pageno;
?>


<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>eShop | Product Selling History </title>
        <link rel="icon" href="resources/logo.svg" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
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

                if (isset($_GET["page"])) {
                    $pageno = $_GET["page"];
                } else {
                    $pageno = 1;
                }


                $productrs = Database::search("SELECT * FROM `invoice` ");
                $d = $productrs->num_rows;
                $row = $productrs->fetch_assoc();
                $result_per_page = 10;
                $number_of_pages = ceil($d / $result_per_page);
                $page_first_result = ((int)$pageno - 1) * $result_per_page;
                $selectedrs = Database::search("SELECT * FROM `invoice` LIMIT " . $result_per_page . " OFFSET " . $page_first_result . " ");
                $srn = $selectedrs->num_rows;

                ?>


                <div class="col-12 mb-2">
                    <div class="row">

                        <?php
                        while ($srow = $selectedrs->fetch_assoc()) {

                        ?>

                            <div class="col-4 col-lg-2 bg-primary pt-2 pb-2 text-end mt-1">
                                <span class="fs-5 fw-bold text-white"><?php echo $srow["order_id"]; ?></span>
                            </div>

                            <?php
                            $productdetails = Database::search("SELECT * FROM `product` WHERE `id`='" . $srow["product_id"] . "' ");
                            $data = $productdetails->fetch_assoc();

                            $udetails = Database::search("SELECT * FROM `user` WHERE `email`='" . $srow["user_email"] . "' ");
                            $udata = $udetails->fetch_assoc();
                            ?>

                            <div class="col-5 col-lg-3 bg-light p-2 d-lg-block mt-1">
                                <span class="fs-5 fw-bold"><?php echo $data["title"]; ?></span>
                            </div>

                            <div class="col-6 col-lg-3 bg-primary d-none d-lg-block pt-2 pb-2 mt-1">
                                <span class="fs-5 fw-bold text-white"><?php echo $udata["fname"] . " " . $udata["lname"]; ?></span>
                            </div>

                            <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block mt-1">
                                <span class="fs-5 fw-bold">Rs. <?php echo $srow["total"]; ?>.00</span>
                            </div>

                            <div class="col-3 col-lg-2 bg-primary pt-2 pb-2 d-lg-block mt-1">
                                <span class="fs-5 fw-bold text-white"><?php echo $srow["qty"]; ?></span>
                            </div>


                        <?php
                        }
                        ?>

                        <!-- pagination -->
                        <div class="col-12 text-center fs-5 fw-bold mt-2">
                            <div class="pagination">
                                <a href="<?php if ($pageno <= 1) {
                                                echo "#";
                                            } else {
                                                echo "?page=" . ($pageno - 1);
                                            }
                                            ?>">
                                    &laquo;</a>
                                <?php
                                for ($page = 1; $page <= $number_of_pages; $page++) {
                                    if ($page == $pageno) {
                                ?>
                                        <a class="active ms-1" href="<?php echo "?page=" . ($page); ?>"><?php echo $page; ?></a>
                                    <?php
                                    } else {
                                    ?>
                                        <a class="ms-1" href="<?php echo "?page=" . ($page); ?>"><?php echo $page; ?></a>
                                <?php
                                    }
                                }
                                ?>


                                <a href="<?php
                                            if ($pageno >= $number_of_pages) {
                                                echo "#";
                                            } else {
                                                echo "?page=" . ($pageno + 1);
                                            }
                                            ?>">&raquo;
                                </a>
                            </div>
                        </div>
                        <!-- pagination -->



                    </div>
                </div>



                <?php require "footer.php" ?>
            </div>
        </div>

        <script src="script.js"></script>
        <script src="bootstrap.js"></script>
        <script src="bootstrap.bundle.js"></script>
    </body>

    </html>
