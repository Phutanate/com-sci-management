<?php
require_once("../../include/include_top.php");

$_SESSION["PAGE_TITLE"] = "จัดการข้อมูลโครงงาน/ปริญญานิพนธ์";
$_SESSION["PAGE_NAME"] = "SYSTEM_THESIS";
$_SESSION["PAGE_SECTION"] = "SYSTEM";

require_once("../../include/include_head.php");

if (isset($_GET['ts_id'])) {
    $ts_id = base64_decode($_GET['ts_id']);
    $SQL_teacher = "SELECT * FROM thesis WHERE ts_id = '" . $ts_id . "'";
    $data_main = data_Fetch($SQL_teacher);
} else {
    $data_main['ts_id'] = "";
    $data_main['ts_name_th'] = "";
    $data_main['ts_name_en'] = "";
    $data_main['ts_gt_id'] = "";
    $data_main['ay_id'] = "";
    $data_main['ts_status_1'] = "";
    $data_main['ts_status_date_1'] = "";
    $data_main['ts_status_note_1'] = "";
    $data_main['ts_status_2'] = "";
    $data_main['ts_status_date_2'] = "";
    $data_main['ts_status_note_2'] = "";
    $data_main['ts_status_3'] = "";
    $data_main['ts_status_date_3'] = "";
    $data_main['ts_status_note_3'] = "";
    $data_main['ts_status_4'] = "";
    $data_main['ts_status_date_4'] = "";
    $data_main['ts_status_note_4'] = "";
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
                                <a href="thesis_table.php">
                                    <i class="fas fa-newspaper"></i>
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
                                    <form onsubmit="thesis_process(event,'edit','<?= base64_encode($data_main['ts_id']) ?>');">
                                        <div class="row">
                                            <div class="col-md-12 ">
                                            </div>
                                            <div class="col-md-9">
                                                <div class="row">
                                                    <div class="col-md-3 d-flex align-items-start justify-content-start justify-content-md-end ">
                                                        <p>ชื่อโครงงาน : </p>
                                                    </div>
                                                    <div class="col-md-8 ">
                                                        <div class="form-group">
                                                            <label class="text-light" for="TS_FNAME_TH">ชื่อโครงงาน TH :</label>
                                                            <textarea id="TS_NAME_TH" name="TS_NAME_TH" class="form-control ps-3" rows="3" placeholder="ชื่อโครงงาน TH"><?= $data_main['ts_name_th'] ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3 d-flex align-items-start justify-content-start justify-content-md-end ">
                                                    </div>
                                                    <div class="col-md-8 ">
                                                        <div class="form-group">
                                                            <label class="text-light" for="TS_FNAME_TH">ชื่อโครงงาน EN :</label>
                                                            <textarea id="TS_NAME_EN" name="TS_NAME_EN" class="form-control ps-3" rows="3" placeholder="ชื่อโครงงาน EN"><?= $data_main['ts_name_en'] ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3 d-flex justify-content-start justify-content-md-end ">
                                                        <p>ประเภทกลุ่มโครงงาน : </p>
                                                    </div>
                                                    <div class="col-md-4 ms-2">
                                                        <div class="form-group form-group-default">
                                                            <label>ประเภทกลุ่มโครงงาน</label>
                                                            <select class="form-select form-control ps-3" id="TS_GT_ID" name="TS_GT_ID" onchange="set_limit_student()">
                                                                <option value="">เลือก</option>
                                                                <?php
                                                                $SQL_thesis_grouptype = "SELECT ts_gt_id,ts_gt_name FROM thesis_grouptype WHERE delete_flag = '0'";
                                                                $result_thesis_grouptype = data_FetchAll($SQL_thesis_grouptype);

                                                                foreach ($result_thesis_grouptype as $key_thesis_grouptype => $value_thesis_grouptype) {
                                                                ?>
                                                                    <option value="<?= $value_thesis_grouptype['ts_gt_id'] ?>" <?= ($data_main['ts_gt_id'] == $value_thesis_grouptype['ts_gt_id']) ? 'selected' : '' ?>><?= $value_thesis_grouptype['ts_gt_name'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                            <input type="hidden" id="limit_student" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3 d-flex justify-content-start justify-content-md-end mt-3">
                                                        สภานะโครงงาน :
                                                    </div>
                                                    <div class="col-md-8 ms-2">
                                                        <div class="form-group">
                                                            <div class="d-grid selectgroup selectgroup-success selectgroup-pills">
                                                                <label class="selectgroup-item">
                                                                    <input type="checkbox" id="TS_STATUS_1" name="TS_STATUS_1" value="1" class="selectgroup-input" onchange="toggle_detail(1)" <?= ($data_main['ts_status_1'] == '1') ? 'checked' : '' ?>>
                                                                    <span class="selectgroup-button">กำลังดำเนินการโครงงาน 1</span>

                                                                    <div id="group_detail_status_1" style="display: <?= ($data_main['ts_status_1'] == '1') ? 'block' : 'none' ?>;">
                                                                        <div class="form-group">
                                                                            <label class="text-light" for="TS_STATUS_DATE_1">วันที่ :</label>
                                                                            <input class="form-control ps-3" id="TS_STATUS_DATE_1" name="TS_STATUS_DATE_1" type="date" placeholder="วันที่" value="<?= $data_main['ts_status_date_1'] ?>">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="text-light" for="TS_STATUS_NOTE_1">รายละเอียด :</label>
                                                                            <textarea class="form-control ps-3" id="TS_STATUS_NOTE_1" name="TS_STATUS_NOTE_1" rows="3" placeholder="รายละเอียด"><?= $data_main['ts_status_note_1'] ?></textarea>
                                                                        </div>
                                                                    </div>
                                                                </label>
                                                                <label class="selectgroup-item">
                                                                    <input type="checkbox" id="TS_STATUS_2" name="TS_STATUS_2" value="1" class="selectgroup-input" onchange="toggle_detail(2)" <?= ($data_main['ts_status_2'] == '1') ? 'checked' : '' ?>>
                                                                    <span class="selectgroup-button">สอบโครงงาน 1 ผ่าน</span>

                                                                    <div id="group_detail_status_2" style="display: <?= ($data_main['ts_status_2'] == '1') ? 'block' : 'none' ?>;">
                                                                        <div class="form-group">
                                                                            <label class="text-light" for="TS_STATUS_DATE_2">วันที่ :</label>
                                                                            <input class="form-control ps-3" id="TS_STATUS_DATE_2" name="TS_STATUS_DATE_2" type="date" placeholder="วันที่" value="<?= $data_main['ts_status_date_2'] ?>">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="text-light" for="TS_STATUS_NOTE_2">รายละเอียด :</label>
                                                                            <textarea class="form-control ps-3" id="TS_STATUS_NOTE_2" name="TS_STATUS_NOTE_2" rows="3" placeholder="รายละเอียด"><?= $data_main['ts_status_note_2'] ?></textarea>
                                                                        </div>
                                                                    </div>
                                                                </label>
                                                                <label class="selectgroup-item">
                                                                    <input type="checkbox" id="TS_STATUS_3" name="TS_STATUS_3" value="1" class="selectgroup-input" onchange="toggle_detail(3)" <?= ($data_main['ts_status_3'] == '1') ? 'checked' : '' ?>>
                                                                    <span class="selectgroup-button">กำลังดำเนินการโครงงาน 2</span>

                                                                    <div id="group_detail_status_3" style="display: <?= ($data_main['ts_status_3'] == '1') ? 'block' : 'none' ?>;">
                                                                        <div class="form-group">
                                                                            <label class="text-light" for="TS_STATUS_DATE_3">วันที่ :</label>
                                                                            <input class="form-control ps-3" id="TS_STATUS_DATE_3" name="TS_STATUS_DATE_3" type="date" placeholder="วันที่" value="<?= $data_main['ts_status_date_3'] ?>">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="text-light" for="TS_STATUS_NOTE_3">รายละเอียด :</label>
                                                                            <textarea class="form-control ps-3" id="TS_STATUS_NOTE_3" name="TS_STATUS_NOTE_3" rows="3" placeholder="รายละเอียด"><?= $data_main['ts_status_note_3'] ?></textarea>
                                                                        </div>
                                                                    </div>
                                                                </label>
                                                                <label class="selectgroup-item">
                                                                    <input type="checkbox" id="TS_STATUS_4" name="TS_STATUS_4" value="1" class="selectgroup-input" onchange="toggle_detail(4)" <?= ($data_main['ts_status_4'] == '1') ? 'checked' : '' ?>>
                                                                    <span class="selectgroup-button">สอบโครงงาน 2 ผ่าน</span>

                                                                    <div id="group_detail_status_4" style="display: <?= ($data_main['ts_status_4'] == '1') ? 'block' : 'none' ?>;">
                                                                        <div class="form-group">
                                                                            <label class="text-light" for="TS_STATUS_DATE_4">วันที่ :</label>
                                                                            <input class="form-control ps-3" id="TS_STATUS_DATE_4" name="TS_STATUS_DATE_4" type="date" placeholder="วันที่" value="<?= $data_main['ts_status_date_4'] ?>">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="text-light" for="TS_STATUS_NOTE_4">รายละเอียด :</label>
                                                                            <textarea class="form-control ps-3" id="TS_STATUS_NOTE_4" name="TS_STATUS_NOTE_4" rows="3" placeholder="รายละเอียด"><?= $data_main['ts_status_note_4'] ?></textarea>
                                                                        </div>
                                                                    </div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row row-student-adviser">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-11 ">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <div class="card-title">
                                                                    <div class="d-flex justify-content-start">
                                                                        <p class="text-dark">ผู้จัดทำโครงงาน</p>
                                                                    </div>
                                                                    <div class="d-flex justify-content-between mb-2">
                                                                        <div class="form-group form-group-default" style="width:30%;">
                                                                            <label>ปีการศึกษา</label>
                                                                            <select class="form-select form-control ps-3" id="AY_ID" name="AY_ID" onchange="toggle_add_student_btn_from_ay(); delete_ay_id_row();">
                                                                                <option value="">เลือก</option>
                                                                                <?php
                                                                                $SQL_academic_year = "SELECT ay_id,ay_year FROM academic_year WHERE delete_flag = '0'";
                                                                                $result_academic_year = data_FetchAll($SQL_academic_year);

                                                                                foreach ($result_academic_year as $key_ay => $value_ay) {
                                                                                ?>
                                                                                    <option value="<?= $value_ay['ay_id'] ?>" <?= ($data_main['ay_id'] == $value_ay['ay_id']) ? 'selected' : '' ?>><?= $value_ay['ay_year'] ?></option>
                                                                                <?php } ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="">
                                                                            <a class="btn btn-dark btn-round text-light ms-auto" style="display: none;" id="btn_add_student" href="javascript:void(0);" onclick="new_student()">
                                                                                <i class="fa fa-plus"></i>
                                                                                เพิ่ม
                                                                            </a>
                                                                        </div>

                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="card-body">
                                                                <div class="table-responsive">
                                                                    <table class="table table-bordered">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>ลำดับ</th>
                                                                                <th>ชื่อ-นามสกุล</th>
                                                                                <th>รหัสนักศึกษา</th>
                                                                                <th>ลบ</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="group_thesis_student">
                                                                            <?php
                                                                            $SQL_thesis_student = "SELECT * FROM thesis_student WHERE ts_id = '" . $data_main['ts_id'] . "'";
                                                                            $result_thesis_student = data_FetchAll($SQL_thesis_student);
                                                                            $row_num = data_row("thesis_student", "ts_id = '" . $data_main['ts_id'] . "'");
                                                                            if ($row_num > 0) {
                                                                                $i_std = 1;
                                                                                foreach ($result_thesis_student as $key_ts_std => $value_ts_std) {

                                                                                    $SQL_data_student = "SELECT * FROM student WHERE std_id = '" . $value_ts_std['std_id'] . "'";
                                                                                    $result_data_student = data_Fetch($SQL_data_student);

                                                                            ?>
                                                                                    <tr id="row-thesis-student-1">
                                                                                        <th scope="row">1</th>
                                                                                        <td>
                                                                                            <div class="form-group form-group-default">
                                                                                                <label>นักศึกษา</label>
                                                                                                <select class="form-select form-control ps-3" id="STD_ID_<?= $i_std ?>" name="STD_ID_<?= $i_std ?>">
                                                                                                    <option value="">เลือก</option>
                                                                                                    <?php
                                                                                                    $SQL_student = "SELECT std_id FROM student WHERE delete_flag = '0' AND ay_id = '" . $data_main['ay_id'] . "'";
                                                                                                    $result_student = data_FetchAll($SQL_student);

                                                                                                    foreach ($result_student as $key_std => $value_std) {
                                                                                                    ?>
                                                                                                        <option value="<?= $value_std['std_id'] ?>" <?= ($value_ts_std['std_id'] == $value_std['std_id']) ? 'selected' : '' ?>><?= get_student_name($value_std['std_id']) ?></option>
                                                                                                    <?php } ?>
                                                                                                </select>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td><?= $result_data_student['std_number_id'] ?></td>
                                                                                        <td>
                                                                                            <div class="d-flex justify-content-center">
                                                                                                <a class="btn btn-sm btn-danger mx-1" href="javascript:void(0);" onclick="delete_row('row-thesis-student-1')" data-bs-toggle="tooltip" data-original-title="ลบ" title="ลบ">
                                                                                                    <i class="fa fa-trash"></i>
                                                                                                </a>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                            <?php
                                                                                    $i_std++;
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row row-student-adviser">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-11 ">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <div class="card-title">
                                                                    <div class="d-flex justify-content-between mb-2">
                                                                        <p class="text-dark">อาจารย์ที่ปรึกษา โครงงาน</p>
                                                                        <a class="btn btn-dark btn-round text-light ms-auto" href="javascript:void(0);" onclick="new_adviser()">
                                                                            <i class="fa fa-plus"></i>
                                                                            เพิ่ม
                                                                        </a>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="card-body">
                                                                <div class="table-responsive">
                                                                    <table class="table table-bordered">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>ลำดับ</th>
                                                                                <th>ชื่อ-นามสกุล</th>
                                                                                <th>ตำแหน่ง</th>
                                                                                <th>ลบ</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="group_adviser">
                                                                            <?php
                                                                            $SQL_thesis_adviser = "SELECT * FROM thesis_adviser WHERE ts_id = '" . $data_main['ts_id'] . "'";
                                                                            $result_thesis_adviser = data_FetchAll($SQL_thesis_adviser);
                                                                            $row_num = data_row("thesis_adviser", "ts_id = '" . $data_main['ts_id'] . "'");

                                                                            if ($row_num > 0) {
                                                                                $i_tc = 1;
                                                                                foreach ($result_thesis_adviser as $key_ts_tc => $value_ts_tc) {

                                                                                    $SQL_data_teacher = "SELECT * FROM teacher WHERE tc_id = '" . $value_ts_tc['tc_id'] . "'";
                                                                                    $result_data_teacher = data_Fetch($SQL_data_teacher);

                                                                            ?>
                                                                                    <tr id="row-thesis-adviser-1">
                                                                                        <th scope="row">1</th>
                                                                                        <td>
                                                                                            <div class="form-group form-group-default">
                                                                                                <label>นักศึกษา</label>
                                                                                                <select class="form-select form-control ps-3" id="TC_ID_<?= $i_tc ?>" name="TC_ID_<?= $i_tc ?>">
                                                                                                    <option value="">เลือก</option>
                                                                                                    <?php
                                                                                                    $SQL_teacher = "SELECT tc_id FROM teacher WHERE delete_flag = '0'";
                                                                                                    $result_teacher = data_FetchAll($SQL_teacher);

                                                                                                    foreach ($result_teacher as $key_tc => $value_tc) {
                                                                                                    ?>
                                                                                                        <option value="<?= $value_tc['tc_id'] ?>" <?= ($value_ts_tc['tc_id'] == $value_tc['tc_id']) ? 'selected' : '' ?>><?= get_teacher_name($value_tc['tc_id']) ?></option>
                                                                                                    <?php } ?>
                                                                                                </select>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td><?= get_teacher_position_name($result_data_teacher['tp_id']) ?></td>
                                                                                        <td>
                                                                                            <div class="d-flex justify-content-center">
                                                                                                <a class="btn btn-sm btn-danger mx-1" href="javascript:void(0);" onclick="delete_row('row-thesis-adviser-1')" data-bs-toggle="tooltip" data-original-title="ลบ" title="ลบ">
                                                                                                    <i class="fa fa-trash"></i>
                                                                                                </a>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                <?php
                                                                                    $i_tc++;
                                                                                }
                                                                            } else {
                                                                                ?>
                                                                                <tr id="row-thesis-adviser-1">
                                                                                    <th scope="row">1</th>
                                                                                    <td>
                                                                                        <div class="form-group form-group-default">
                                                                                            <label>อาจารย์</label>
                                                                                            <select class="form-select form-control ps-3" id="TC_ID_1" name="TC_ID_1">
                                                                                                <option value="">เลือก</option>
                                                                                                <?php
                                                                                                $SQL_teacher = "SELECT tc_id FROM teacher WHERE delete_flag = '0'";
                                                                                                $result_teacher = data_FetchAll($SQL_teacher);

                                                                                                foreach ($result_teacher as $key_tc => $value_tc) {
                                                                                                ?>
                                                                                                    <option value="<?= $value_tc['tc_id'] ?>"><?= get_teacher_name($value_tc['tc_id']) ?></option>
                                                                                                <?php } ?>
                                                                                            </select>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td></td>
                                                                                    <td>
                                                                                        <div class="d-flex justify-content-center">
                                                                                            <a class="btn btn-sm btn-danger mx-1" href="javascript:void(0);" onclick="delete_row('row-thesis-adviser-1')" data-bs-toggle="tooltip" data-original-title="ลบ" title="ลบ">
                                                                                                <i class="fa fa-trash"></i>
                                                                                            </a>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            <?php } ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 ">
                                                <div class="w-100 h-100 d-flex align-items-center justify-content-center border border-5 rounded ">
                                                    <i class="fas fa-newspaper" style="font-size: 100px;"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-12 ">
                                                <div class="d-flex justify-content-center">
                                                    <input class="btn btn-success m-3" type="submit" value="บันทึกข้อมูล">
                                                    <a class="btn btn-warning m-3" href="thesis_table.php">กลับ</a>
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
<script src="../asset/js/script_thesis.js"></script>
<script>
    $(document).ready(function() {
        set_limit_student();
        toggle_add_student_btn_from_ay();
    });
</script>