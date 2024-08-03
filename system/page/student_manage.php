<?php
require_once("../../include/include_top.php");

$_SESSION["PAGE_TITLE"] = "จัดการข้อมูลนักศึกษา";
$_SESSION["PAGE_NAME"] = "SYSTEM_STUDENT";
$_SESSION["PAGE_SECTION"] = "SYSTEM";

require_once("../../include/include_head.php");

if (isset($_GET['std_id'])) {
    $std_id = base64_decode($_GET['std_id']);
    $SQL_student = "SELECT * FROM student WHERE std_id = '" . $std_id . "'";
    $data_main = data_Fetch($SQL_student);
} else {
    $data_main['std_id'] = "";
    $data_main['std_fname_th'] = "";
    $data_main['std_lname_th'] = "";
    $data_main['std_fname_en'] = "";
    $data_main['std_lname_en'] = "";
    $data_main['std_status'] = "";
    $data_main['std_number_id'] = "";
    $data_main['prefix_id'] = "";
    $data_main['gender_id'] = "";
    $data_main['major_id'] = "";
    $data_main['faculty_id'] = "";
    $data_main['ay_id'] = "";
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
                                <a href="student_table.php">
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
                                    <form onsubmit="student_process(event,'edit','<?= base64_encode($data_main['std_id']) ?>');">
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
                                                                    <option value="<?= $value_prefix['prefix_id'] ?>" <?= ($data_main['prefix_id'] == $value_prefix['prefix_id']) ? 'selected' : '' ?>><?= $value_prefix['prefix_name_th'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 ">
                                                        <div class="form-group form-group-default">
                                                            <label>ชื่อ TH</label>
                                                            <input id="STD_FNAME_TH" name="STD_FNAME_TH" type="text" class="form-control ps-3" placeholder="ชื่อ TH" value="<?= $data_main['std_fname_th'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 ">
                                                        <div class="form-group form-group-default">
                                                            <label>นามสกุล TH</label>
                                                            <input id="STD_LNAME_TH" name="STD_LNAME_TH" type="text" class="form-control ps-3" placeholder="นามสกุล TH" value="<?= $data_main['std_lname_th'] ?>">
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
                                                                    <option value="<?= $value_prefix['prefix_id'] ?>" <?= ($data_main['prefix_id'] == $value_prefix['prefix_id']) ? 'selected' : '' ?>><?= $value_prefix['prefix_name_en'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 ">
                                                        <div class="form-group form-group-default">
                                                            <label>ชื่อ EN</label>
                                                            <input id="STD_FNAME_EN" name="STD_FNAME_EN" type="text" class="form-control ps-3" placeholder="ชื่อ EN" value="<?= $data_main['std_fname_en'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 ">
                                                        <div class="form-group form-group-default">
                                                            <label>นามสกุล EN</label>
                                                            <input id="STD_LNAME_EN" name="STD_LNAME_EN" type="text" class="form-control ps-3" placeholder="นามสกุล EN" value="<?= $data_main['std_lname_en'] ?>">
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
                                                                    <option value="<?= $value_gender['gender_id'] ?>" <?= ($data_main['gender_id'] == $value_gender['gender_id']) ? 'selected' : '' ?>><?= $value_gender['gender_name_th'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 ">
                                                        <div class="form-group form-group-default">
                                                            <label>เพศ EN</label>
                                                            <select class="form-select form-control ps-3" id="GENDER_ID_EN" name="GENDER_ID_EN">
                                                                <option value="">เลือก</option>
                                                                <?php
                                                                $SQL_gender = "SELECT gender_id,gender_name_en FROM gender WHERE delete_flag = '0'";
                                                                $result_gender = data_FetchAll($SQL_gender);

                                                                foreach ($result_gender as $key_gender => $value_gender) {
                                                                ?>
                                                                    <option value="<?= $value_gender['gender_id'] ?>" <?= ($data_main['gender_id'] == $value_gender['gender_id']) ? 'selected' : '' ?>><?= $value_gender['gender_name_en'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3 d-flex justify-content-start justify-content-md-end ">
                                                        <p>รุ่นปีการศึกษา : </p>
                                                    </div>
                                                    <div class="col-md-4 ">
                                                        <div class="form-group form-group-default">
                                                            <label>รุ่นปีการศึกษา</label>
                                                            <select class="form-select form-control ps-3" id="AY_ID" name="AY_ID" onchange="change_academic_year()">
                                                                <option value="">เลือก</option>
                                                                <?php
                                                                $SQL_academic_year = "SELECT * FROM academic_year WHERE delete_flag = '0'";
                                                                $result_academic_year = data_FetchAll($SQL_academic_year);

                                                                foreach ($result_academic_year as $key_ay => $value_ay) {
                                                                ?>
                                                                    <option value="<?= $value_ay['ay_id'] ?>" <?= ($data_main['ay_id'] == $value_ay['ay_id']) ? 'selected' : '' ?>><?= $value_ay['ay_year'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 ">
                                                        <div class="form-group form-group-default">
                                                            <label>ชั้นปี</label>
                                                            <input id="STD_ACADEMIC_YEAR" name="STD_ACADEMIC_YEAR" type="text" class="form-control ps-3" placeholder="ชั้นปี" value="<?= get_academic_year($data_main['ay_id']) ?>" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3 d-flex justify-content-start justify-content-md-end ">
                                                        <p>รหัสนักศึกษา : </p>
                                                    </div>
                                                    <div class="col-md-8 ">
                                                        <div class="form-group form-group-default">
                                                            <label>รหัสนักศึกษา</label>
                                                            <input id="STD_NUMBER_ID" name="STD_NUMBER_ID" type="text" class="form-control ps-3" placeholder="รหัสนักศึกษา" value="<?= $data_main['std_number_id'] ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-3 d-flex align-items-end justify-content-start justify-content-md-end mb-3">
                                                        <p>สถานะการศึกษา : </p>
                                                    </div>
                                                    <div class="col-md-8 ">
                                                        <div class="form-group">
                                                            <div class="d-flex">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="STD_STATUS" id="STD_STATUS_1" value="1" <?= ($data_main['std_status'] == '1') ? 'checked' : '' ?>>
                                                                    <label class="form-check-label text-light" for="STD_STATUS_1">
                                                                        กำลังศึกษา
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="STD_STATUS" id="STD_STATUS_2" value="2" <?= ($data_main['std_status'] == '2') ? 'checked' : '' ?>>
                                                                    <label class="form-check-label text-light" for="STD_STATUS_2">
                                                                        จบการศึกษา
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="STD_STATUS" id="STD_STATUS_3" value="3" <?= ($data_main['std_status'] == '3') ? 'checked' : '' ?>>
                                                                    <label class="form-check-label text-light" for="STD_STATUS_3">
                                                                        พ้นสภาพนักศึกษา
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3 d-flex justify-content-start justify-content-md-end ">
                                                        <p>สาขา : </p>
                                                    </div>
                                                    <div class="col-md-4 ">
                                                        <div class="form-group form-group-default">
                                                            <label>สาขา TH</label>
                                                            <select class="form-select form-control ps-3" id="MAJOR_ID" name="MAJOR_ID" disabled>
                                                                <option value="">เลือก</option>
                                                                <?php
                                                                $SQL_major = "SELECT major_id,name_in_thai FROM major WHERE delete_flag = '0'";
                                                                $result_major = data_FetchAll($SQL_major);

                                                                foreach ($result_major as $key_major => $value_major) {
                                                                ?>
                                                                    <option value="<?= $value_major['major_id'] ?>" <?= ($data_main['major_id'] == $value_major['major_id'] || $value_major['major_id'] == 17) ? 'selected' : '' ?>><?= $value_major['name_in_thai'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 ">
                                                        <div class="form-group form-group-default">
                                                            <label>สาขา EN</label>
                                                            <select class="form-select form-control ps-3" id="MAJOR_ID_EN" name="MAJOR_ID_EN" disabled>
                                                                <option value="">เลือก</option>
                                                                <?php
                                                                $SQL_major = "SELECT major_id,name_in_english FROM major WHERE delete_flag = '0'";
                                                                $result_major = data_FetchAll($SQL_major);

                                                                foreach ($result_major as $key_major => $value_major) {
                                                                ?>
                                                                    <option value="<?= $value_major['major_id'] ?>" <?= ($data_main['major_id'] == $value_major['major_id'] || $value_major['major_id'] == 17) ? 'selected' : '' ?>><?= $value_major['name_in_english'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3 d-flex justify-content-start justify-content-md-end ">
                                                        <p>คณะ : </p>
                                                    </div>
                                                    <div class="col-md-4 ">
                                                        <div class="form-group form-group-default">
                                                            <label>คณะ TH</label>
                                                            <select class="form-select form-control ps-3" id="FACULTY_ID" name="FACULTY_ID" disabled>
                                                                <?php
                                                                $SQL_faculty = "SELECT faculty_id,name_in_thai FROM faculty WHERE delete_flag = '0'";
                                                                $result_faculty = data_FetchAll($SQL_faculty);

                                                                foreach ($result_faculty as $key_faculty => $value_faculty) {
                                                                ?>
                                                                    <option value="<?= $value_faculty['faculty_id'] ?>" <?= ($data_main['faculty_id'] == $value_faculty['faculty_id'] || $value_faculty['faculty_id'] == 2) ? 'selected' : '' ?>><?= $value_faculty['name_in_thai'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 ">
                                                        <div class="form-group form-group-default">
                                                            <label>คณะ EN</label>
                                                            <select class="form-select form-control ps-3" id="FACULTY_ID_EN" name="FACULTY_ID_EN" disabled>
                                                                <?php
                                                                $SQL_faculty = "SELECT faculty_id,name_in_english FROM faculty WHERE delete_flag = '0'";
                                                                $result_faculty = data_FetchAll($SQL_faculty);

                                                                foreach ($result_faculty as $key_faculty => $value_faculty) {
                                                                ?>
                                                                    <option value="<?= $value_faculty['faculty_id'] ?>" <?= ($data_main['faculty_id'] == $value_faculty['faculty_id'] || $value_faculty['faculty_id'] == 2) ? 'selected' : '' ?>><?= $value_faculty['name_in_english'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 ">
                                                <div class="w-100 h-100 d-flex align-items-center justify-content-center border border-5 rounded ">
                                                    <i class="fas fa-user-graduate" style="font-size: 100px;"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-12 ">
                                                <div class="d-flex justify-content-center">
                                                    <input class="btn btn-success m-3" type="submit" value="บันทึกข้อมูล">
                                                    <a class="btn btn-warning m-3" href="student_table.php">กลับ</a>
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
<script src="../asset/js/script_student.js"></script>
<script>
    function new_adviser() {
        $.ajax({
            type: "post",
            url: "../process/new_student_adviser_process.php",
            data: "data",
            dataType: "json",
            success: function(response) {
                if (response.status == "success") {
                    var number = $('.row-student-adviser').length + 1;
                    var html = "";

                    html += '<div class="row row-student-adviser">';
                    html += '<div class="col-md-3 d-flex justify-content-start justify-content-md-end ">';
                    html += '<p>อาจารย์ที่ปรึกษา ' + number + ' : </p>';
                    html += '</div>';
                    html += '<div class="col-md-9 ">';
                    html += '<div class="form-group form-group-default">';
                    html += '<label>อาจารย์ที่ปรึกษา</label>';
                    html += '<select class="form-select form-control ps-3" id="STD_AVS_' + number + '" name="STD_AVS_' + number + '">';
                    response.data.forEach(function(data) {
                        html += '<option value="' + data.tc_id + '">' + data.prefix + data.tc_fname_th + ' ' + data.tc_lname_th + '</option>';
                    });
                    html += '</select>';
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';

                    $("#group_student_adviser").append(html);
                }
            },
            error: function(xhr, status, error) {
                alert_confirm(
                    "ระบบเกิดข้อผิดพลาด",
                    "error",
                    "danger",
                );
                console.error("เกิดข้อผิดพลาด: " + status + " - " + error);
            },
        });
    }

    function change_academic_year() {
        var year = parseInt($("#AY_ID > option:selected").text());
        var currentYear = new Date().getFullYear();
        var academicYear = currentYear + 543 - year + 1; // คำนวณชั้นปี

        if (academicYear > 4) {
            academicYear = 4;
        }
        $("#STD_ACDEMIC_YEAR").val(academicYear);
    }
</script>