<?php
require_once("../../include/include_top.php");

$_SESSION["PAGE_TITLE"] = "จัดการข้อมูลโครงงาน/ปริญญานิพนธ์";
$_SESSION["PAGE_NAME"] = "PUBLIC_THESIS";
$_SESSION["PAGE_SECTION"] = "PUBLIC";

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
  $data_main['ts_status_date_1'] = "-";
  $data_main['ts_status_note_1'] = "-";
  $data_main['ts_status_2'] = "";
  $data_main['ts_status_date_2'] = "-";
  $data_main['ts_status_note_2'] = "-";
  $data_main['ts_status_3'] = "";
  $data_main['ts_status_date_3'] = "-";
  $data_main['ts_status_note_3'] = "-";
  $data_main['ts_status_4'] = "";
  $data_main['ts_status_date_4'] = "-";
  $data_main['ts_status_note_4'] = "-";
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
                  <div class="row">
                    <div class="col-md-12 ">
                    </div>
                    <div class="col-md-9">
                      <div class="row">
                        <div class="col-md-3 d-flex align-items-start justify-content-start justify-content-md-end ">
                          <h3>ชื่อโครงงาน : </h3>
                        </div>
                        <div class="col-md-8 ">
                          <h3><?= $data_main['ts_name_th'] ?></h3>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-3 d-flex align-items-start justify-content-start justify-content-md-end ">
                        </div>
                        <div class="col-md-8 ">
                          <h5><?= $data_main['ts_name_en'] ?></h5>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-3 d-flex justify-content-start justify-content-md-end ">
                          <h4>ประเภทกลุ่มโครงงาน : </h4>
                        </div>
                        <div class="col-md-4 ms-2">
                          <?php
                          $SQL_thesis_grouptype = "SELECT ts_gt_id,ts_gt_name FROM thesis_grouptype WHERE ts_gt_id = '" . $data_main['ts_gt_id'] . "'";
                          $result_thesis_grouptype = data_Fetch($SQL_thesis_grouptype);
                          ?>
                          <h4><?= $result_thesis_grouptype['ts_gt_name'] ?></h4>
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

                                        $SQL_data_student = "SELECT * FROM student WHERE delete_flag = '0' AND std_id = '" . $value_ts_std['std_id'] . "'";
                                        $result_data_student = data_Fetch($SQL_data_student);

                                    ?>
                                        <tr id="row-thesis-student-1">
                                          <th scope="row"><?= $i_std ?></th>
                                          <td><?= get_student_name($value_ts_std['std_id']) ?></td>
                                          <td><?= $result_data_student['std_number_id'] ?></td>
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
                                  <p class="text-dark">อาจารย์ที่ปรึกษาโครงงาน</p>
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
                                          <th scope="row"><?= $i_tc ?></th>
                                          <td><?= get_teacher_name($value_ts_tc['tc_id']) ?></td>
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
                      <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-11 border border-3 rounded">
                          <div class="d-flex ali justify-content-center">
                            <h4>สถานะโครงงาน</h4>
                          </div>
                          <ul class="timeline text-dark">
                            <li>
                              <div class="timeline-badge <?= get_time_line_stye($data_main['ts_status_1']); ?>">
                                <i class="<?= get_time_line_icon($data_main['ts_status_1']); ?>"></i>
                              </div>
                              <div class="timeline-panel">
                                <div class="timeline-heading">
                                  <h4 class="timeline-title">ดำเนินการโครงงาน 1</h4>
                                  <small class="text-muted">วันที่ <?= ($data_main['ts_status_date_1'] != '0000-00-00') ? $data_main['ts_status_date_1'] : '-' ?></small>
                                </div>
                                <div class="timeline-body">
                                  <p><?= $data_main['ts_status_note_1'] ?></p>
                                </div>
                              </div>
                            </li>
                            <li class="timeline-inverted">
                              <div class="timeline-badge  <?= get_time_line_stye($data_main['ts_status_2']); ?>">
                                <i class="<?= get_time_line_icon($data_main['ts_status_2']); ?>"></i>
                              </div>
                              <div class="timeline-panel">
                                <div class="timeline-heading">
                                  <h4 class="timeline-title">สอบโครงงาน 1 ผ่าน</h4>
                                  <small class="text-muted">วันที่ <?= ($data_main['ts_status_date_2'] != '0000-00-00') ? $data_main['ts_status_date_2'] : '-' ?></small>
                                </div>
                                <div class="timeline-body">
                                  <p><?= $data_main['ts_status_note_2'] ?></p>
                                </div>
                              </div>
                            </li>
                            <li>
                              <div class="timeline-badge  <?= get_time_line_stye($data_main['ts_status_3']); ?>">
                                <i class="<?= get_time_line_icon($data_main['ts_status_3']); ?>"></i>
                              </div>
                              <div class="timeline-panel">
                                <div class="timeline-heading">
                                  <h4 class="timeline-title">ดำเนินการโครงงาน 2</h4>
                                  <small class="text-muted">วันที่ <?= ($data_main['ts_status_date_3'] != '0000-00-00') ? $data_main['ts_status_date_3'] : '-'  ?></small>
                                </div>
                                <div class="timeline-body">
                                  <p><?= $data_main['ts_status_note_3'] ?></p>
                                </div>
                              </div>
                            </li>
                            <li class="timeline-inverted">
                              <div class="timeline-badge  <?= get_time_line_stye($data_main['ts_status_4']); ?>">
                                <i class="<?= get_time_line_icon($data_main['ts_status_4']); ?>"></i>
                              </div>
                              <div class="timeline-panel">
                                <div class="timeline-heading">
                                  <h4 class="timeline-title">สอบโครงงาน 2 ผ่าน</h4>
                                  <small class="text-muted">วันที่ <?= ($data_main['ts_status_date_4'] != '0000-00-00') ? $data_main['ts_status_date_4'] : '-'  ?></small>
                                </div>
                                <div class="timeline-body">
                                  <p><?= $data_main['ts_status_note_4'] ?></p>
                                </div>
                              </div>
                            </li>
                          </ul>
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
                        <a class="btn btn-warning m-3" href="thesis_table.php">กลับ</a>
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