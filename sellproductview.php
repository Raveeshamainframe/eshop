<?php
require "connection.php";
session_start();
if (isset($_SESSION["u"])) {

    $user = $_SESSION["u"];

    $pageno;

?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>eShop| Seller's Product View</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" href="resources/logo.svg" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="sellproductview.css" />
    </head>

    <body style="background-color: #E9EBEE;">

        <div class="container-fluid">
            <div class="row">
                <!-- head -->

                <div class="col-12 bg-primary">
                    <div class="row">

                        <div class="col-4">
                            <div class="row">
                                <div class="col-12 col-lg-4 mt-1 mb-1">
                                    <?php

                                    $profileimg = Database::search("SELECT * FROM `prof_img` WHERE `user_email`= '" . $user["email"] . "' ");
                                    $pn = $profileimg->num_rows;
                                    $pr = $profileimg->fetch_assoc();

                                    if ($pn == 1) {
                                    ?>

                                        <img class="rounded-circle" src="<?php echo $pr["code"] ?>" width="90px" height="90px" />

                                    <?php
                                    } else {
                                    ?>
                                        <img class="rounded-circle" src="resources/profiles/profile.png" width="90px" height="90px" />
                                    <?php
                                    }
                                    ?>

                                </div>
                                <div class="col-3">
                                    <div class="row">
                                        <div class="col-12 mt-0 mt-lg-4">
                                            <span class="fw-bold"><?php echo $user["fname"] . " " . $user["lname"]  ?></span>
                                        </div>
                                        <div class="col-12">
                                            <span class="text-white"><?php echo $user["email"] ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-8">
                            <div class="row">
                                <div class="col-12 mt-5 my-lg-3">
                                    <h1 class="text-white fw-bold offset-5 offset-lg-2">My Products</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- head -->

                <div class="col-12">
                    <div class="row">

                        <!-- sortings -->

                        <div class="col-lg-2 mx-lg-3 my-lg-3 rounded bg-body border border-primary">
                            <div class="row">
                                <div class="col-12 mt-3 ms-lg-3 fs-5">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label">Filters</label>
                                        </div>
                                        <div class="col-11">
                                            <div class="row">
                                                <div class="col-10">
                                                    <input type="text" class="form-control" placeholder="Search..." id="s" />
                                                </div>
                                                <div class="col-1">
                                                    <label class="form-label fs-4"><i class="bi bi-search"></i></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label fw-bold">Active Time</label>
                                        </div>
                                        <div class="col-12">
                                            <hr width="80%" />
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="n">
                                                <label class="form-check-label" for="n">
                                                    New to Oldest
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="o">
                                                <label class="form-check-label" for="o">
                                                    Oldest to Newer
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <label class="form-label fw-bold">By Quantity</label>
                                        </div>
                                        <div class="col-12">
                                            <hr width="80%" />
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="l">
                                                <label class="form-check-label" for="l">
                                                    Low to High
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="h">
                                                <label class="form-check-label" for="h">
                                                    High to Low
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label fw-bold">By Condition</label>
                                        </div>
                                        <div class="col-12">
                                            <hr width="80%" />
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="b">
                                                <label class="form-check-label" for="n">
                                                    Brand New
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="u">
                                                <label class="form-check-label" for="u">
                                                    Used
                                                </label>
                                            </div>
                                        </div>
                                        <div class="offset-0 offset-lg-2 col-12 col-lg-8 mt-3 mb-3 p-3">
                                            <div class="row">
                                                <button class="col-12 d-grid btn btn-success fw-bold mb-3" onclick="addFilters(1);">Search</button>
                                                <button class="col-12 d-grid btn btn-primary">Clear Filters</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- sortings -->

                        <!-- product -->

                        <div class="col-lg-9 mt-3 mb-3 bg-white border border-primary">
                            <div class="row" id="productview">

                                <div class="offset-1 col-10 text-center">
                                    <div class="row">

                                        <?php

                                        if (isset($_GET["page"])) {
                                            $pageno = $_GET["page"];
                                        } else {
                                            $pageno = 1;
                                        }


                                        $product = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' ");
                                        $d = $product->num_rows;
                                        $row = $product->fetch_assoc();
                                        $result_per_page = 6;
                                        $number_of_pages = ceil($d / $result_per_page);
                                        $page_first_result = ((int)$pageno - 1) * $result_per_page;
                                        $selectedrs = Database::search("SELECT * FROM `product` WHERE `user_email`= '" . $user["email"] . "' LIMIT " . $result_per_page . " OFFSET " . $page_first_result . " ");
                                        $srn = $selectedrs->num_rows;

                                        while ($srow = $selectedrs->fetch_assoc()) {

                                            // for ($i = 0; $i < $srn; $i++) {

                                        ?>
                                            <div class="card col-lg-6 col-12 mt-3 mb-3">
                                                <div class="row g-0">

                                                    <?php

                                                    $pimgrs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $srow["id"] . "' ");
                                                    $pir = $pimgrs->fetch_assoc();

                                                    ?>

                                                    <div class="col-md-4 mt-4">
                                                        <img src="<?php echo $pir["code"] ?>" class="img-fluid rounded-start" />
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="card-body">
                                                            <h5 class="card-title fw-bold"><?php echo $srow["title"] ?></h5>
                                                            <span class="card-text fw-bold text-primary">Rs. <?php echo $srow["price"] ?>.00</span>
                                                            <br />
                                                            <span class="card-text fw-bold text-success"><?php echo $srow["qty"] ?> Item Left</span>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" id="check" onclick="changeStatus(<?php echo $srow['id'] ?>);" <?php if ($srow["status_id"] == 2) {
                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                } ?> />

                                                                <label class="form-check-label fw-bold text-info" id="checklable<?php echo $srow['id'] ?>" for="check"><?php
                                                                                                                                                                        if ($srow["status_id"] == 2) {
                                                                                                                                                                            echo "Make Your Product Activate";
                                                                                                                                                                        } else {
                                                                                                                                                                            echo " Make Your Product Deactivate";
                                                                                                                                                                        }
                                                                                                                                                                        ?></label>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="row">
                                                                    <div class="col-12 col-lg-6">
                                                                        <a href="#" class="btn btn-success d-grid" onclick="sendid(<?php echo $srow['id'] ?>);">Update</a>
                                                                    </div>
                                                                    <div class="col-12 col-lg-6 mt-1 mt-lg-0">
                                                                        <a href="#" class="btn btn-danger d-grid" onclick="deleteModel(<?php echo $srow['id'] ?>);">Delete</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal -->
                                            <div class="modal fade" id="deleteModel<?php echo $srow['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-warning" id="exampleModalLabel">Warning...</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are You Sure You Want To Delete This Product
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-success" data-bs-dismiss="modal">No</button>
                                                            <button type="button" class="btn btn-danger" onclick="deleteproduct(<?php echo $srow['id'] ?>);">Yes</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <!-- pagination -->

                                <div class="col-12 d-flex justify-content-center mb-2 fs-5 fw-bold mt-2">
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
                            </div>

                            <!-- pagination -->

                        </div>
                    </div>
                    <!-- product -->
                </div>
            </div>



        </div>
        <!-- footer -->
        <?php
        require "footer.php";
        ?>
        <!-- footer-->
        </div>



        <script src="sellproductview.js"></script>
        <script src="bootstrap.js"></script>
    </body>

    </html>


<?php

} else {

?>

    <script>
        alert("Your have Signin or Signup First");
        window.location = "index.php";
    </script>

<?php
}

?>