<?php

session_start();

require "connection.php";

if (isset($_SESSION["u"])) {

    $useremail = $_SESSION["u"]["email"];

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
            <div class="row gx-2 gy-2">
                <?php require "headerforWishlist.php"; ?>

                <div class="col-12 border border-1 border-secondary rounded mb-2 p-1">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label fs-1 fw-bolder">Watchlist &heartsuit;</label>
                        </div>
                        <div class="col-12 col-lg-6">
                            <hr class="hrbreak1" />
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="offset-0 offset-lg-2 col-12 col-lg-6 mb-3">
                                    <input type="text" class="form-control" placeholder="Search in Watchlist..." />
                                </div>
                                <div class="col-12 col-lg-2 d-grid mb-3">
                                    <button class="btn btn-outline-primary">Search</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <hr class="hrbreak1" />
                        </div>
                        <div class="col-12 col-lg-2 border border-start-0 border-top-0 border-end border-bottom-0 border-2 border-primary">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Watchlist</li>
                                </ol>
                            </nav>
                            <ul class="nav nav-pills flex-column">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="#">My Watchlist</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">My Cart</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Rcently Viewed</a>
                                </li>
                            </ul>
                        </div>

                        <?php

                        $watchlistrs = Database::search("SELECT * FROM `watchlist` WHERE `user_email`= '" . $useremail . "' ORDER BY `id` DESC ");
                        $wn = $watchlistrs->num_rows;

                        if ($wn == 0) {
                        ?>
                            <!-- without item -->
                            <div class="col-12 col-lg-9">
                                <div class="row">
                                    <div class="col-12 emptyview"></div>
                                    <div class="col-12 text-center">
                                        <label class="form-label fs-1 mb-3 fw-bolder">You have no item in your Watchlist</label>
                                    </div>
                                </div>
                            </div>
                            <!-- without item -->
                        <?php
                        } else {
                        ?>
                            <div class="col-12 col-lg-9">
                                <div class="row gy-2">
                                    <?php
                                    for ($i = 0; $i < $wn; $i++) {
                                        $wr = $watchlistrs->fetch_assoc();
                                        $wid = $wr["product_id"];

                                        $productrs = Database::search("SELECT * FROM `product` WHERE `id`='" . $wid . "' ");
                                        $pn = $productrs->num_rows;
                                        if ($pn == 1) {
                                            $pr = $productrs->fetch_assoc();
                                            $prodid = $pr["id"];

                                    ?>



                                            <div class="card mb-3 mx-3 col-12">
                                                <div class="row g-0">
                                                    <div class="col-md-4 d-flex justify-content-center">
                                                        <?php
                                                        $imagers = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $prodid . "' ");
                                                        $in = $imagers->num_rows;

                                                        $arr;

                                                        for ($x = 0; $x < $in; $x++) {
                                                            $ir = $imagers->fetch_assoc();
                                                            $arr[$x] = $ir["code"];
                                                        }

                                                        ?>
                                                        <img src="<?php echo $arr[0]; ?>" class="img-fluid rounded-start" style="height: 16rem;">
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="card-body">
                                                            <h3 class="card-title"><?php echo $pr["title"] ?></h3>
                                                            <?php
                                                            $colur = Database::search("SELECT * FROM `color` WHERE `id`='" . $pr["color_id"] . "' ");
                                                            $c = $colur->fetch_assoc();
                                                            $cond = Database::search("SELECT * FROM `condition` WHERE `id`='" . $pr["condition_id"] . "' ");
                                                            $co = $cond->fetch_assoc();
                                                            ?>
                                                            <span class="fw-bold text-black-50">Colour : <?php echo $c["name"] ?></span>&nbsp;
                                                            &nbsp;<span class="fw-bold text-black-50">Condition : <?php echo $co["name"] ?></span>
                                                            <br />
                                                            <span class="fw-bold text-black-50">Price : </span>&nbsp;
                                                            <span class="fw-bolder text-black fs-5">Rs. <?php echo $pr["price"] ?>.00</span>
                                                            <br />
                                                            <span class="fw-bolder text-black-50 fs-5">Seller</span>
                                                            <br />
                                                            <span class="fw-bolder text-black fs-5"><?php echo $_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"] ?></span>
                                                            <br />
                                                            <span class="fw-bolder text-black fs-5"><?php echo $_SESSION["u"]["email"] ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 mt-4">
                                                        <div class="card-body d-grid">
                                                            <a href="#" class="btn btn-outline-success mb-2">Buy Now</a>
                                                            <a href="#" class="btn btn-outline-secondary mb-2">Add Cart</a>
                                                            <a href="#" class="btn btn-outline-danger mb-2" onclick="deleteformwatchlist(<?php echo $wr['id'] ?>);">Remove</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>

            </div>
        </div>

        <?php require "footer.php"; ?>
        <script src="home.js"></script>

    </body>

    </html>

<?php

}

?>