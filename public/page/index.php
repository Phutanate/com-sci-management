<?php
require_once("../../include/include_top.php");

$_SESSION["PAGE_TITLE"] = "หน้าหลัก";
$_SESSION["PAGE_NAME"] = "PUBLIC_HOME";
$_SESSION["PAGE_SECTION"] = "PUBLIC";

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
        <?php require_once("sidebar_public.php"); ?>

        <div class="main-panel">
            <?php
            require_once("nav_public.php");
            ?>

            <div class="container">
                <div class="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row justify-content-center align-items-center mb-5">
                                <div class="col-md-3 ps-md-0">
                                    <a href="student_table.php" class="hover-zoom">
                                        <div class="card-pricing2 card-success">
                                            <div class="pricing-header">
                                                <h3 class="fw-bold mb-3">นักศึกษา</h3>
                                                <span class="sub-title"><i class="fas fa-user-graduate"></i></span>
                                            </div>
                                            <div class="price-value">
                                                <div class="value">
                                                    <span class="currency"></span>
                                                    <span class="amount"><?= data_row("student", "delete_flag = '0'"); ?></span>
                                                    <span class="month">คน</span>
                                                </div>
                                            </div>
                                            <ul class="pricing-content">
                                                <li>
                                                    <div class="d-flex justify-content-between pe-2">
                                                        <span>กำลังศึกษา</span>
                                                        <span><?= data_row("student", "delete_flag = '0' AND std_status = '1'"); ?></span>
                                                        <span>คน</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="d-flex justify-content-between pe-2">
                                                        <span>จบการศึกษา</span>
                                                        <span><?= data_row("student", "delete_flag = '0' AND std_status = '2'"); ?></span>
                                                        <span>คน</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="d-flex justify-content-between pe-2">
                                                        <span>พ้นสภาพนักศึกษา</span>
                                                        <span><?= data_row("student", "delete_flag = '0' AND std_status = '3'"); ?></span>
                                                        <span>คน</span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-3 ps-md-0 pe-md-0">
                                    <a href="teacher_table.php" class="hover-zoom">
                                        <div class="card-pricing2 card-primary">
                                            <div class="pricing-header">
                                                <h3 class="fw-bold mb-3">อาจารย์</h3>
                                                <span class="sub-title"><i class="fas fa-user-tie"></i></span>
                                            </div>
                                            <div class="price-value">
                                                <div class="value">
                                                    <span class="currency"></span>
                                                    <span class="amount"><?= data_row("teacher", "delete_flag = '0'"); ?></span>
                                                    <span class="month">ท่าน</span>
                                                </div>
                                            </div>
                                            <ul class="pricing-content">
                                                <li>
                                                    <div class="d-flex justify-content-between pe-2">
                                                        <span>อาจารย์ทั้งหมด</span>
                                                        <span><?= data_row("teacher", "delete_flag = '0'"); ?></span>
                                                        <span>ท่าน</span>
                                                    </div>
                                                </li>
                                                <li class="disable">
                                                    <div class="d-flex justify-content-between pe-2">
                                                        <span>-</span>
                                                    </div>
                                                </li>
                                                <li class="disable">
                                                    <div class="d-flex justify-content-between pe-2">
                                                        <span>-</span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-3 pe-md-0">
                                    <a href="thesis_table.php" class="hover-zoom">
                                        <div class="card-pricing2 card-secondary">
                                            <div class="pricing-header">
                                                <h3 class="fw-bold mb-3">โครงงาน/ปริญญานิพนธ์</h3>
                                                <span class="sub-title"><i class="fas fa-newspaper"></i></span>
                                            </div>
                                            <div class="price-value">
                                                <div class="value">
                                                    <span class="currency"></span>
                                                    <span class="amount"><?= data_row("thesis", "delete_flag = '0'"); ?></span>
                                                    <span class="month">รายการ</span>
                                                </div>
                                            </div>
                                            <ul class="pricing-content">
                                                <li>
                                                    <div class="d-flex justify-content-between pe-2">
                                                        <span>ผ่านโครงงาน 2 แล้ว</span>
                                                        <span><?= data_row("thesis", "delete_flag = '0' AND ts_status_4 = '1'"); ?></span>
                                                        <span>รายการ</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="d-flex justify-content-between pe-2">
                                                        <span>ผ่านโครงงาน 1 แล้ว</span>
                                                        <span><?= data_row("thesis", "delete_flag = '0' AND ts_status_2 = '1' AND ts_status_4 = '0'"); ?></span>
                                                        <span>รายการ</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="d-flex justify-content-between pe-2">
                                                        <span>อยู่ระหว่างดำเนินงาน</span>
                                                        <span><?= data_row("thesis", "delete_flag = '0' AND ts_status_1 = '1' AND ts_status_2 = '0'"); ?></span>
                                                        <span>รายการ</span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php require_once("footer_public.php") ?>
        </div>
    </div>
</body>

</html>

<?php
require_once("../../include/include_botttom.php");
?>
<script src="../asset/js/script_public.js"></script>