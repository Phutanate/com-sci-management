<?php
require_once("../../include/include_top.php");

$_SESSION["PAGE_TITLE"] = "จัดการข้อมูลปีการศึกษา";
$_SESSION["PAGE_NAME"] = "SYSTEM_DATA_BASIC";
$_SESSION["PAGE_SECTION"] = "SYSTEM";

require_once("../../include/include_head.php");

if (isset($_GET['ay_id'])) {
    $ay_id = base64_decode($_GET['ay_id']);
    $SQL_academic_year = "SELECT * FROM academic_year WHERE ay_id = '" . $ay_id . "'";
    $data_main = data_Fetch($SQL_academic_year);
} else {
    $data_main['ay_id'] = "";
    $data_main['ay_year'] = "";
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
                            <li class="nav-home">
                                <a href="data_basic.php">
                                    <i class="fas fa-database"></i>
                                </a>
                            </li>
                            <li class="separator">
                                <i class="icon-arrow-right"></i>
                            </li>
                            <li class="nav-home">
                                <a href="data_basic_academic_year_table.php">
                                    <i class="far fa-calendar-check"></i>
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
                                    <form onsubmit="academic_year_process(event,'edit','<?= base64_encode($data_main['ay_id']) ?>');">
                                        <div class="row">
                                            <div class="col-md-12 ">
                                            </div>
                                            <div class="col-md-9">
                                                <div class="row">
                                                    <div class="col-md-3 d-flex align-items-end justify-content-start justify-content-md-end ">
                                                        <p>ปีการศึกษา : </p>
                                                    </div>
                                                    <div class="col-md-8 ">
                                                        <div class="form-group form-group-default">
                                                            <label>ปีการศึกษา</label>
                                                            <input id="AY_YEAR" name="AY_YEAR" type="text" class="form-control ps-3" placeholder="ปีการศึกษา" value="<?= $data_main['ay_year'] ?>">
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
                                                                        <p class="text-dark">อาจารย์ที่ปรึกษา ประจำปีการศึกษา</p>
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
                                                                            $SQL_student_adviser = "SELECT * FROM student_adviser WHERE ay_id = '" . $data_main['ay_id'] . "'";
                                                                            $result_student_adviser = data_FetchAll($SQL_student_adviser);
                                                                            $row_num = data_row("student_adviser", "ay_id = '" . $data_main['ay_id'] . "'");

                                                                            if ($row_num > 0) {
                                                                                $i_tc = 1;
                                                                                foreach ($result_student_adviser as $key_ts_tc => $value_ts_tc) {

                                                                                    $SQL_data_teacher = "SELECT * FROM teacher WHERE delete_flag = '0' AND tc_id = '" . $value_ts_tc['tc_id'] . "'";
                                                                                    $result_data_teacher = data_Fetch($SQL_data_teacher);

                                                                            ?>
                                                                                    <tr id="row-thesis-adviser-1">
                                                                                        <th scope="row">1</th>
                                                                                        <td>
                                                                                            <div class="form-group form-group-default">
                                                                                                <label>อาจารย์</label>
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
                                                    <i class="far fa-calendar-check" style="font-size: 100px;"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-12 ">
                                                <div class="d-flex justify-content-center">
                                                    <input class="btn btn-success m-3" type="submit" value="บันทึกข้อมูล">
                                                    <a class="btn btn-warning m-3" href="data_basic_academic_year_table.php">กลับ</a>
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
<script src="../asset/js/script_data_basic_academic_year.js"></script>