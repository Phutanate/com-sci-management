<?php
require_once("../../include/include_top.php");

$_SESSION["PAGE_TITLE"] = "จัดการข้อมูลอาจารย์";
$_SESSION["PAGE_NAME"] = "SYSTEM_TEACHER";
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
                            <li class="nav-item">
                                <a href="teacher_table.php">
                                    <i class="fas fa-user-tie"></i>
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
                                    <form onsubmit="teacher_process(event,'add','');">
                                        <div class="row">
                                            <div class="col-md-12 ">
                                            </div>
                                            <div class="col-md-9">
                                                <div class="row">
                                                    <div class="col-md-3 d-flex align-items-end justify-content-start justify-content-md-end ">
                                                        <p>ชื่อ-นามสกุล : </p>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group form-group-default">
                                                            <label>คำนำหน้าชื่อ TH</label>
                                                            <select class="form-select form-control ps-3" id="PREFIX_ID" name="PREFIX_ID" onchange="change_prefix_en()">
                                                                <option value="">เลือก</option>
                                                                <?php
                                                                $SQL_prefix = "SELECT prefix_id,prefix_name_th FROM prefix WHERE delete_flag = '0'";
                                                                $result_prefix = data_FetchAll($SQL_prefix);

                                                                foreach ($result_prefix as $key_prefix => $value_prefix) {
                                                                ?>
                                                                    <option value="<?= $value_prefix['prefix_id'] ?>"><?= $value_prefix['prefix_name_th'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 ">
                                                        <div class="form-group form-group-default">
                                                            <label>ชื่อ TH</label>
                                                            <input id="TC_FNAME_TH" name="TC_FNAME_TH" type="text" class="form-control ps-3" placeholder="ชื่อ TH" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 ">
                                                        <div class="form-group form-group-default">
                                                            <label>นามสกุล TH</label>
                                                            <input id="TC_LNAME_TH" name="TC_LNAME_TH" type="text" class="form-control ps-3" placeholder="นามสกุล TH" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3 d-flex justify-content-start justify-content-md-end ">
                                                    </div>
                                                    <div class="col-md-2 ">
                                                        <div class="form-group form-group-default">
                                                            <label>คำนำหน้าชื่อ EN</label>
                                                            <select class="form-select form-control ps-3" id="PREFIX_ID_EN" name="PREFIX_ID_EN" disabled>
                                                                <option value="">เลือก</option>
                                                                <?php
                                                                $SQL_prefix = "SELECT prefix_id,prefix_name_en FROM prefix WHERE delete_flag = '0'";
                                                                $result_prefix = data_FetchAll($SQL_prefix);

                                                                foreach ($result_prefix as $key_prefix => $value_prefix) {
                                                                ?>
                                                                    <option value="<?= $value_prefix['prefix_id'] ?>"><?= $value_prefix['prefix_name_en'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 ">
                                                        <div class="form-group form-group-default">
                                                            <label>ชื่อ EN</label>
                                                            <input id="TC_FNAME_EN" name="TC_FNAME_EN" type="text" class="form-control ps-3" placeholder="ชื่อ EN" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 ">
                                                        <div class="form-group form-group-default">
                                                            <label>นามสกุล EN</label>
                                                            <input id="TC_LNAME_EN" name="TC_LNAME_EN" type="text" class="form-control ps-3" placeholder="นามสกุล EN" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3 d-flex justify-content-start justify-content-md-end ">
                                                        <p>เพศ : </p>
                                                    </div>
                                                    <div class="col-md-4 ">
                                                        <div class="form-group form-group-default">
                                                            <label>เพศ TH</label>
                                                            <select class="form-select form-control ps-3" id="GENDER_ID" name="GENDER_ID" onchange="change_gender_en()">
                                                                <option value="">เลือก</option>
                                                                <?php
                                                                $SQL_gender = "SELECT gender_id,gender_name_th FROM gender WHERE delete_flag = '0'";
                                                                $result_gender = data_FetchAll($SQL_gender);

                                                                foreach ($result_gender as $key_gender => $value_gender) {
                                                                ?>
                                                                    <option value="<?= $value_gender['gender_id'] ?>"><?= $value_gender['gender_name_th'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 ">
                                                        <div class="form-group form-group-default">
                                                            <label>เพศ EN</label>
                                                            <select class="form-select form-control ps-3" id="GENDER_ID_EN" name="GENDER_ID_EN" disabled>
                                                                <option value="">เลือก</option>
                                                                <?php
                                                                $SQL_gender = "SELECT gender_id,gender_name_en FROM gender WHERE delete_flag = '0'";
                                                                $result_gender = data_FetchAll($SQL_gender);

                                                                foreach ($result_gender as $key_gender => $value_gender) {
                                                                ?>
                                                                    <option value="<?= $value_gender['gender_id'] ?>"><?= $value_gender['gender_name_en'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3 d-flex justify-content-start justify-content-md-end ">
                                                        <p>ตำแหน่ง : </p>
                                                    </div>
                                                    <div class="col-md-4 ">
                                                        <div class="form-group form-group-default">
                                                            <label>ตำแหน่ง</label>
                                                            <select class="form-select form-control ps-3" id="TP_ID" name="TP_ID" onchange="change_academic_year()">
                                                                <option value="">เลือก</option>
                                                                <?php
                                                                $SQL_teacher_position = "SELECT * FROM teacher_position WHERE delete_flag = '0'";
                                                                $result_teacher_position = data_FetchAll($SQL_teacher_position);

                                                                foreach ($result_teacher_position as $key_tp => $value_tp) {
                                                                ?>
                                                                    <option value="<?= $value_tp['tp_id'] ?>"><?= $value_tp['tp_name_th'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
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
                                                    <input class="btn btn-success m-3" type="submit" value="บันทึกข้อมูล">
                                                    <a class="btn btn-warning m-3" href="teacher_table.php">กลับ</a>
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
<script src="../asset/js/script_teacher.js"></script>