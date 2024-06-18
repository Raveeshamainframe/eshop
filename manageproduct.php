<?php
require "connection.php";
?>

<!DOCTYPE html>

<html>

<head>
    <title>eShop | Admin | Manage Product</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="sellproductview.css" />
</head>

<body style="background-color: #74EBD5;background-image: linear-gradient(90deg,#74EBD5 0%,#9FACE6 100%);min-height: 100vh;">

    <div class="container-fluid">
        <div class="row">

            <div class="col-12 bg-light text-center rounded">
                <label class="form-label fs-2 fw-bold text-primary">Manage All Products</label>
            </div>
            <div class="col-12 bg-light rounded">
                <div class="row">
                    <div class="offset-0 offset-lg-3 col-12 col-lg-6 mb-3">
                        <div class="row">
                            <div class="col-9">
                                <input type="text" class="form-control" id="searchtext" onkeyup="searchUser();" />
                            </div>
                            <div class="col-3">
                                <button class="btn btn-primary" onclick="searchUser();">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-3 mb-2">
                <div class="row">

                    <div class="col-2 col-lg-1 bg-primary pt-2 pb-2 text-end">
                        <span class="fs-4 fw-bold text-white">#</span>
                    </div>

                    <div class="col-2 col-lg-2 bg-light pt-2 pb-2 d-none d-lg-block">
                        <span class="fs-4 fw-bold">Product Image</span>
                    </div>

                    <div class="col-2 bg-primary pt-2 pb-2 d-none d-lg-block">
                        <span class="fs-4 fw-bold text-white">Title</span>
                    </div>

                    <div class="col-6 col-lg-2 bg-light pt-2 pb-2">
                        <span class="fs-4 fw-bold">Price</span>
                    </div>

                    <div class="col-2 bg-primary pt-2 pb-2 d-none d-lg-block">
                        <span class="fs-4 fw-bold text-white">Quantity</span>
                    </div>

                    <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block">
                        <span class="fs-4 fw-bold">Registered Date</span>
                    </div>

                    <div class="col-4 col-lg-1 bg-white"></div>

                </div>
            </div>

            <?php

            if (isset($_GET["page"])) {
                $pageno = $_GET["page"];
            } else {
                $pageno = 1;
            }


            $productrs = Database::search("SELECT * FROM `product` ");
            $d = $productrs->num_rows;
            $row = $productrs->fetch_assoc();
            $result_per_page = 5;
            $number_of_pages = ceil($d / $result_per_page);
            $page_first_result = ((int)$pageno - 1) * $result_per_page;
            $selectedrs = Database::search("SELECT * FROM `product` LIMIT " . $result_per_page . " OFFSET " . $page_first_result . " ");
            $srn = $selectedrs->num_rows;

            $c = 0;
            ?>

            <div class="col-12 mb-2">
                <div class="row">

                    <?php
                    while ($srow = $selectedrs->fetch_assoc()) {
                        $c = $c + 1;
                    ?>

                        <div class="col-2 col-lg-1 bg-primary pt-2 pb-2 text-end mt-1">
                            <span class="fs-5 fw-bold text-white"><?php echo $c; ?></span>
                        </div>

                        <?php
                        $productimg = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $srow["id"] . "' ");
                        $icode = $productimg->fetch_assoc();
                        ?>

                        <div class="col-2 col-lg-2 bg-light p-1 d-none d-lg-block mt-1" onclick="singleviewmodal('<?php echo $srow['id']; ?>');">
                            <img src="<?php echo $icode["code"]; ?>" style="height: 60px; margin-left: 80px;">
                        </div>

                        <div class="col-2 bg-primary pt-2 pb-2 d-none d-lg-block mt-1">
                            <span class="fs-5 fw-bold text-white"><?php echo $srow["title"]; ?></span>
                        </div>

                        <div class="col-6 col-lg-2 bg-light pt-2 pb-2 mt-1">
                            <span class="fs-5 fw-bold">Rs. <?php echo $srow["price"]; ?>.00</span>
                        </div>

                        <div class="col-2 bg-primary pt-2 pb-2 d-none d-lg-block mt-1">
                            <span class="fs-5 fw-bold text-white"><?php echo $srow["qty"]; ?></span>
                        </div>

                        <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block mt-1">
                            <span class="fs-5 fw-bold"><?php
                                                        $rd = $srow["datetime_added"];
                                                        $splitrd = explode(" ", $rd);
                                                        echo $splitrd[0];
                                                        ?></span>
                        </div>

                        <div class="col-4 col-lg-1 bg-white d-grid p-1 mt-1">
                            <?php
                            $s = $srow["status_id"];
                            if ($s == "1") {
                            ?>
                                <button class="btn btn-danger" onclick="blockproduct('<?php echo $srow['id']; ?>');">Block</button>
                            <?php
                            } else {
                            ?>
                                <button class="btn btn-success" onclick="blockproduct('<?php echo $srow['id']; ?>');">Unblock</button>
                            <?php
                            }
                            ?>
                        </div>


                        <!-- Modal-single product -->
                        <div class="modal fade" id="singleproductview<?php echo $srow['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"><?php echo $srow["title"]; ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="text-center">
                                            <img src="<?php echo $icode["code"]; ?>" style="height: 150px;" class="img-fluid">
                                        </div>

                                        <?php
                                        $s = $srow["user_email"];
                                        $sellers = Database::search("SELECT * FROM `user` WHERE `email`='".$s."' ");
                                        $sd = $sellers->fetch_assoc();
                                        ?>

                                        <span class="fs-5 fw-bold">Price :</span>&nbsp;
                                        <span class="fs-5 fw-bold">Rs. <?php echo $srow["price"]; ?>.00</span><br />
                                        <span class="fs-5 fw-bold">Quantity :</span>&nbsp;
                                        <span class="fs-5"><?php echo $srow["qty"]; ?> Item Left</span><br />
                                        <span class="fs-5 fw-bold">Seller :</span>&nbsp;
                                        <span class="fs-5"><?php echo $sd["fname"]." ".$sd["lname"]; ?></span><br />
                                        <span class="fs-5 fw-bold">Description :</span>&nbsp;
                                        <span class="fs-5"><?php echo $srow["description"]; ?></span>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal-single product -->

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

                    <hr />

                    <div class="col-12">
                        <h3 class="text-primary">Manage Categories</h3>
                    </div>

                    <hr>

                    <div class="col-12 mb-3">
                        <div class="row g-1">

                            <?php

                            $categoryrs = Database::search("SELECT * FROM `category` ");
                            $num = $categoryrs->num_rows;

                            for ($i = 0; $i < $num; $i++) {
                                $row = $categoryrs->fetch_assoc();
                            ?>
                                <div class="col-12 col-lg-3">
                                    <div class="row g-1 px-1">
                                        <div class="col-12 text-center bg-body border border-2 border-success shadow rounded">
                                            <label class="form-label fs-4 fw-bold py-3"><?php echo $row["name"] ?></label>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>


                            <div class="col-12 col-lg-3">
                                <div class="row g-1 px-1">
                                    <div class="col-12 text-center bg-body border border-2 border-danger shadow rounded">
                                        <div class="row">
                                            <div class="col-3 mt-3 addnewimg"></div>
                                            <div class="col-9" onclick="addnewmodal();">
                                                <label class="form-label fs-4 fw-bold py-3 text-black-50">Add New Category</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Modal-1 -->
                    <div class="modal fade" id="addnewmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <label class="form-label">Category</label>
                                    <input type="text" class="form-control" id="categorytxt" />
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" onclick="savecategory();">Save category</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal-1 -->



                </div>
            </div>

            <?php require "footer.php"; ?>

        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
</body>

</html>