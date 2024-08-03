<?php
require_once("../../include/include_top.php");

$_SESSION["PAGE_TITLE"] = "จัดการข้อมูลตำแหน่งอาจารย์";
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
                                <a href="data_basic_teacher_position_table.php">
                                    <i class="fas fa-layer-group"></i>
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
                                    <form onsubmit="teacher_position_process(event,'add','');">
                                        <div class="row">
                                            <div class="col-md-12 ">
                                            </div>
                                            <div class="col-md-9">
                                                <div class="row">
                                                    <div class="col-md-3 d-flex align-items-end justify-content-start justify-content-md-end ">
                                                        <p>ชื่อตำแหน่ง : </p>
                                                    </div>
                                                    <div class="col-md-8 ">
                                                        <div class="form-group form-group-default">
                                                            <label>ชื่อตำแหน่ง TH</label>
                                                            <input id="TP_NAME_TH" name="TP_NAME_TH" type="text" class="form-control ps-3" placeholder="ชื่อตำแหน่ง TH" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3 d-flex align-items-end justify-content-start justify-content-md-end ">
                                                    </div>
                                                    <div class="col-md-8 ">
                                                        <div class="form-group form-group-default">
                                                            <label>ชื่อตำแหน่ง EN</label>
                                                            <input id="TP_NAME_EN" name="TP_NAME_EN" type="text" class="form-control ps-3" placeholder="ชื่อตำแหน่ง EN" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 ">
                                                <div class="w-100 h-100 d-flex align-items-center justify-content-center border border-5 rounded ">
                                                    <i class="fas fa-layer-group" style="font-size: 100px;"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-12 ">
                                                <div class="d-flex justify-content-center">
                                                    <input class="btn btn-success m-3" type="submit" value="บันทึกข้อมูล">
                                                    <a class="btn btn-warning m-3" href="data_basic_teacher_position_table.php">กลับ</a>
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
<script src="../asset/js/script_data_basic_teacher_position.js"></script>