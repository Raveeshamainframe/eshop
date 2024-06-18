<?php
require "connection.php";
?>

<!DOCTYPE html>

<html>

<head>
    <title>eShop|User Profile</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="userprofile.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="bg-primary">

    <?php

    session_start();

    if (isset($_SESSION["u"])) {
    ?>

        <div class="container-fluid bg-white rounded mt-5 mb-5">
            <div class="row">
                <div class="col-md-3 border-end">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <?php
                        $profileimg = Database::search("SELECT * FROM `prof_img` WHERE `user_email`='" . $_SESSION["u"]["email"] . "' ");
                        $pn = $profileimg->num_rows;
                        if ($pn == 1) {
                            $p = $profileimg->fetch_assoc();
                        ?>
                            <img class="rounded mt-5" width="150px" src="<?php echo $p["code"] ?>" />
                        <?php
                        } else {
                        ?>
                            <img class="rounded mt-5" width="150px" src="resources/profiles/profile.png" />
                        <?php
                        }
                        ?>
                        <span class="font-weight-bold"><?php echo $_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"] ?></span>
                        <span class="text-black-50"> <?php echo $_SESSION["u"]["email"] ?> </span>
                        <input class="d-none" type="file" id="profileimg" accept="img/*" />
                        <label class="btn btn-primary mt-3" for="profileimg">Update Profile Image</label>
                    </div>
                </div>
                <div class="col-md-5 border-end">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4>Profile Settings</h4>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="form-label">Name</label>
                                <input type="text" id="fname" class="form-control" placeholder="first name" value="<?php echo $_SESSION["u"]["fname"] ?>" />
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Surname</label>
                                <input type="text" id="lname" class="form-control" placeholder="last name" value="<?php echo $_SESSION["u"]["lname"] ?>" />
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Mobile Number</label>
                                <input type="text" id="mobile" class="form-control" placeholder="enter phone number" value="<?php echo $_SESSION["u"]["mobile"] ?>" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Password</label>
                                <input type="text" id="password" class="form-control" placeholder="enter password" readonly value="<?php echo $_SESSION["u"]["password"] ?>" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="text" id="email" class="form-control" placeholder="enter email id" readonly value="<?php echo $_SESSION["u"]["email"] ?>" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Registered Date</label>
                                <input type="text" class="form-control" placeholder="registerd date" readonly value="<?php echo $_SESSION["u"]["register_date"] ?>" />
                            </div>

                            <?php

                            $usermail = $_SESSION["u"]["email"];
                            $address = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`= '" . $usermail . "' ");
                            $n = $address->num_rows;

                            if ($n > 0) {
                                $d = $address->fetch_assoc();

                            ?>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Address Line 01</label>
                                    <input type="text" id="line1" class="form-control" placeholder="enter address line 01" value="<?php echo $d["line1"] ?>" />
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Address Line 02</label>
                                    <input type="text" id="line2" class="form-control" placeholder="enter address line 02" value="<?php echo $d["line2"] ?>" />
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Province</label>
                                    <?php
                                    $usermail = $_SESSION["u"]["email"];
                                    $pdc = Database::search("SELECT * FROM user_has_address INNER JOIN city ON city.cid = user_has_address.city_cid INNER JOIN district ON district.did = city.district_did INNER JOIN province ON province.pid = district.province_pid WHERE `user_email`= '" . $usermail . "' ");
                                    $pdcn = $pdc->fetch_assoc();
                                    ?>
                                    <div class="col-12 mb-3">
                                        <select class="form-select" id="pro">
                                            <option value="<?php echo $pdcn["pid"] ?>"><?php echo $pdcn["pname"] ?></option>
                                            <?php

                                            $rs1 = Database::search("SELECT * FROM `province` WHERE `pname` != '" . $pdcn["pname"] . "' ");
                                            $n1 = $rs1->num_rows;

                                            for ($i = 1; $i <= $n1; $i++) {
                                                $prov = $rs1->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $prov["pid"] ?>"><?php echo $prov["pname"] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">District</label>
                                    <div class="col-12 mb-3">
                                        <select class="form-select" id="dis">
                                            <option value="<?php echo $pdcn["did"] ?>"><?php echo $pdcn["dname"] ?></option>
                                            <?php

                                            $rs2 = Database::search("SELECT * FROM `district` WHERE `dname` != '" . $pdcn["dname"] . "' ");
                                            $n2 = $rs2->num_rows;

                                            for ($i = 1; $i <= $n2; $i++) {
                                                $dis = $rs2->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $dis["did"] ?>"><?php echo $dis["dname"] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <label class="form-label">City</label>
                                        <div class="col-12 mb-3">
                                            <select class="form-select" id="city">
                                                <option value="<?php echo $pdcn["cid"] ?>"><?php echo $pdcn["cname"] ?></option>
                                                <?php
                                                $rs1 = Database::search("SELECT * FROM `city` WHERE `cname` != '" . $pdcn["cname"] . "' ");
                                                $n1 = $rs1->num_rows;

                                                for ($i = 1; $i <= $n1; $i++) {
                                                    $city = $rs1->fetch_assoc();
                                                ?>
                                                    <option value="<?php echo $city["cid"] ?>"><?php echo $city["cname"] ?></option>
                                                <?php
                                                }

                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Postal Code</label>
                                        <input type="text" id="ps_code" class="form-control" placeholder="Enter Your Postal Code" value="<?php echo $pdcn["postal_code"] ?>" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Gender</label>

                                        <?php
                                        $genderid = $_SESSION["u"]["gender_id"];
                                        $gen = Database::search("SELECT * FROM `gender` WHERE `id`= '" . $genderid . "' ");
                                        $d2 = $gen->fetch_assoc();
                                        ?>

                                        <input type="text" class="form-control" placeholder="gender" readonly value="<?php echo $d2["name"] ?>" />
                                    </div>

                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Address Line 01</label>
                                    <input type="text" id="line1" class="form-control" placeholder="enter address line 01" value="" />
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Address Line 02</label>
                                    <input type="text" id="line2" class="form-control" placeholder="enter address line 02" value="" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Province</label>
                                    <div class="col-12 mb-3">
                                        <select class="form-select" id="pro">
                                            <option value="0">Select your province</option>
                                            <?php

                                            $rs1 = Database::search("SELECT * FROM `province` ");
                                            $n1 = $rs1->num_rows;

                                            for ($i = 1; $i <= $n1; $i++) {
                                                $prov = $rs1->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $prov["pid"] ?>"><?php echo $prov["pname"] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">District</label>
                                    <div class="col-12 mb-3">
                                        <select class="form-select" id="dis">
                                            <option value="0">Select your district</option>
                                            <?php
                                            $rs2 = Database::search("SELECT * FROM `district` ");
                                            $n2 = $rs2->num_rows;

                                            for ($i = 1; $i <= $n2; $i++) {
                                                $dis = $rs2->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $dis["did"] ?>"><?php echo $dis["dname"] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                              
                                <div class="col-md-6">
                                    <label class="form-label">City</label>
                                    <div class="col-12 mb-3">
                                        <select class="form-select" id="city">
                                            <option value="0">Select your city</option>
                                            <?php
                                            $rs1 = Database::search("SELECT * FROM `city` ");
                                            $n1 = $rs1->num_rows;

                                            for ($i = 1; $i <= $n1; $i++) {
                                                $city = $rs1->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $city["cid"] ?>"><?php echo $city["cname"] ?></option>
                                            <?php
                                            }

                                            ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Postal Code</label>
                                    <input type="text" id="ps_code" class="form-control" placeholder="Enter Your Postal Code" value="" />
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Gender</label>

                                    <?php
                                    $genderid = $_SESSION["u"]["gender_id"];
                                    $gen = Database::search("SELECT * FROM `gender` WHERE `id`= '" . $genderid . "' ");
                                    $d2 = $gen->fetch_assoc();
                                    ?>

                                    <input type="text" class="form-control" placeholder="gender" readonly value="<?php echo $d2["name"] ?>" />
                                </div>

                            <?php
                            }
                            ?>

                            <div class="mt-5 text-center">
                                <button class="btn btn-primary" onclick="updateProfile();">Update Profile</button>
                            </div>                      
                        </div>
                    </div>
                </div>


            <?php
        } else {
            ?>
                <script>
                    window.location = "index.php";
                </script>
            <?php
        }
            ?>



            <div class="col-md-4">
                <div class="p-3 py-5">
                    <div class="col-md-12">
                        <span class="header">User Rating</span>
                        <span class="fa fa-star fs-4 text-warning"></span>
                        <span class="fa fa-star fs-4 text-warning"></span>
                        <span class="fa fa-star fs-4 text-warning"></span>
                        <span class="fa fa-star fs-4 text-warning"></span>
                        <span class="fa fa-star fs-4 text-black-50"></span>
                        <p>4.1 average based on 254 reviews.</p>
                        <hr class="hrbreak1" />
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 side">
                                <span>5 Star</span>
                            </div>
                            <div class="col-12">
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 60%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-12 text-end">
                                <span>150</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 side">
                                <span>4 Star</span>
                            </div>
                            <div class="col-12">
                                <div class="progress">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 50%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-12 text-end">
                                <span>63</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 side">
                                <span>3 Star</span>
                            </div>
                            <div class="col-12">
                                <div class="progress">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 15%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-12 text-end">
                                <span>15</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 side">
                                <span>2 Star</span>
                            </div>
                            <div class="col-12">
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 5%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-12 text-end">
                                <span>6</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 side">
                                <span>1 Star</span>
                            </div>
                            <div class="col-12">
                                <div class="progress">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 30%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-12 text-end">
                                <span>20</span>
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


        <script src="userprofile.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</body>

</html>