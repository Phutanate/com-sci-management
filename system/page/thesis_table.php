<?php
require_once("../../include/include_top.php");

$_SESSION["PAGE_TITLE"] = "ข้อมูลโครงงาน/ปริญญานิพนธ์";
$_SESSION["PAGE_NAME"] = "SYSTEM_THESIS";
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
                                <a href="#"><?= $_SESSION["PAGE_TITLE"]; ?></a>
                            </li>
                        </ul>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h4 class="card-title">ตาราง<?= $_SESSION["PAGE_TITLE"]; ?></h4>
                                        <a class="btn btn-primary btn-round ms-auto" href="thesis_add.php">
                                            <i class="fa fa-plus"></i>
                                            เพิ่ม
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="multi-filter-select" class="display table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>โครงงาน/ปริญญานิพนธ์</th>
                                                    <th>ผู้จัดทำ</th>
                                                    <th>ที่ปรึกษา</th>
                                                    <th>สถานะ</th>
                                                    <th style="width: 10%">จัดการ</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>โครงงาน/ปริญญานิพนธ์</th>
                                                    <th>ผู้จัดทำ</th>
                                                    <th>ที่ปรึกษา</th>
                                                    <th>สถานะ</th>
                                                    <th>จัดการ</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php
                                                $SQL_thesis = "SELECT * FROM thesis WHERE delete_flag = '0'";
                                                $result_thesis = data_FetchAll($SQL_thesis);

                                                foreach ($result_thesis as $key_ts => $value_ts) {
                                                    $student = get_thesis_student($value_ts['ts_id']);
                                                    $adviser = get_thesis_adviser($value_ts['ts_id']);
                                                ?>
                                                    <tr>
                                                        <td><?= $value_ts['ts_name_th'] ?></td>
                                                        <td>
                                                            <?php
                                                            $i_std = 1;
                                                            foreach ($student as $key_std => $value_std) {
                                                                echo get_student_name($value_std['std_id']);

                                                                if (count($student) > $i_std) {
                                                                    echo ", ";
                                                                }
                                                                $i_std++;
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            $i_tc = 1;
                                                            foreach ($adviser as $key_tc => $value_tc) {
                                                                echo get_teacher_name($value_tc['tc_id']);

                                                                if (count($adviser) > $i_tc) {
                                                                    echo ", ";
                                                                }
                                                                $i_tc++;
                                                            }
                                                            ?>
                                                        </td>
                                                        <td><?= get_thesis_status($value_ts['ts_id'], "") ?></td>
                                                        <td>
                                                            <div class="form-button-action">
                                                                <a class="btn btn-sm btn-primary mx-1" href="thesis_manage.php?ts_id=<?= base64_encode($value_ts['ts_id']) ?>" data-bs-toggle="tooltip" data-original-title="จัดการ" title="จัดการ">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                                <a class="btn btn-sm btn-danger mx-1" href="javascript:void(0);" onclick="delete_data('<?= base64_encode($value_ts['ts_id']) ?>')" data-bs-toggle="tooltip" data-original-title="ลบ" title="ลบ">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
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
<script>
    // Initialize DataTable with filtering and custom initComplete
    $("#multi-filter-select").DataTable({
        pageLength: 10,
        initComplete: function() {
            var api = this.api();
            api.columns().every(function() {
                var column = this;
                // Check if the column is the 'จัดการ' column by comparing header text
                if ($(column.header()).text() === 'โครงงาน/ปริญญานิพนธ์' || $(column.header()).text() === 'ผู้จัดทำ' || $(column.header()).text() === 'ที่ปรึกษา' || $(column.header()).text() === 'จัดการ') {
                    return; // Skip the จัดการ column
                }

                var select = $(
                        '<select class="form-select"><option value=""></option></select>'
                    )
                    .appendTo($(column.footer()).empty())
                    .on("change", function() {
                        var val = $.fn.dataTable.util.escapeRegex($(this).val());

                        column
                            .search(val ? "^" + val + "$" : "", true, false)
                            .draw();
                    });

                column
                    .data()
                    .unique()
                    .sort()
                    .each(function(d, j) {
                        select.append(
                            '<option value="' + d + '">' + d + "</option>"
                        );
                    });
            });
        },
    });
</script>