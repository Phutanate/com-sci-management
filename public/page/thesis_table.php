<?php
require_once("../../include/include_top.php");

$_SESSION["PAGE_TITLE"] = "โครงงาน/ปริญญานิพนธ์";
$_SESSION["PAGE_NAME"] = "PUBLIC_THESIS";
$_SESSION["PAGE_SECTION"] = "PUBLIC";

require_once("../../include/include_head.php");

if (isset($_GET['SEARCH_1'])) {
    $SEARCH = $_GET['SEARCH_1'];
} else if (isset($_GET['SEARCH_2'])) {
    $SEARCH = $_GET['SEARCH_2'];
} else {
    $SEARCH = "";
}

$ft = "";

if (isset($SEARCH)) {
    $ft .= " AND (A.ts_name_th LIKE '%" . $SEARCH . "%' OR A.ts_name_en LIKE '%" . $SEARCH . "%' OR D.std_fname_th LIKE '%" . $SEARCH . "%' OR D.std_lname_th LIKE '%" . $SEARCH . "%' OR E.tc_fname_th LIKE '%" . $SEARCH . "%' OR E.tc_lname_th LIKE '%" . $SEARCH . "%')";
}

if (isset($_GET['PAGE'])) {
    $PAGE = $_GET['PAGE'];
} else {
    $PAGE = 1;
}

$LIMIT = 10;

