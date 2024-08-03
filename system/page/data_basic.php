<?php
require_once("../../include/include_top.php");

$_SESSION["PAGE_TITLE"] = "ข้อมูลพื้นฐาน";
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
                            <li class="nav-item">
                                <a href="#"><?= $_SESSION["PAGE_TITLE"]; ?></a>
                            </li>
                        </ul>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="data_basic_teacher_position_table.php" class="hover-zoom">
                                        <div class="card card-secondary">
                                            <div class="card-body <?= getRandomWord(); ?>">
                                                <h1><?= data_row("teacher_position", "delete_flag = '0'"); ?></h1>
                                                <h5 class="op-8">รายการ</h5>
                                                <div class="pull-right">
                                                    <h3 class="fw-bold op-8">ข้อมูลตำแหน่งอาจารย์</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="data_basic_thesis_grouptype_table.php" class="hover-zoom">
                                        <div class="card card-secondary bg-secondary-gradient">
                                            <div class="card-body <?= getRandomWord(); ?>">
                                                <h1><?= data_row("thesis_grouptype", "delete_flag = '0'"); ?></h1>
                                                <h5 class="op-8">รายการ</h5>
                                                <div class="pull-right">
                                                    <h3 class="fw-bold op-8">ข้อมูลประเภทกลุ่มโครงงาน</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="data_basic_academic_year_table.php" class="hover-zoom">
                                        <div class="card card-secondary bg-secondary-gradient">
                                            <div class="card-body <?= getRandomWord(); ?>">
                                                <h1><?= data_row("academic_year", "delete_flag = '0'"); ?></h1>
                                                <h5 class="op-8">รายการ</h5>
                                                <div class="pull-right">
                                                    <h3 class="fw-bold op-8">ข้อมูลปีการศึกษา</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="data_basic_users_table.php" class="hover-zoom">
                                        <div class="card card-secondary bg-secondary-gradient">
                                            <div class="card-body <?= getRandomWord(); ?>">
                                                <h1><?= data_row("users", "delete_flag = '0'"); ?></h1>
                                                <h5 class="op-8">รายการ</h5>
                                                <div class="pull-right">
                                                <h3 class="fw-bold op-8">ข้อมูลเจ้าหน้าที่</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
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
                if ($(column.header()).text() === 'จัดการ') {
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