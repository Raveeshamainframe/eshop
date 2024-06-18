<?php

require "connection.php";

if (isset($_GET["s"])) {
    $text = $_GET["s"];
    if (!empty($text)) {

        $pageno;

        if (isset($_GET["page"])) {
            $pageno = $_GET["page"];
        } else {
            $pageno = 1;
        }


        $usersrs = Database::search("SELECT * FROM `user` WHERE `email` LIKE '%" . $text . "%' ");
        $d = $usersrs->num_rows;
        $row = $usersrs->fetch_assoc();
        $result_per_page = 20;
        $number_of_pages = ceil($d / $result_per_page);
        $page_first_result = ((int)$pageno - 1) * $result_per_page;
        $selectedrs = Database::search("SELECT * FROM `user` WHERE `email` LIKE '%" . $text . "%' LIMIT " . $result_per_page . " OFFSET " . $page_first_result . " ");
        $srn = $selectedrs->num_rows;

        $c = 0;


        while ($srow = $selectedrs->fetch_assoc()) {
            $c = $c + 1;
?>

            <div class="col-2 col-lg-1 bg-primary pt-2 pb-2 text-end">
                <span class="fs-5 fw-bold text-white"><?php echo $c; ?></span>
            </div>

            <?php
            $profileimg = Database::search("SELECT * FROM `prof_img` WHERE `user_email`='" . $srow["email"] . "' ");
            $pcode = $profileimg->fetch_assoc();
            ?>

            <div class="col-2 col-lg-2 bg-light p-1 d-none d-lg-block" onclick="viewmsgmodal();">
                <img src="<?php echo $pcode["code"]; ?>" style="height: 40px; margin-left: 80px;">
            </div>

            <div class="col-2 bg-primary pt-2 pb-2 d-none d-lg-block">
                <span class="fs-5 fw-bold text-white"><?php echo $srow["email"] ?></span>
            </div>

            <div class="col-6 col-lg-2 bg-light pt-2 pb-2">
                <span class="fs-5 fw-bold"><?php echo $srow["fname"] . " " . $srow["lname"] ?></span>
            </div>

            <div class="col-2 bg-primary pt-2 pb-2 d-none d-lg-block">
                <span class="fs-5 fw-bold text-white"><?php echo $srow["mobile"] ?></span>
            </div>

            <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block">
                <span class="fs-5 fw-bold"><?php
                                            $rd = $srow["register_date"];
                                            $splitrd = explode(" ", $rd);
                                            echo $splitrd[0];
                                            ?></span>
            </div>

            <div class="col-4 col-lg-1 bg-white d-grid p-1">
                <?php
                $s = $srow["status_id"];
                if ($s == "1") {
                ?>
                    <button class="btn btn-danger" onclick="blockuser('<?php echo $srow['email']; ?>');">Block</button>
                <?php
                } else {
                ?>
                    <button class="btn btn-success" onclick="blockuser('<?php echo $srow['email']; ?>');">Unblock</button>
                <?php
                }
                ?>
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

        <?php
    } else {

        $pageno;

        if (isset($_GET["page"])) {
            $pageno = $_GET["page"];
        } else {
            $pageno = 1;
        }


        $usersrs = Database::search("SELECT * FROM `user` ");
        $d = $usersrs->num_rows;
        $row = $usersrs->fetch_assoc();
        $result_per_page = 20;
        $number_of_pages = ceil($d / $result_per_page);
        $page_first_result = ((int)$pageno - 1) * $result_per_page;
        $selectedrs = Database::search("SELECT * FROM `user` LIMIT " . $result_per_page . " OFFSET " . $page_first_result . " ");
        $srn = $selectedrs->num_rows;

        $c = 0;

        while ($srow = $selectedrs->fetch_assoc()) {
            $c = $c + 1;
        ?>

            <div class="col-2 col-lg-1 bg-primary pt-2 pb-2 text-end">
                <span class="fs-5 fw-bold text-white"><?php echo $c; ?></span>
            </div>

            <?php
            $profileimg = Database::search("SELECT * FROM `prof_img` WHERE `user_email`='" . $srow["email"] . "' ");
            $pcode = $profileimg->fetch_assoc();
            ?>

            <div class="col-2 col-lg-2 bg-light p-1 d-none d-lg-block" onclick="viewmsgmodal();">
                <img src="<?php echo $pcode["code"]; ?>" style="height: 40px; margin-left: 80px;">
            </div>

            <div class="col-2 bg-primary pt-2 pb-2 d-none d-lg-block">
                <span class="fs-5 fw-bold text-white"><?php echo $srow["email"] ?></span>
            </div>

            <div class="col-6 col-lg-2 bg-light pt-2 pb-2">
                <span class="fs-5 fw-bold"><?php echo $srow["fname"] . " " . $srow["lname"] ?></span>
            </div>

            <div class="col-2 bg-primary pt-2 pb-2 d-none d-lg-block">
                <span class="fs-5 fw-bold text-white"><?php echo $srow["mobile"] ?></span>
            </div>

            <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block">
                <span class="fs-5 fw-bold"><?php
                                            $rd = $srow["register_date"];
                                            $splitrd = explode(" ", $rd);
                                            echo $splitrd[0];
                                            ?></span>
            </div>

            <div class="col-4 col-lg-1 bg-white d-grid p-1">
                <?php

                $s = $srow["status_id"];

                if ($s == "1") {
                ?>
                    <button class="btn btn-danger" onclick="blockuser('<?php echo $srow['email']; ?>');">Block</button>
                <?php
                } else {
                ?>
                    <button class="btn btn-success" onclick="blockuser('<?php echo $srow['email']; ?>');">Unblock</button>
                <?php
                }


                ?>

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
<?php
    }
}

?>