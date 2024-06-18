<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="home.css" />
</head>

<body>
    <div class="col-12">
        <div class="row">
            <div class="offset-lg-1 col-12 col-lg-3 align-self-start">
                <span class="text-start label1"><b>Welcome</b>

                    <?php
                    session_start();
                    if (isset($_SESSION["u"])) {
                        $user = $_SESSION["u"]["fname"];
                        echo $user;
                    ?>
                        <span class="text-start label2" onclick="signout();">Sign Out</span>
                    <?php
                    } else {
                    ?>
                        <a href="index.php">Hi Sign in OR Register</a>


                    <?php
                    }
                    ?>

                    <span class="text-start label2">|Help and Contact</span>

            </div>
            <div class="col-12 col-lg-3 offset-lg-5 align-self-lg-end" style="text-align: center;">
                <!-- <div class="offset-lg-6 off col-12 col-md-3 col-lg-2 align-self-end"> -->
                <div class="row mt-1 mb-1">
                    <div class="col-1 col-lg-3 mt-1">
                        <span class="text-start label2" onclick="goToAddProduct();">Sell</span>
                    </div>
                    <div class="col-2 col-lg-6 dropdown">
                        <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            My eShop
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="watchlist.php">Whishlist</a></li>
                            <li><a class="dropdown-item" href="purchasehistory.php">Purchase History</a></li>
                            <li><a class="dropdown-item" href="messages.php">Message</a></li>
                            <li><a class="dropdown-item" href="sellproductview.php">My Products</a></li>
                            <li><a class="dropdown-item" href="userprofile.php">My Profile</a></li>
                            <li><a class="dropdown-item" href="#">My Sellings</a></li>
                        </ul>
                    </div>
                    <div class="col-3 col-lg-3 mt-1 ms-5 ms-lg-0 carticon" onclick="gotoCart();"></div>

                </div>
            </div>
        </div>
    </div>
    <!-- <script src="home.php"></script> -->
</body>

</html>