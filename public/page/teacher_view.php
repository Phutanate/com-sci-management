<?php
require_once("../../include/include_top.php");

$_SESSION["PAGE_TITLE"] = "อาจารย์";
$_SESSION["PAGE_NAME"] = "PUBLIC_TEACHER";
$_SESSION["PAGE_SECTION"] = "PUBLIC";

require_once("../../include/include_head.php");

if (isset($_GET['tc_id'])) {
    $tc_id = base64_decode($_GET['tc_id']);
    $SQL_teacher = "SELECT * FROM teacher WHERE tc_id = '" . $tc_id . "'";
    $data_main = data_Fetch($SQL_teacher);
} else {
    $data_main['tc_id'] = "";
    $data_main['tc_fname_th'] = "";
    $data_main['tc_lname_th'] = "";
    $data_main['tc_fname_en'] = "";
    $data_main['tc_lname_en'] = "";
    $data_main['tc_number_id'] = "";
    $data_main['prefix_id'] = "";
    $data_main['gender_id'] = "";
    $data_main['tp_id'] = "";
}

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
                            <li class="nav-item">
                                <a href="teacher_table.php">
                                    <i class="fas fa-user-graduate"></i>
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
                                    <div class="row">
                                        <div class="col-md-12 ">
                                        </div>
                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col-md-3 d-flex justify-content-start justify-content-md-end ">
                                                    <h2>ชื่อ-นามสกุล : </h2>
                                                </div>
                                                <div class="col-md-8">
                                                    <span></span>
                                                    <h2><?= get_teacher_name($data_main['tc_id'], "TH") ?></h2>
                                                    <h6> <?= get_teacher_name($data_main['tc_id'], "EN") ?></h6>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3 d-flex justify-content-start justify-content-md-end ">
                                                    <h4>เพศ : </h4>
                                                </div>
                                                <div class="col-md-8 ">
                                                    <?php
                                                    $SQL_gender = "SELECT * FROM gender WHERE gender_id = '" . $data_main['gender_id'] . "'";
                                                    $result_gender = data_Fetch($SQL_gender);
                                                    ?>
                                                    <h4><?= $result_gender['gender_name_th'] ?></h4>
                                                    <h6> <?= $result_gender['gender_name_en'] ?></h6>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3 d-flex justify-content-start justify-content-md-end ">
                                                    <h4>ตำแหน่ง : </h4>
                                                </div>
                                                <div class="col-md-8 ">
                                                    <?php
                                                    $SQL_teacher_position = "SELECT * FROM teacher_position WHERE tp_id = '" . $data_main['tp_id'] . "'";
                                                    $result_teacher_position = data_Fetch($SQL_teacher_position);
                                                    ?>
                                                    <h4><?= $result_teacher_position['tp_name_th'] ?></h4>
                                                    <h6> <?= $result_teacher_position['tp_name_en'] ?></h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 ">
                                            <div class="w-100 h-100 d-flex align-items-center justify-content-center border border-5 rounded ">
                                                <i class="fas fa-user-tie" style="font-size: 100px;"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-12 ">
                                            <div class="d-flex justify-content-center">
                                                <a class="btn btn-warning m-3" href="teacher_table.php">กลับ</a>
                                            </div>
                                        </div>
                                    </div>
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
<script src="../asset/js/script_teacher.js"></script>