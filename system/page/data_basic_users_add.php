<?php
require_once("../../include/include_top.php");

$_SESSION["PAGE_TITLE"] = "จัดการข้อมูลเจ้าหน้าที่";
$_SESSION["PAGE_NAME"] = "SYSTEM_DATA_BASIC";
$_SESSION["PAGE_SECTION"] = "SYSTEM";

require_once("../../include/include_head.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title><?= $_SESSION["PAGE_TITLE"] ?> - CSBRU Management</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />

</head>

<body>
    <div class="wrapper">
        <?php require_once("sidebar_system.php"); ?>

        <div class="main-panel">
            <?php
            require_once("nav_system.php");
            ?>

            <div class="container">
                <div class="page-inner">
                    <div class="page-header">
                        <h3 class="fw-bold mb-3"><?= $_SESSION["PAGE_TITLE"]; ?></h3>
                        <ul class="breadcrumbs mb-3">
                            <li class="nav-home">
                                <a href="index.php">
                                    <i class="fas fa-home"></i>
                                </a>
                            </li>
                            <li class="separator">
                                <i class="icon-arrow-right"></i>
                            </li>
                            <li class="nav-home">
                                <a href="data_basic.php">
                                    <i class="fas fa-database"></i>
                                </a>
                            </li>
                            <li class="separator">
                                <i class="icon-arrow-right"></i>
                            </li>
                            <li class="nav-home">
                                <a href="data_basic_users_table.php">
                                    <i class="fas fa-user-secret"></i>
                                </a>
                            </li>
                            <li class="separator">
                                <i class="icon-arrow-right"></i>
                            </li>
                            <li class="nav-item">
                                <a href="#"><?= $_SESSION["PAGE_TITLE"]; ?></a>
                            </li>
                        </ul>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-secondary">
                                <div class="card-body bubble-shadow">
                                    <form onsubmit="users_process(event,'add','');">
                                        <div class="row">
                                            <div class="col-md-12 ">
                                            </div>
                                            <div class="col-md-9">
                                                <div class="row">
                                                    <div class="col-md-3 d-flex align-items-end justify-content-start justify-content-md-end ">
                                                        <p>ชื่อ-นาสกุล : </p>
                                                    </div>
                                                    <div class="col-md-4 ">
                                                        <div class="form-group form-group-default">
                                                            <label>ชื่อ</label>
                                                            <input id="USER_FNAME" name="USER_FNAME" type="text" class="form-control ps-3" placeholder="ชื่อ" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 ">
                                                        <div class="form-group form-group-default">
                                                            <label>นามสกุล</label>
                                                            <input id="USER_LNAME" name="USER_LNAME" type="text" class="form-control ps-3" placeholder="นามสกุล" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3 d-flex align-items-end justify-content-start justify-content-md-end ">
                                                        <p>อีเมลล์ : </p>
                                                    </div>
                                                    <div class="col-md-8 ">
                                                        <div class="form-group form-group-default">
                                                            <label>อีเมลล์</label>
                                                            <input id="USER_EMAIL" name="USER_EMAIL" type="email" class="form-control ps-3" placeholder="อีเมลล์" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-3 d-flex align-items-end justify-content-start justify-content-md-end ">
                                                        <p>ชื่อผู้ใช้ : </p>
                                                    </div>
                                                    <div class="col-md-8 ">
                                                        <div class="form-group form-group-default">
                                                            <label>ชื่อผู้ใช้</label>
                                                            <input id="USER_USERNAME" name="USER_USERNAME" type="text" class="form-control ps-3" placeholder="ชื่อผู้ใช้" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3 d-flex justify-content-start justify-content-md-end ">
                                                        <p>รหัสผ่าน : </p>
                                                    </div>
                                                    <div class="col-md-8 ">
                                                        <div class="form-group form-group-default">
                                                            <label>สร้างรหัสผ่าน</label>
                                                            <input id="USER_PASSWORD" name="USER_PASSWORD" type="password" class="form-control ps-3" placeholder="สร้างรหัสผ่าน" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3 d-flex align-items-end justify-content-start justify-content-md-end ">
                                                    </div>
                                                    <div class="col-md-8 ">
                                                        <div class="form-group form-group-default">
                                                            <label>ยืนยันรหัสผ่าน</label>
                                                            <input id="USER_PASSWORD_CONFIRM" name="USER_PASSWORD_CONFIRM" type="password" class="form-control ps-3" placeholder="ยืนยันรหัสผ่าน" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 ">
                                                <div class="w-100 h-100 d-flex align-items-center justify-content-center border border-5 rounded ">
                                                    <i class="fas fa-user-secret" style="font-size: 100px;"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-12 ">
                                                <div class="d-flex justify-content-center">
                                                    <input class="btn btn-success m-3" type="submit" value="บันทึกข้อมูล">
                                                    <a class="btn btn-warning m-3" href="data_basic_users_table.php">กลับ</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

            <?php require_once("footer_system.php") ?>
        </div>
    </div>
</body>

</html>

<?php
require_once("../../include/include_botttom.php");
?>
<script src="../asset/js/script_system.js"></script>
<script src="../asset/js/script_data_basic_users.js"></script>