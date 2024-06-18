<?php

require "connection.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>eShop | Advanced Search</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
    <link rel="icon" href="resources/logo.svg" />
</head>

<body onload="advancedSearch(0);" class="bg-info">

    <div class="container-fluid">
        <div class="row">

            <div class="col-12 bg-body border border-primary border-start-0 border-end-0 border-top-0 ">
                <?php require "header.php";
                $user = $_SESSION["u"];
                ?>
            </div>

            <div class="col-12 bg-white">
                <div class="row">
                    <div class="offset-0 offset-lg-4 col-12 col-lg-4">
                        <div class="row">

                            <div class="col-2 mt-2">
                                <div class="mb-3 logo-img"></div>
                            </div>
                            <div class="col-10">
                                <lable class="text-black-50 fw-bold fs-2 mt-4">Advanced Search</lable>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-o offset-lg-2 col-12 col-lg-8 bg-white mt-3 mb-3 rounded">
                <div class="row">

                    <div class="offset-0 offset-lg-1 col-12 col-lg-10">
                        <div class="row">

                            <div class="col-12 col-lg-10 mt-3 mb-2">
                                <input type="text" class="form-control fw-bold" placeholder="Type keyword to search.." id="s1" />
                            </div>
                            <div class="col-12 col-lg-2 mt-3 mb-2 d-grid">
                                <button class="btn btn-primary searchbtn1" onclick="advancedSearch(0);">Search</button>
                            </div>
                            <div class="col-12">
                                <hr class="border border-primary border-3" />
                            </div>

                        </div>
                    </div>

                    <div class="offset-0 offset-lg-1 col-12 col-lg-10">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">

                                    <div class="col-12 col-lg-4 mb-3">
                                        <select class="form-select" id="ca1" onclick="advancedSearch(0);">
                                            <option value="0">Select Category</option>
                                            <?php

                                            $rs = Database::search("SELECT * FROM category");
                                            $n = $rs->num_rows;

                                            for ($x = 0; $x < $n; $x++) {

                                                $fa = $rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $fa["id"]; ?>"><?php echo $fa["name"]; ?></option>

                                            <?php
                                            }

                                            ?>

                                        </select>
                                    </div>

                                    <div class="col-12 col-lg-4 mb-3">
                                        <select class="form-select" id="br1" onclick="advancedSearch(0);">
                                            <option value="0">Select Brand</option>
                                            <?php

                                            $rs = Database::search("SELECT * FROM brand");
                                            $n = $rs->num_rows;

                                            for ($x = 0; $x < $n; $x++) {

                                                $fa = $rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $fa["id"]; ?>"><?php echo $fa["name"]; ?></option>

                                            <?php
                                            }

                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-12 col-lg-4 mb-3">
                                        <select class="form-select" id="mo1" onclick="advancedSearch(0);">
                                            <option value="0">Select Model</option>
                                            <?php

                                            $rs = Database::search("SELECT * FROM model");
                                            $n = $rs->num_rows;

                                            for ($x = 0; $x < $n; $x++) {

                                                $fa = $rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $fa["id"]; ?>"><?php echo $fa["name"]; ?></option>

                                            <?php
                                            }

                                            ?>
                                        </select>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-12 col-lg-6 mb-3">

                                        <select class="form-select" id="co1" onclick="advancedSearch(0);">
                                            <option value="0">Select Condition</option>
                                            <?php

                                            $rs = Database::search("SELECT * FROM `condition`;");
                                            $n = $rs->num_rows;

                                            for ($x = 0; $x < $n; $x++) {

                                                $fa = $rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $fa["id"]; ?>"><?php echo $fa["name"]; ?></option>
                                            <?php
                                            }

                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-12 col-lg-6 mb-3">
                                        <select class="form-select" id="col1" onclick="advancedSearch(0);">
                                            <option value="0">Select Colour</option>
                                            <?php

                                            $rs = Database::search("SELECT * FROM color");
                                            $n = $rs->num_rows;

                                            for ($x = 0; $x < $n; $x++) {
                                                $fa = $rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $fa["id"]; ?>"><?php echo $fa["name"]; ?></option>
                                            <?php
                                            }

                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-12 col-lg-6 mb-3">
                                        <input type="text" class="form-control" onkeyup="advancedSearch(0);" placeholder="Price From" id="prif1" />
                                    </div>

                                    <div class="col-12 col-lg-6 mb-3">
                                        <input type="text" class="form-control" onkeyup="advancedSearch(0);" placeholder="Price To" id="prit2" />
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-o offset-lg-2 col-12 col-lg-8 bg-white mt-3 mb-3 rounded">
                <div class="row">
                    <div class="col-9 col-lg-10">
                        <hr>
                    </div>
                    <div class="col-3 col-lg-2 mb-2 mt-2">
                        <select class=" form-select border border-2 border-dark border-start-0 border-end-0 border-top-0" id="sort" onchange="advancedSearch(0);">
                            <option value="0"><i class="bi bi-funnel-fill"></i>Sort Results</option>
                            <option value="1">Price Low To High</option>
                            <option value="2">Price High To Low</option>
                            <option value="3">Quantity Low To High</option>
                            <option value="4">Quantity High To Low</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-2 col-12 col-lg-8 mb-3 rounded bg-white" id="filter">
                <div class="row">
                    <div class="offset-0 offset-lg-1 col-12 col-lg-10 text-center" id="filter">
                        <div class="row">

                            <?php
                            if (isset($_GET["page"])) {
                                $pageno = $_GET["page"];
                            } else {
                                $pageno = 1;
                            }

                            $products = Database::search("SELECT * FROM `product`");
                            $nProduct = $products->num_rows;
                            $userProduct = $products->fetch_assoc();

                            $results_per_page = 6;
                            $number_of_pages = ceil($nProduct / $results_per_page);

                            $page_first_result = ((int)$pageno - 1) * $results_per_page;
                            $selectedrs = Database::search("SELECT * FROM `product` LIMIT " . $results_per_page . " OFFSET " . $page_first_result . "");
                            $srn = $selectedrs->num_rows;

                            while ($productImage = $selectedrs->fetch_assoc()) {

                                // for ($x = 0; $x < $srn; $x++) {
                                // $productImage = $selectedrs->fetch_assoc();
                            ?>
                                <div class="card mb-3 mt-3 col-12 col-lg-6">
                                    <div class="row">
                                        <div class="col-md-4 mt-4">

                                            <?php

                                            $pimgrs = Database::search("SELECT * FROM `images` WHERE `product_id`= '" . $productImage["id"] . "'");
                                            $pir = $pimgrs->fetch_assoc();

                                            ?>

                                            <img src="<?php echo $pir["code"] ?>" class="img-fluid rounded-start" alt="...">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">

                                                <h5 class="card-title fw-bold"><?php echo $productImage["title"] ?></h5>
                                                <span class="card-text text-primary fw-bold">Rs.<?php echo $productImage["price"] ?>.00</span>
                                                <br />
                                                <span class="card-text text-success fw-bold"><?php echo $productImage["qty"] ?> Items Left</span>

                                                <div class="form-check form-switch">


                                                </div>

                                                <div class="row">
                                                    <div class="col-12">

                                                        <div class="row g-1">
                                                            <div class="col-12 col-lg-6 d-grid">
                                                                <a href="#" class="btn btn-success fs" onclick="sendid(<?php echo $productImage['id'] ?>);">Update</a>
                                                            </div>
                                                            <div class="col-12 col-lg-6 d-grid">
                                                                <a href="#" class="btn btn-danger fs" onclick="deleteModal(<?php echo $productImage['id'] ?>);">Delete</a>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="deleteModel<?php echo $productImage['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title fw-bold text-warning" id="exampleModalLabel">Warning</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you want to delete this product
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                <button type="button" class="btn btn-primary" onclick="deleteProduct(<?php echo $productImage['id'] ?>);">Yes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- modal -->

                            <?php
                            }

                            ?>

                        </div>
                        <!-- <div class="card mb-3 mt-3 col-12 col-lg-6">
                                <div class="row">
                                    <div class="col-md-4 mt-4">

                                        <img src="resources/mobile images/iphone12.jpg" class="img-fluid rounded-start" alt="...">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">

                                            <h5 class="card-title fw-bold">iPhone 12</h5>
                                            <span class="card-text text-primary fw-bold">Rs.500000.00</span>
                                            <br />
                                            <span class="card-text text-success fw-bold fs">10 Items Left</span>

                                            <div class="row">
                                                <div class="col-12">

                                                    <div class="row g-1">
                                                        <div class="col-12 col-lg-6 d-grid">
                                                            <a href="#" class="btn btn-success fs">Update</a>
                                                        </div>
                                                        <div class="col-12 col-lg-6 d-grid">
                                                            <a href="#" class="btn btn-danger fs">Delete</a>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                           
                        </div> -->
                    </div>

                </div>

                <div class="col-12">
                    <div class="row">
                        <div class="offset-4 col-4 text-center">
                            <div class="offset-3 mb-5 pagination">
                                <a href="
                                <?php

                                if ($pageno <= 1) {
                                    echo "#";
                                } else {
                                    echo "?page=" . ($pageno - 1);
                                }

                                ?>">&laquo;</a>

                                <?php

                                for ($page = 1; $page <= $number_of_pages; $page++) {

                                    if ($page == $pageno) {
                                ?>
                                        <a href="<?php echo "?page=" . ($page); ?>" class="ms-1 active"><?php echo $page; ?></a>
                                    <?php
                                    } else {
                                    ?>

                                        <a href="<?php echo "?page=" . ($page); ?>" class="ms-1"><?php echo $page; ?></a>

                                <?php
                                    }
                                }

                                ?>
                                <a href="
                                
                                <?php

                                if ($pageno >= $number_of_pages) {
                                    echo "#";
                                } else {
                                    echo "?page=" . ($pageno + 1);
                                }

                                ?>
                                
                                ">&raquo;</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <?php

            require "footer.php";

            ?>

        </div>
    </div>
    <script src="addproduct.js"></script>
    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
</body>

</html>