if ($PAGE > 1) {
    $offset = " LIMIT " . $LIMIT . " OFFSET " . (($PAGE - 1) * 10);
} else {
    $offset = " LIMIT " . $LIMIT . " OFFSET 0";
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
                                <a href="#"><?= $_SESSION["PAGE_TITLE"]; ?></a>
                            </li>
                        </ul>
                    </div>

                    <div class="row">
                        <div class="col-md-12">

                            <div class="">
                                <form action="" method="get" id="search-form">
                                    <div class="form-group">
                                        <div class="input-group d-flex justify-content-center">
                                            <input type="text" class="form-control form-control-lg d-none d-md-flex search-public" id="SEARCH_1" name="SEARCH_1" placeholder="ค้นหา ..." aria-label="" aria-describedby="basic-addon1" onkeyup="set_serach('SEARCH_1','SEARCH_2')" value="<?= $SEARCH ?>">
                                            <input type="text" class="form-control form-control-lg d-flex d-md-none" id="SEARCH_2" placeholder="ค้นหา ..." aria-label="" aria-describedby="basic-addon1" onkeyup="set_serach('SEARCH_2','SEARCH_1')" value="<?= $SEARCH ?>">
                                            <input type="hidden" class="form-control form-control-lg" id="PAGE" name="PAGE" placeholder="หน้า" value="<?= $PAGE ?>">
                                            <button class="btn btn-secondary" type="submit">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <p class="op-7">ค้นหาด้วย : ชื่อโครงงาน/ปริญญานิพนธ์, ชื่อ-นามสกุลนักศึกษา/อาจารย์ที่ปรึกษาโครงงาน</p>
                                        </div>

                                    </div>
                                </form>
                            </div>

                        </div>

                        <div class="col-md-12">

                            <!-- Customized Card -->
                            <h3 class="fw-bold mb-3">ผลการค้นหา</h3>
                            <div class="row">
                                <?php
                                $SQL_thesis = "SELECT DISTINCT A.*
                                                FROM thesis A 
                                                    LEFT JOIN thesis_student B ON A.ts_id = B.ts_id 
                                                    LEFT JOIN thesis_adviser C ON A.ts_id = C.ts_id 
                                                    LEFT JOIN student D ON B.std_id = D.std_id 
                                                    LEFT JOIN teacher E ON C.tc_id = E.tc_id 
                                                WHERE A.delete_flag = '0' " . $ft . " ORDER BY A.ay_id DESC, A.ts_status_4 DESC, A.ts_status_3 DESC, A.ts_status_2 DESC, A.ts_status_1 DESC " . $offset;
                                $result_thesis = data_FetchAll($SQL_thesis);

                                $sql_row = "SELECT COUNT(DISTINCT A.ts_id)
                                            FROM thesis A 
                                                LEFT JOIN thesis_student B ON A.ts_id = B.ts_id 
                                                LEFT JOIN thesis_adviser C ON A.ts_id = C.ts_id 
                                                LEFT JOIN student D ON B.std_id = D.std_id 
                                                LEFT JOIN teacher E ON C.tc_id = E.tc_id 
                                            WHERE A.delete_flag = '0' " . $ft;
                                $TOTAL_DATA = data_row_sql($sql_row);

                                $TOTAL_PAGE = ceil($TOTAL_DATA / $LIMIT);
                                foreach ($result_thesis as $key_ts => $value_ts) {
                                    $student = get_thesis_student($value_ts['ts_id']);
                                    $adviser = get_thesis_adviser($value_ts['ts_id']);
                                ?>
                                    <div class="col-md-12">
                                        <a class="hover-zoom" href="thesis_view.php?ts_id=<?= base64_encode($value_ts['ts_id']) ?>">
                                            <div class="card d-flex p-3">
                                                <div class="row">
                                                    <div class="col-md-2 d-grid align-items-center justify-content-center justify-content-md-end">
                                                        <div class="d-flex align-items-center justify-content-center rounded-circle border border-5" style="width: 7.5rem; height: 7.5rem; ">
                                                            <h1><i class="fas fa-newspaper"></i></h1>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <div class="row">
                                                            <div class="col-md-2 d-flex justify-content-md-end">
                                                                <h4><b>เรื่อง : </b></h4>
                                                            </div>
                                                            <div class="col-md-10">
                                                                <h4><b><?= $value_ts['ts_name_th'] ?></b></h4>
                                                                <h6><?= $value_ts['ts_name_en'] ?></h6>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-2 d-none d-md-flex justify-content-md-end">
                                                                <h6><b>ผู้จัดทำ : </b></h6>
                                                            </div>
                                                            <div class="col-md-10 d-none d-md-flex">
                                                                <h6>
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
                                                                </h6>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-2 d-none d-md-flex justify-content-md-end">
                                                                <h6><b>ที่ปรึกษา : </b></h6>
                                                            </div>
                                                            <div class="col-md-10 d-none d-md-flex">
                                                                <h6><?php
                                                                    $i_tc = 1;
                                                                    foreach ($adviser as $key_tc => $value_tc) {
                                                                        echo get_teacher_name($value_tc['tc_id']);

                                                                        if (count($adviser) > $i_tc) {
                                                                            echo ", ";
                                                                        }
                                                                        $i_tc++;
                                                                    }
                                                                    ?></h6>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-2 d-none d-md-flex justify-content-md-end">
                                                                <h6><b>สถานะ : </b></h6>
                                                            </div>
                                                            <div class="col-md-10 d-none d-md-flex">
                                                                <h6>
                                                                    <?= get_thesis_status($value_ts['ts_id'], "Y") ?>
                                                                </h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                <?php
                                }
                                ?>

                                <div class="d-grid d-md-flex justify-content-between">
                                    <p class="op-7">ทั้งหมด <?= $TOTAL_DATA ?> รายการ แสดง <?= $PAGE ?> จาก <?= $TOTAL_PAGE ?> หน้า</p>
                                    <ul class="pagination pg-primary d-flex align-items-center">
                                        <?php
                                        if ($PAGE > 2) {
                                        ?>
                                            <li class="page-item mx-1">
                                                <a class="page-link" href="javascript:void(0)" aria-label="Previous" onclick="change_page(1)">
                                                    <span aria-hidden="true"><i class="fas fa-angle-double-left"></i></span>
                                                    <span class="sr-only">First</span>
                                                </a>
                                            </li>
                                        <?php
                                        }
                                        if ($PAGE > 1) {
                                        ?>
                                            <li class="page-item mx-1">
                                                <a class="page-link" href="javascript:void(0)" aria-label="Previous" onclick="change_page(<?= ($PAGE - 1) ?>)">
                                                    <span aria-hidden="true"><i class="fas fa-angle-left"></i></span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                            </li>
                                        <?php
                                        }
                                        $limit_loop = 1;
                                        for ($i_page = $PAGE; $i_page <= $TOTAL_PAGE; $i_page++) {
                                            if ($PAGE > 1 && $limit_loop == 1) {
                                                $i_page = $i_page - 1;
                                            }
                                        ?>
                                            <li class="page-item mx-1 <?= ($i_page == $PAGE) ? 'active' : '' ?>">
                                                <a class="page-link" href="javascript:void(0)" onclick="change_page(<?= $i_page ?>)"><?= $i_page ?></a>
                                            </li>
                                        <?php
                                            $limit_loop++;

                                            if ($limit_loop > 3) {
                                                break;
                                            }
                                        }
                                        ?>
                                        <?php
                                        if ($PAGE < $TOTAL_PAGE) {
                                        ?>
                                            <li class="page-item mx-1">
                                                <a class="page-link" href="javascript:void(0)" aria-label="Next" onclick="change_page(<?= ($PAGE + 1) ?>)">
                                                    <span aria-hidden="true"><i class="fas fa-angle-right"></i></span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            </li>
                                        <?php
                                        }
                                        if ($PAGE < ($TOTAL_PAGE - 1)) {
                                        ?>
                                            <li class="page-item mx-1">
                                                <a class="page-link" href="javascript:void(0)" aria-label="Next" onclick="change_page(<?= $TOTAL_PAGE ?>)">
                                                    <span aria-hidden="true"><i class="fas fa-angle-double-right"></i></span>
                                                    <span class="sr-only">Last</span>
                                                </a>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
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
<script>
    function set_serach(id, target) {
        var value = $('#' + id).val();
        $('#' + target).val(value);
    }
</script>
