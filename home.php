<?php
require "connection.php";


?>


<!DOCTYPE html>

<html>

<head>
    <title>eShop</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="home.css" />
</head>

<body>
    <div class="container-fluid">
        <div class="row">

            <!-- header -->

            <?php

            require "header.php"

            ?>

            <!-- header -->

            <hr class="hrbreak1" />

            <!-- search bar -->
            <div class="col-12 justify-content-center">
                <div class="row mb-3">
                    <div class="offset-lg-1 col-12 col-lg-1 logoimg" style="background-position: center;"></div>
                    <div class="col-8 col-lg-6">
                        <div class="input-group input-group-lg mt-3 mb-3">
                            <input type="text" class="form-control" id="basic_search_text" aria-label="Text input with dropdown button">

                            <select class="btn btn-outline-primary" id="basic_search_category">
                                <option value="0">Select Category</option>
                                <?php
                                $rs = Database::search("SELECT * FROM `category`");
                                $n = $rs->num_rows;

                                for ($i = 1; $i <= $n; $i++) {
                                    $cat = $rs->fetch_assoc();
                                ?>
                                    <option value="<?php echo $cat["id"] ?>"><?php echo $cat["name"] ?></option>
                                <?php
                                }

                                ?>

                            </select>

                        </div>
                    </div>
                    <div class="col-2 d-grid gap-2">
                        <button class="btn btn-primary mt-3 searchbtn" onclick="basicSearch(1);">Search</button>
                    </div>
                    <div class="col-2 mt-4">
                        <a class="link-secondary link1" href="advancedSearch.php">Advanced</a>
                    </div>
                </div>
            </div>
            <!-- search bar -->

            <hr class="hrbreak1" />

            <!-- slide  -->
            <div class="col-12 d-none d-lg-block">
                <div class="row">
                    <div id="carouselExampleCaptions" class="offset-2 col-8 carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="resources/slider images/posterimg.jpg" class="d-block posterimg1" alt="...">
                                <div class="carousel-caption d-none d-md-block postercaption">
                                    <h5 class="postertitle">Welcome to eShop</h5>
                                    <p class="postertext">The World's Best Online Store By One Click</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="resources/slider images/posterimg2.jpg" class="d-block posterimg1" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="resources/slider images/posterimg3.jpg" class="d-block posterimg1" alt="...">
                                <div class="carousel-caption d-none d-md-block postercaption1">
                                    <h5 class="postertitle">Be Free.....</h5>
                                    <p class="postertext">Experience the Lowest Delivery Costs With Us.</p>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- slide -->

            <!-- product title view -->
            <div class="row" id="product_view_div">
                <?php
                $rs = Database::search("SELECT * FROM `category`");
                $n = $rs->num_rows;

                for ($x = 0; $x < $n; $x++) {
                    $c = $rs->fetch_assoc();
                ?>


                    <div class="col-12">
                        <a class="link-dark link2" href="#"><?php echo $c["name"]; ?></a>&nbsp;&nbsp;
                        <a class="link-dark link3" href="#">See All &rightarrow;</a>&nbsp;&nbsp;
                    </div>

                    <?php

                    $resultset = Database::search("SELECT * FROM `product` WHERE `category_id`='" . $c["id"] . "' ORDER BY `datetime_added` DESC  LIMIT 4 OFFSET 0  ");

                    ?>

                    <!-- product title view -->

                    <!-- product view -->

                    <div class="col-12">
                        <div class="row border border-primary mb-5">
                            <div class="col-12 col-xl-10 offset-xl-1 col-xxl-8 offset-xxl-2" id="pdiv">
                                <div class="row" id="pdeatails">

                                    <?php

                                    $nr = $resultset->num_rows;
                                    for ($y = 0; $y < $nr; $y++) {
                                        $prod = $resultset->fetch_assoc();
                                    ?>

                                        <div class="col-12 col-md-4 col-xl-3">
                                            <div class="card mt-2 mb-2 ">

                                                <?php

                                                $pimage = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $prod["id"] . "' ");
                                                $imgrow = $pimage->fetch_assoc();

                                                ?>

                                                <img src="<?php echo $imgrow["code"] ?>" class="cardTopImg">
                                                <div class="card-body d-grid">
                                                    <h6 class="card-title"><?php echo $prod["title"]; ?><span class="badge bg-info ms-2">New</span></h6>
                                                    <span class="card-text text-primary">Rs. <?php echo $prod["price"]; ?>.00</span>
                                                    <br />

                                                    <?php
                                                    $pstatus = Database::search("SELECT * FROM `status` WHERE `id`='" . $prod["status_id"] . "'");
                                                    $statusrow = $pstatus->fetch_assoc();

                                                    if ((int)$prod["qty"] > 0) {
                                                    ?>

                                                        <span class="card-text text-warning">In Stock</span>
                                                        <input type="number" class="form-control mb-1" value="1" id="qtytxt<?php echo $prod["id"]; ?>" />
                                                        <a href="<?php echo "singleproductview.php?id=" . ($prod['id']); ?>" class="btn btn-success mt-1">Buy Now</a>
                                                        <a href="#" onclick='addToCart(<?php echo $prod["id"] ?>)' class="btn btn-danger mt-1 mb-1">Add Cart</a>
                                                        <a  class="btn btn-secondary"><i class="bi bi-heart-fill" onclick='addToWatchList(<?php echo $prod["id"] ?>)'></i></a>

                                                    <?php
                                                    } else {
                                                    ?>
                                                        <span class="card-text text-danger"><b>Out of Stock</b></span>
                                                        <br />
                                                        <input type="number" class="form-control mb-1 d disabled" value="0" disabled />
                                                        <a href="#" class="btn btn-success disabled">Buy Now</a>
                                                        <a href="#" onclick='addToCart(<?php echo $prod["id"] ?>)' class="btn btn-danger mt-1">Add Cart</a>
                                                        <a href="#" onclick='addToWatchList(<?php echo $prod["id"] ?>)' class="btn btn-secondary mt-1"><i class="bi bi-heart-fill"></i></a>
                                                    <?php
                                                    }
                                                    ?>

                                                </div>
                                            </div>

                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Product view-->
                <?php
                }
                ?>
            </div>
            <!--footer-->
            <?php
            require "footer.php";
            ?>
            <!--footer-->

            <!--container end-->
        </div>
    </div>
    <script src="bootstrap.js"></script>
    <script src="bootstrap.bundle.js"></script>
    <script src="home.js"></script>
</body>

</html>