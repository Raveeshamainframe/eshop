<?php
require "connection.php";
session_start();

$user = $_SESSION["u"];


$search = $_POST["s"];
$age = $_POST["a"];
$qty = $_POST["q"];
$condition = $_POST["c"];

$results_per_page = 6;

$pageno = $_POST["page"];

if (!empty($search) && $age == 0 && $qty == 0 && $condition == 0) {  // only_search
    $products = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' AND `title` LIKE'%" . $search . "%'");
    $pn = $products->num_rows;
    $number_of_pages = ceil($pn / $results_per_page);
    $offset = ($pageno - 1) * $results_per_page;
    $selectedproducts = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' AND `title` LIKE '%" . $search . "%' LIMIT $results_per_page OFFSET $offset");
    $spn = $selectedproducts->num_rows;
} elseif (!empty($search) && $age != 0 && $qty == 0 && $condition == 0) { // search and age
    if ($age == 1) {
        $products = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' AND `title` LIKE'%" . $search . "%' ORDER BY `datetime_added` DESC");
        $pn = $products->num_rows;
        $number_of_pages = ceil($pn / $results_per_page);
        $offset = ($pageno - 1) * $results_per_page;
        $selectedproducts = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' AND `title` LIKE '%" . $search . "%' ORDER BY `datetime_added` DESC LIMIT $results_per_page OFFSET $offset");
        $spn = $selectedproducts->num_rows;
    } elseif ($age == 2) {
        $products = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' AND `title` LIKE'%" . $search . "%' ORDER BY `datetime_added` ASC");
        $pn = $products->num_rows;
        $number_of_pages = ceil($pn / $results_per_page);
        $offset = ($pageno - 1) * $results_per_page;
        $selectedproducts = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' AND `title` LIKE '%" . $search . "%' ORDER BY `datetime_added` ASC LIMIT $results_per_page OFFSET $offset");
        $spn = $selectedproducts->num_rows;
    }
} elseif (!empty($search) && $age == 0 && $qty != 0 && $condition == 0) { // search and qty
    if ($qty == 2) {
        $products = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' AND `title` LIKE'%" . $search . "%' ORDER BY `qty` DESC");
        $pn = $products->num_rows;
        $number_of_pages = ceil($pn / $results_per_page);
        $offset = ($pageno - 1) * $results_per_page;
        $selectedproducts = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' AND `title` LIKE '%" . $search . "%' ORDER BY `qty` DESC LIMIT $results_per_page OFFSET $offset");
        $spn = $selectedproducts->num_rows;
    } elseif ($qty == 1) {
        $products = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' AND `title` LIKE'%" . $search . "%' ORDER BY `qty` ASC");
        $pn = $products->num_rows;
        $number_of_pages = ceil($pn / $results_per_page);
        $offset = ($pageno - 1) * $results_per_page;
        $selectedproducts = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' AND `title` LIKE '%" . $search . "%' ORDER BY `qty` ASC LIMIT $results_per_page OFFSET $offset");
        $spn = $selectedproducts->num_rows;
    }
} elseif (!empty($search) && $age == 0 && $qty == 0 && $condition != 0) { // search and condition
    if ($condition == 1) {
        $products = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' AND `title` LIKE'%" . $search . "%' AND `condition_id`='1' ");
        $pn = $products->num_rows;
        $number_of_pages = ceil($pn / $results_per_page);
        $offset = ($pageno - 1) * $results_per_page;
        $selectedproducts = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' AND `title` LIKE '%" . $search . "%' AND `condition_id`='1'  LIMIT $results_per_page OFFSET $offset");
        $spn = $selectedproducts->num_rows;
    } elseif ($condition == 2) {
        $products = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' AND `title` LIKE'%" . $search . "%' AND `condition_id`='2' ");
        $pn = $products->num_rows;
        $number_of_pages = ceil($pn / $results_per_page);
        $offset = ($pageno - 1) * $results_per_page;
        $selectedproducts = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' AND `title` LIKE '%" . $search . "%' AND `condition_id`='2' LIMIT $results_per_page OFFSET $offset");
        $spn = $selectedproducts->num_rows;
    }
} elseif (empty($search) && $age != 0 && $qty == 0 && $condition == 0) { // only age
    if ($age == 1) {
        $products = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' ORDER BY `datetime_added` DESC");
        $pn = $products->num_rows;
        $number_of_pages = ceil($pn / $results_per_page);
        $offset = ($pageno - 1) * $results_per_page;
        $selectedproducts = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' ORDER BY `datetime_added` DESC LIMIT $results_per_page OFFSET $offset");
        $spn = $selectedproducts->num_rows;
    } elseif ($age == 2) {
        $products = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' ORDER BY `datetime_added` ASC");
        $pn = $products->num_rows;
        $number_of_pages = ceil($pn / $results_per_page);
        $offset = ($pageno - 1) * $results_per_page;
        $selectedproducts = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' ORDER BY `datetime_added` ASC LIMIT $results_per_page OFFSET $offset");
        $spn = $selectedproducts->num_rows;
    }
} elseif (empty($search) && $age == 0 && $qty != 0 && $condition == 0) { // only qty
    if ($qty == 2) {
        $products = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' ORDER BY `qty` DESC");
        $pn = $products->num_rows;
        $number_of_pages = ceil($pn / $results_per_page);
        $offset = ($pageno - 1) * $results_per_page;
        $selectedproducts = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' ORDER BY `qty` DESC LIMIT $results_per_page OFFSET $offset");
        $spn = $selectedproducts->num_rows;
    } elseif ($qty == 1) {
        $products = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' ORDER BY `qty` ASC");
        $pn = $products->num_rows;
        $number_of_pages = ceil($pn / $results_per_page);
        $offset = ($pageno - 1) * $results_per_page;
        $selectedproducts = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' ORDER BY `qty` ASC LIMIT $results_per_page OFFSET $offset");
        $spn = $selectedproducts->num_rows;
    }
} elseif (empty($search) && $age == 0 && $qty == 0 && $condition != 0) { // only condition
    if ($condition == 1) {
        $products = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' AND `condition_id`='1' ");
        $pn = $products->num_rows;
        $number_of_pages = ceil($pn / $results_per_page);
        $offset = ($pageno - 1) * $results_per_page;
        $selectedproducts = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' AND `condition_id`='1'  LIMIT $results_per_page OFFSET $offset");
        $spn = $selectedproducts->num_rows;
    } elseif ($condition == 2) {
        $products = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' AND `condition_id`='2' ");
        $pn = $products->num_rows;
        $number_of_pages = ceil($pn / $results_per_page);
        $offset = ($pageno - 1) * $results_per_page;
        $selectedproducts = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user["email"] . "' AND `condition_id`='2' LIMIT $results_per_page OFFSET $offset");
        $spn = $selectedproducts->num_rows;
    }
} else {
    $spn = 0;
    $number_of_pages = 0;
}

