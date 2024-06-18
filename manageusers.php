<?php
require "connection.php";

session_start();

$pageno;

$email = $_SESSION["u"]["email"];
// $email = $_GET["email"];

?>

<!DOCTYPE html>

<html>

<head>
    <title>eShop | Admin | Manage Users</title>

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
                <label class="form-label fs-2 fw-bold text-primary">Manage All Users</label>
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
                        <span class="fs-4 fw-bold">Profile Image</span>
                    </div>

                    <div class="col-2 bg-primary pt-2 pb-2 d-none d-lg-block">
                        <span class="fs-4 fw-bold text-white">Email</span>
                    </div>

                    <div class="col-6 col-lg-2 bg-light pt-2 pb-2">
                        <span class="fs-4 fw-bold">User Name</span>
                    </div>

                    <div class="col-2 bg-primary pt-2 pb-2 d-none d-lg-block">
                        <span class="fs-4 fw-bold text-white">Mobile</span>
                    </div>

                    <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block">
                        <span class="fs-4 fw-bold">Register Date</span>
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


            $usersrs = Database::search("SELECT * FROM `user` ");
            $d = $usersrs->num_rows;
            $row = $usersrs->fetch_assoc();
            $result_per_page = 20;
            $number_of_pages = ceil($d / $result_per_page);
            $page_first_result = ((int)$pageno - 1) * $result_per_page;
            $selectedrs = Database::search("SELECT * FROM `user` LIMIT " . $result_per_page . " OFFSET " . $page_first_result . " ");
            $srn = $selectedrs->num_rows;

            $c = 0;
            ?>




            <div class="col-12 mb-2">
                <div class="row" id="utable">

                    <?php
                    while ($srow = $selectedrs->fetch_assoc()) {
                        $c = $c + 1;
                    ?>

                        <div class="col-2 col-lg-1 bg-primary pt-2 pb-2 text-end mt-1">
                            <span class="fs-5 fw-bold text-white"><?php echo $c; ?></span>
                        </div>

                        <?php
                        $profileimg = Database::search("SELECT * FROM `prof_img` WHERE `user_email`='" . $srow["email"] . "' ");
                        $pcode = $profileimg->fetch_assoc();
                        ?>

                        <div class="col-2 col-lg-2 bg-light p-1 d-none d-lg-block mt-1" onclick="viewmsgmodal();">
                            <img src="<?php echo $pcode["code"]; ?>" style="height: 40px; margin-left: 80px;">
                        </div>

                        <div class="col-2 bg-primary pt-2 pb-2 d-none d-lg-block mt-1">
                            <span class="fs-5 fw-bold text-white"><?php echo $srow["email"] ?></span>
                        </div>

                        <div class="col-6 col-lg-2 bg-light pt-2 pb-2 mt-1">
                            <span class="fs-5 fw-bold"><?php echo $srow["fname"] . " " . $srow["lname"] ?></span>
                        </div>

                        <div class="col-2 bg-primary pt-2 pb-2 d-none d-lg-block mt-1">
                            <span class="fs-5 fw-bold text-white"><?php echo $srow["mobile"] ?></span>
                        </div>

                        <div class="col-2 bg-light pt-2 pb-2 d-none d-lg-block mt-1">
                            <span class="fs-5 fw-bold"><?php
                                                        $rd = $srow["register_date"];
                                                        $splitrd = explode(" ", $rd);
                                                        echo $splitrd[0];
                                                        ?></span>
                        </div>

                        <div class="col-4 col-lg-1 bg-white d-grid p-1 mt-1">
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


                    <!-- Modal -->
                    <div class="modal fade" id="msgmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">My Messages</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- ..... -->

                                    <div class="col-12 py-5 px-4">
                                        <div class="row rounded-lg overflow-hidden shadow">
                                            <div class="col-5 px-0">
                                                <div class="bg-white">

                                                    <div class="bg-gray px-4 py-2 bg-light">
                                                        <p class="h5 mb-0 py-1">Recent</p>
                                                    </div>

                                                    <div class="messages-box">
                                                        <div class="list-group rounded-0" id="rcv">



                                                        </div>
                                                    </div>

                                                </div>

                                            </div>

                                            <!-- massage box -->
                                            <div class="col-7 px-0">
                                                <div class="row px-4 py-5 chat-box bg-white" id="chatrow">
                                                    <!-- massage load venne methana -->


                                                </div>
                                            </div>

                                            <div class="offset-5 col-7">
                                                <div class="row bg-white">

                                                    <!-- text -->
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="input-group">
                                                                <input type="text" id="msgtxt" placeholder="Type a message" aria-describedby="button-addon2" class="form-control rounded-0 border-0 py-4 bg-light">
                                                                <div class="input-group-append">
                                                                    <button id="button-addon2" class="btn btn-link fs-1" onclick="sendmessage('<?php echo $email; ?>');"> <i class="bi bi-cursor-fill"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- text -->

                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <!-- .... -->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-danger">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>

            <?php require "footer.php"; ?>
        </div>
    </div>
    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
</body>

</html>