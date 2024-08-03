<?php
require_once("../../include/include_top.php");

$_SESSION["PAGE_TITLE"] = "นักศึกษา";
$_SESSION["PAGE_NAME"] = "PUBLIC_STUDENT";
$_SESSION["PAGE_SECTION"] = "PUBLIC";

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
                                    <div class="row">
                                        <div class="col-md-12 ">
                                        </div>
                                        <div class="col-md-9 mb-3">
                                            <div class="row">
                                                <div class="col-md-3 d-flex justify-content-start justify-content-md-end ">
                                                    <h2>ชื่อ-นามสกุล : </h2>
                                                </div>
                                                <div class="col-md-8">
                                                    <span></span>
                                                    <h2><?= get_student_name($data_main['std_id'], "TH") ?></h2>
                                                    <h6> <?= get_student_name($data_main['std_id'], "EN") ?></h6>
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
                                                    <h4>รุ่นปีการศึกษา : </h4>
                                                </div>
                                                <div class="col-md-2 ">
                                                    <?php
                                                    $SQL_academic_year = "SELECT * FROM academic_year WHERE ay_id = '" . $data_main['ay_id'] . "'";
                                                    $result_academic_year = data_Fetch($SQL_academic_year);
                                                    ?>
                                                    <h4><?= $result_academic_year['ay_year'] ?></h4>
                                                </div>
                                                <div class="col-md-1 d-flex justify-content-start justify-content-md-end">
                                                    <h4>ชั้นปี : </h4>
                                                </div>
                                                <div class="col-md-6 ">
                                                    <h4><?= get_academic_year($data_main['ay_id']) ?></h4>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3 d-flex justify-content-start justify-content-md-end ">
                                                    <h4>รหัสนักศึกษา : </h4>
                                                </div>
                                                <div class="col-md-8 ">
                                                    <h4><?= $data_main['std_number_id'] ?></h4>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-3 d-flex justify-content-start justify-content-md-end ">
                                                    <h4>สาขา : </h4>
                                                </div>
                                                <div class="col-md-8 ">
                                                    <?php
                                                    $SQL_major = "SELECT * FROM major WHERE major_id = '" . $data_main['major_id'] . "'";
                                                    $result_major = data_Fetch($SQL_major);
                                                    ?>
                                                    <h4><?= $result_major['name_in_thai'] ?></h4>
                                                    <h6> <?= $result_major['name_in_english'] ?></h6>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3 d-flex justify-content-start justify-content-md-end ">
                                                    <h4>คณะ : </h4>
                                                </div>
                                                <div class="col-md-8 ">
                                                    <?php
                                                    $SQL_faculty = "SELECT * FROM faculty WHERE faculty_id = '" . $data_main['faculty_id'] . "'";
                                                    $result_faculty = data_Fetch($SQL_faculty);
                                                    ?>
                                                    <h4><?= $result_faculty['name_in_thai'] ?></h4>
                                                    <h6> <?= $result_faculty['name_in_english'] ?></h6>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3 d-flex justify-content-start justify-content-md-end ">
                                                    <h6>สถานะ : </h6>
                                                </div>
                                                <div class="col-md-8 ">
                                                    <?= get_student_status($data_main['std_id'], "Y") ?>
                                                </div>
                                            </div>

                                            <div class="row row-student-adviser mt-5">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-11 ">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <div class="card-title">
                                                                <div class="d-flex justify-content-between mb-2">
                                                                    <p class="text-dark">อาจารย์ที่ปรึกษา</p>
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
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="group_adviser">
                                                                        <?php
                                                                        $SQL_student_adviser = "SELECT * FROM student_adviser WHERE ay_id = '" . $data_main['ay_id'] . "'";
                                                                        $result_student_adviser = data_FetchAll($SQL_student_adviser);
                                                                        $row_num = data_row("student_adviser", "ay_id = '" . $data_main['ay_id'] . "'");

                                                                        if ($row_num > 0) {
                                                                            $i_tc = 1;
                                                                            foreach ($result_student_adviser as $key_std_tc => $value_std_tc) {

                                                                                $SQL_data_teacher = "SELECT * FROM teacher WHERE delete_flag = '0' AND tc_id = '" . $value_std_tc['tc_id'] . "'";
                                                                                $result_data_teacher = data_Fetch($SQL_data_teacher);

                                                                        ?>
                                                                                <tr id="row-student-adviser-1">
                                                                                    <th scope="row"><?= $i_tc ?></th>
                                                                                    <td><?= get_teacher_name($value_std_tc['tc_id']) ?></td>
                                                                                    <td><?= get_teacher_position_name($result_data_teacher['tp_id']) ?></td>
                                                                                </tr>
                                                                        <?php
                                                                                $i_tc++;
                                                                            }
                                                                        } ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="w-100 h-100 d-grid align-items-center justify-content-center border border-5 rounded ">
                                                <i class="fas fa-user-graduate" style="font-size: 100px;"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-12 ">
                                            <div class="d-flex justify-content-center">
                                                <a class="btn btn-warning m-3" href="student_table.php">กลับ</a>
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