?>

<div class="row">
    <div class="offset-1 col-10 text-center">
        <div class="row">

            <?php
            for ($x = 0; $x < $spn; $x++) {
                $pro = $selectedproducts->fetch_assoc();
            ?>

                <div class="card mb-3 col-lg-5 col-12 mt-3 ms-lg-5 ms-0">
                    <div class="row g-0">
                        <?php
                        $pimgrs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $pro["id"] . "'");
                        $pir = $pimgrs->fetch_assoc();
                        ?>
                        <div class="col-md-4 mt-4">
                            <img src="<?php echo $pir["code"]; ?>" class="img-fluid rounded-start" />
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title fw-bold"><?php echo $pro["title"]; ?></h5>
                                <span class="card-text fw-bold text-primary">Rs. <?php echo $pro["price"]; ?>.00</span>
                                <br />
                                <span class="card-text fw-bold text-success"><?php echo $pro["qty"]; ?> Items Left</span>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="check" onchange='changeStatus(<?php echo $pro["id"]; ?>);' <?php
                                                                                                                                                                    if ($pro["status_id"] == 2) {
                                                                                                                                                                        echo "checked";
                                                                                                                                                                    }
                                                                                                                                                                    ?> />
                                    <label class="form-check-label fw-bold text-info" for="check" id="checklabel<?php echo $pro["id"]; ?>">
                                        <?php
                                        if ($pro["status_id"] == 2) {
                                            echo "Activate Product";
                                        } else {
                                            echo "Deactivate Product";
                                        }
                                        ?>
                                    </label>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12 col-lg-6">
                                            <a href="#" class="btn btn-success d-grid" onclick='sendid(<?php echo $pro["id"]; ?>)'>Update</a>
                                        </div>
                                        <div class="col-12 col-lg-6 mt-1 mt-lg-0">
                                            <a href="#" class="btn btn-danger d-grid" onclick='deleteModal(<?php echo $pro["id"]; ?>);'>Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Modal -->
                <div class="modal fade" id="deleteModal<?php echo $pro["id"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title fw-bolder text-warning" id="exampleModalLabel">Warning...</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are You Sure You Want To Delete This Product?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" data-bs-dismiss="modal">No</button>
                                <button type="button" class="btn btn-danger" onclick='deleteproduct(<?php echo $pro["id"]; ?>);'>Yes</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal -->

            <?php
            }
            ?>
        </div>
    </div>

    <!-- pagination -->
    <div class="col-12 mb-3 mt-3">
        <div class="pagination d-flex justify-content-center">
            <?php
            if ($pageno != 1) {
            ?>
                <button class=" btn btn-secondary" onclick="addFilters(<?php echo $pageno - 1; ?>);">&laquo;</button>
                <?php
            }

            for ($page = 1; $page <= $number_of_pages; $page++) {
                if ($page == $pageno) {
                ?>
                    <button class="ms-1 btn btn-dark active" onclick="addFilters(<?php echo $page; ?>);"><?php echo $page; ?></button>
                <?php
                } else {
                ?>
                    <button class="ms-1 btn btn-secondary" onclick="addFilters(<?php echo $page; ?>);"><?php echo $page; ?></button>
            <?php
                }
            }
            ?>
            <?php
            if ($pageno < $number_of_pages) {
            ?>
                <button class="ms-1 btn btn-secondary" onclick="addFilters(<?php echo $pageno + 1; ?>);">&raquo;</button>
            <?php
            }
            ?>
        </div>
    </div>
    <!-- pagination -->

</div>
<!-- product -->














<script src="script.js"></script>